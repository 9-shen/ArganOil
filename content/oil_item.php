<?php 
require 'data/connect.php';
error_reporting(E_ALL & ~E_NOTICE);
if ($_GET['it'] == 'show') {
	$item_id = intval($_GET['id']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $item = "SELECT * FROM products WHERE product_id='$item_id'";
     $itemStmt = $conn->query($item);
     $itemCount = $itemStmt->rowCount();
     if ($itemCount > 0) {
     	while ($itemRow = $itemStmt->fetch(PDO::FETCH_OBJ)) {
     		$idItem                  = $itemRow->product_id;
     		$titleItem               = $itemRow->title;
     		$product_titleItem       = $itemRow->product_title;
     		$product_descriptionItem = $itemRow->product_description;
     		$item_imgpath = "script/productsuploads/";
		    $item_imgname = $item_imgpath.$idItem.".jpg";
		    $item_image   = $item_imgname;
     	}
     }
}



 ?>
 <style>
 body{
background: #f5f4f4;
 }
.itemshow{
	margin-top: 120px;
	padding: 20px;
}
.itemshow hr {
border-top: 1px solid #990099;
width: 80%;
margin-bottom: 40px;
}
.itemshow h1 {
	margin-bottom: 20px;
}
.itemshow h2 {
  margin-top: 0px;
}
.rowBackground{
	padding: 50px;
}
.itemshow .img-thumbnail{
	background: #fff;
width:100%; height:320px;
}

 </style>
<div class="wow fadeIn itemshow third-bg ">
	<h1 class="first-h firstcolor text-center"><?php echo $titleItem; ?></h1>
	<hr class="center-block">
	<div class="container">
		
		<div class="row rowBackground ">
			<div class="col-lg-4 col-md-4 col-sm-4"><img src="<?php echo $item_image; ?>" class="img-responsive img-thumbnail" ></div>
			<div class="col-lg-8 col-md-8 col-sm8">
				<h2 class="second-h secondcolor"><?php echo $product_titleItem; ?></h2><br>
				<p class="lead"><?php echo $product_descriptionItem; ?> </p>
				


			</div>
		</div>
	</div>
</div>


<?php 
$oil_product_list_1 = "";

// connect to database
  include_once("data/connect.php");
$oil_1 = $conn->query(" SELECT * FROM products ORDER BY RAND()  limit 8 ")or die(mysql_error()) ;
// count the output amount
 $oil_productCount_1 = $oil_1->rowCount();
if($oil_productCount_1 > 0){
  while($oil_row_1 = $oil_1->fetch(PDO::FETCH_BOTH)) {
    
    $oil_id_1 = $oil_row_1['product_id'];
    $oil_title_1 = $oil_row_1['title'];
    $oil_imgpath_1 = "script/productsuploads/";
    $oil_imgname_1 = $oil_imgpath_1.$oil_id_1.".jpg";
    $oil_image_1   = $oil_imgname_1;

$oil_product_list_1 .='

        <div class="col-lg-3 col-md-3 col-sm-6">

        <div class="section-3-items shrink">
        <a href="item.php?it=show&id='.$oil_id_1.'">
        <img src=" ' .$oil_image_1. ' " class="img-responsive" alt=""></a>
        <a href="item.php?it=show&id='.$oil_id_1.'">
        <h3 class="third-h secondcolor">
        <span class=" firstcolor glyphicon glyphicon-stop"></span>' .$oil_title_1. '</h3></a>
        </div>

        </div>

';


    }
}
  else {
    $oil_product_list_1 = "You have no Product listed in your carousel yet";
    
}

 ?>
<div class="section-3 third-bg text-center">

  <h2 class="second-h firstcolor wow fadeIn">Awesome & Great Product</h2>
  <hr class="center-block">
  <p class="lead wow fadeIn">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam vel perspiciatis officia praesentium, tempora temporibus recusandae explicabo. Incidunt laudantium omnis rem dolore voluptates, velit, ullam saepe, dignissimos autem quibusdam, eum!</p>
  <div class="container">
  <div class="row wow zoomIn">

<?php echo $oil_product_list_1; ?>


  </div> <!-- row -->
  </div> <!-- container -->
</div> 