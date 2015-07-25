<?php 
session_start();
if(!isset($_SESSION['logged_in'])){

header('location: index.php');

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
        


<?php include_once ('includes/header.php'); ?>

<?php include_once ('includes/right_side.php'); ?>

 

        <!-- **************************************************** -->
      <!--PAGE CONTENT -->
    
<?php include_once ('includes/admin_dash.php'); ?>



                  <!--END BLOCK SECTION -->

                <hr />
                   <!-- CHART & CHAT  SECTION -->
                 <div class="row">
                 <?php include_once ('includes/last_photos.php'); ?>


              <?php include_once ('includes/last_message.php'); ?>

                    

                
            </div>

        </div>
        <!--END PAGE CONTENT -->
                <!-- **************************************************** -->

<!-- RIGHT STRIP  SECTION -->
        <div id="right">

            
            <div class="well well-small">
                <ul class="list-unstyled">
                   
                    <li>Today &nbsp; : <span><?php echo date("l"); ?></span></li>
                    <li>Date &nbsp;&nbsp;&nbsp;&nbsp;  : <span><?php echo date("d/m/y"); ?></span></li>
                </ul>
            </div>
            <div class="well well-small">
                <button class="btn btn-block"><a href="../index.php" target="_blank" class="btn">Home</a>  </button>
                <button class="btn btn-danger btn-block"><a href="../" target="_blank" class="btn ">Products</a></button>
                <button class="btn btn-info btn-block"> <a href="../portfilio.php" target="_blank" class="btn ">Gellery</a> </button>
                <button class="btn btn-success btn-block"> <a href="../company.php" target="_blank" class="btn ">About Us </a> </button>
                <button class="btn btn-danger btn-block"><a href="../contact.php" target="_blank" class="btn ">Contact</a>  </button>
                
            </div>
            
          
            
         

        </div>
         <!-- END RIGHT STRIP  SECTION -->
    </div>

    <!--END MAIN WRAPPER -->

   




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