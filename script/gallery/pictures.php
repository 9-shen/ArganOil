<?php 
session_start();
if(!isset($_SESSION['logged_in'])){

header('location: index.php');
}
?>
<?php 
$show_list="";
require '../../data/connect.php';
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$show = "SELECT * FROM user_uploads ORDER BY date_time DESC";
$pic = $conn->query($show); 
$showCount = $pic->rowCount();
if ($showCount > 0) {
  while ($row = $pic->fetch(PDO::FETCH_OBJ)) {
      $upload_id = $row->upload_id;
      $image_name = $row->image_name;
      $source ="uploads/$image_name";
      $img = $source;

     $show_list .='
          
   <div class="col-sm-2">
      <table class="table">
  <tr>
    <td>
      <img src="'.$img.'" alt="" class="imgList">
    </td>
  </tr>
  <tr>
    <td>
      <a href="pictures.php?d=delete&id='.$upload_id.'" class="btn btn-info">Delete</a>
    </td>
  </tr>
</table>

   </div>

  
     ';

  }
}


 ?>
 <?php 

 error_reporting(E_ALL & ~E_NOTICE);
     if ($_GET['d'] == 'delete') {
        
      $id = intval($_GET['id']);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "DELETE FROM user_uploads WHERE upload_id='$id'";
      $stmt= $conn->query($sql);
      header('location: pictures.php');
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
      <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.css" />
      <link rel="stylesheet" href="../assets/css/main.css" />
      <link rel="stylesheet" href="../assets/css/theme.css" />
      <link rel="stylesheet" href="../assets/css/MoneAdmin.css" />
      <link rel="stylesheet" href="../assets/plugins/Font-Awesome/css/font-awesome.css" />
       <link rel="stylesheet" href="../assets/plugins/timeline/timeline.css" />
      <!--END GLOBAL STYLES -->

      <!-- PAGE LEVEL STYLES -->
      <link href="../assets/css/layout2.css" rel="stylesheet" />
         <link href="../assets/plugins/flot/examples/examples.css" rel="stylesheet" />
         <link rel="stylesheet" href="../assets/plugins/timeline/timeline.css" />
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
                    <img src="../assets/img/logo.png" alt="" />
                        
                        </a>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">

                    <!-- MESSAGES SECTION -->
                                      <a href="../administrator.php" class="btn"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>

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


<style>
  .imgList 
{
height: 150px;
width: 100%;
margin-left:5px;
border:1px solid #dedede;
padding:4px;  
float:left; 
}
</style>
       

<div class="container text-center">
  <div class="row">
<?php echo $show_list; ?>
</div>
</div>



     <!-- **************************************************** -->

 

    <!-- GLOBAL SCRIPTS -->
    <script src="../assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->

    <!-- PAGE LEVEL SCRIPTS -->
    <script src="../assets/plugins/flot/jquery.flot.js"></script>
    <script src="../assets/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../assets/plugins/flot/jquery.flot.time.js"></script>
     <script  src="../assets/plugins/flot/jquery.flot.stack.js"></script>
    <script src="../assets/js/for_index.js"></script>
   
    <!-- END PAGE LEVEL SCRIPTS -->


</body>

    <!-- END BODY -->
</html>