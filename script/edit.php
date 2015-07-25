<?php 
session_start();
if(!isset($_SESSION['logged_in'])){

header('location: index.php');

}
 ?>
<?php 

$meg="";

  require '../data/connect.php';
   error_reporting(E_ALL & ~E_NOTICE);
     if ($_GET['c'] == 'edit') {
        
      $id = intval($_GET['id']);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM carousel WHERE carousel_id='$id'";
      $stmt= $conn->query($sql);
      $row = $stmt->fetch(PDO::FETCH_OBJ);
     
      if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $caption = $_POST['caption'];
        if($_FILES['fileField']['tmp_name'] != ""){
  $maxfilesize = 1000000;
   if($_FILES['fileField']['size'] > $maxfilesize){
     $meg = '<p class="error_message"> Votre Images été Grand !".</p>';
     unlink($_FILES['fileField']['tmp_name']);
      
}elseif(!preg_match('/\.(gif|jpg|png)$/i',$_FILES['fileField']['name'])){ 
  
  $meg = '<p class="error_message"> Votre Image Format nest pas accepté.</p>';
  unlink($_FILES['fileField']['tmp_name']);
  
}else{
        $update ="UPDATE carousel SET title=:title, caption=:caption WHERE carousel_id='$id'";
        $updateStmt = $conn->prepare($update);
        $updateStmt->bindParam(':title', $title, PDO::PARAM_STR);
         $updateStmt->bindParam(':caption', $caption, PDO::PARAM_STR); 
         $updateStmt->execute();

         $newname = "$id.jpg";
         $uploads = "images";
         $tmp_name = $_FILES['fileField']['tmp_name'];
         move_uploaded_file($tmp_name, "$uploads/$newname");
        
          if ($updateStmt) {
            $meg ="Great, Your Data Are Updated with Successfully!.";
          }

         header('location: carousel.php');




      }
      }
      }
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

                    <!-- MESSAGES SECTION -->
                                       <a href="administrator.php" class="btn"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>

                    <!--END MESSAGES SECTION -->

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
    <div class="col-sm-12">
      <form action="" enctype="multipart/form-data" method="POST">

      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Title</span>
        <input type="text" class="form-control" name="title" maxlength="20" placeholder="Username Max 20 Characters" aria-describedby="basic-addon1" value="<?php echo $row->title; ?>">
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Caption</span>
        <textarea name="caption" class="form-control" maxlength="255" placeholder="Caption Max 255 Characters"><?php echo $row->caption; ?></textarea>
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
          <option value="<?php echo $row->rank; ?>"><?php echo $row->rank; ?></option>
        <option value="1">1st</option>
        <option value="2">2nd</option>
        <option value="3">3th</option>
        </select>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Update Item</span>
        <input type="submit" class="form-control btn btn-primary" name="submit" value="Update" aria-describedby="basic-addon1">
      </div>
      </form>
      <br>
      <div class="alert alert-success" role="alert"><?php echo $meg; ?></div>

    </div>
   
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