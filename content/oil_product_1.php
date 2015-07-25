<?php 
$oil_product_list_1 = "";

// connect to database
  include_once("data/connect.php");
$oil_1 = $conn->query(" SELECT * FROM products WHERE product_category=1 ORDER BY date_time DESC limit 4 ")or die(mysql_error()) ;
// count the output amount
 $oil_productCount_1 = $oil_1->rowCount();
if($oil_productCount_1 > 0){
  while($oil_row_1 = $oil_1->fetch(PDO::FETCH_BOTH)) {
    
    $oil_id_1 = $oil_row_1['product_id'];
    $oil_title_1 = $oil_row_1['title'];
    $oil_cat_1 = $oil_row_1['product_category'];
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

  <a href="items.php?item=c&cat=<?php echo $oil_cat_1; ?>" class="btn btn-default firstcolor wow fadeInDown">Load More Projects</a>
  </div> <!-- row -->
  </div> <!-- container -->
</div> 