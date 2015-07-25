<?php 
session_start();
if(!isset($_SESSION['logged_in'])){

header('location: index.php');

}
 ?>
<?php 
error_reporting(E_ALL);
ini_set('dispaly_errors', '1');

$meg="";
$title ="";
$caption ="";
$rank ="";

// get the info from the form -add-

if(isset($_POST['submit'])){
  $title = $_POST['title'];
  $caption = $_POST['caption'];
  $rank = $_POST['rank'];

  // Filter
  $title = stripcslashes($title);
  $caption = stripcslashes($caption);
  $title = strip_tags($title);
  $caption = strip_tags($caption);
     // be sure write all data in all inputs
  if((!$title) || (!$caption)){
    $meg=" <p style='color:#C00;'> S'il Vous Plaît Remplir tout les Champs ! </p>";
}else{
  
  if($_FILES['fileField']['tmp_name'] != ""){
  $maxfilesize = 1000000;
   if($_FILES['fileField']['size'] > $maxfilesize){
     $meg = '<p class="error_message"> Votre Images été Grand !".</p>';
     unlink($_FILES['fileField']['tmp_name']);
      
}elseif(!preg_match('/\.(gif|jpg|png)$/i',$_FILES['fileField']['name'])){ 
  
  $meg = '<p> Votre Image Format nest pas accepté.</p>';
  unlink($_FILES['fileField']['tmp_name']);
  
}else {
  
    // connect to database
  include_once("../data/connect.php");
  // insert product to database
  $sql =$conn->query(" INSERT INTO carousel(title, caption, rank, date_time) VALUES('$title', '$caption', $rank, now())")or die (mysql_error());
    $id = $conn->lastInsertId();
    $newname = "$id.jpg";

  // move this picture to the folder in our server
  $uploads = "images";
  $tmp_name = $_FILES['fileField']['tmp_name'];
  move_uploaded_file($tmp_name, "$uploads/$newname");
  $meg = "Félicitation ! votre Produits été Ajouter !";


}
  
}
}
}

 ?>
 <?php 
// this block grabs the whole list for viewing

$carousel_list = "";
$picture ="";
// connect to database
  include_once("../data/connect.php");
$sql = $conn->query(" SELECT * FROM carousel ORDER BY date_time DESC limit 10 ")or die(mysql_error()) ;
// count the output amount
 $productCount = $sql->rowCount();
if($productCount > 0){
  while($row = $sql->fetch(PDO::FETCH_BOTH)) {
    
    $id = $row['carousel_id'];
    $title = $row['title'];
    $source = "images/$id.jpg";
    $picture = '<img src=" ' .$source. ' " width="30" height="20">';
    $date_time = strftime("%b %d, %y", strtotime($row["date_time"]));
   
 $carousel_list .= "
  <tr>
        <td>$id</td>
        <td>$title</td>
        <td>$picture</td>
        <td><a href='edit.php?c=edit&id=$id'>Edit</a> || 
            <a href='carousel.php?c=delete&id=$id'>Delete</a> </td>
      </tr>

 ";


    }
}
  else {
    $carousel_list = "You have no Pictures listed in your carousel yet";
    
}

?>
 <?php 
require '../data/connect.php';
   error_reporting(E_ALL & ~E_NOTICE);
     if ($_GET['c'] == 'delete') {
        
      $id = intval($_GET['id']);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "DELETE FROM carousel WHERE carousel_id='$id'";
      $stmt= $conn->query($sql);
      header('location: carousel.php');
    }


  ?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>BCORE Admin Dashboard Template | Dashboard </title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link href="assets/css/layout2.css" rel="stylesheet" />
       <link href="assets/plugins/flot/examples/examples.css" rel="stylesheet" />
       <link rel="stylesheet" href="assets/plugins/timeline/timeline.css" />
    <!-- END PAGE LEVEL  STYLES -->
     <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>

        <script type="text/javascript">
        tinymce.init({
        selector: "textarea"
        });
        </script>
</head>

    <!-- END HEAD -->

    <!-- BEGIN BODY -->
<body class="padTop53 " >

    <!-- MAIN WRAPPER -->
  <div id="wrap" >
        

        <!-- HEADER SECTION -->
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a href="administrator.php" class="navbar-brand">
                    <img src="assets/img/logo.png" alt="" />
                        
                        </a>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">

                    <a href="administrator.php" class="btn"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>

                    <!--ADMIN SETTINGS SECTIONS -->

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            
                            <li><a href="#"><i class="icon-gear"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="icon-signout"></i> Logout </a>
                            </li>
                        </ul>

                    </li>
                    <!--END ADMIN SETTINGS -->
                </ul>

            </nav>
 </div>
        <!-- END HEADER SECTION -->

     <!-- **************************************************** -->

<br><br><br>
   
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <form action="" enctype="multipart/form-data" method="POST">

      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Title</span>
        <input type="text" class="form-control" name="title" maxlength="30" placeholder="Username Max 30 Characters" aria-describedby="basic-addon1">
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Caption</span>
        <textarea name="caption" class="form-control" maxlength="255" placeholder="Caption Max 255 Characters"></textarea>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Photo</span>
        <input type="file" class="form-control" name="fileField" aria-describedby="basic-addon1">
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Rank</span> 
        <select class="form-control" name="rank">
        <option value="1">1st</option>
        <option value="2">2nd</option>
        <option value="3">3th</option>
        </select>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">New Item</span>
        <input type="submit" class="form-control btn btn-primary" name="submit" value="Add" aria-describedby="basic-addon1">
      </div>
      </form>
      <br>
      <div class="alert alert-success" role="alert"><?php echo $meg; ?></div>

    </div>
    <div class="col-sm-6">
      

      <div class="panel panel-primary">
      <!-- Default panel contents -->
      <div class="panel-heading">Last Pictures</div>
      <div class="panel-body">
      
      </div>

      <!-- Table -->
      <table class="table text-center">
      <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Picture</td>
        <td>Action</td>
      </tr>
      <?php echo $carousel_list; ?>
      </table>
      </div>

    </div> <!-- end col -->
  </div>
</div>

 






     <!-- **************************************************** -->

 <!-- FOOTER -->
 <div id="footer">
        <p>&copy;  Argan Oil &nbsp;2015 &nbsp; </p>
 </div>
    <!--END FOOTER -->


    <!-- GLOBAL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->

    <!-- PAGE LEVEL SCRIPTS -->
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot/jquery.flot.resize.js"></script>
    <script src="assets/plugins/flot/jquery.flot.time.js"></script>
     <script  src="assets/plugins/flot/jquery.flot.stack.js"></script>
    <script src="assets/js/for_index.js"></script>
   
    <!-- END PAGE LEVEL SCRIPTS -->


</body>

    <!-- END BODY -->
</html>