<?php 
$oil_product_list_3 = "";

// connect to database
  include_once("data/connect.php");
$oil_3 = $conn->query(" SELECT * FROM products WHERE product_category=3 ORDER BY date_time DESC limit 4 ")or die(mysql_error()) ;
// count the output amount
 $oil_productCount_3 = $oil_3->rowCount();
if($oil_productCount_3 > 0){
  while($oil_row_3 = $oil_3->fetch(PDO::FETCH_BOTH)) {
    
    $oil_id_3 = $oil_row_3['product_id'];
    $oil_title_3 = $oil_row_3['title'];
    $oil_cat_3 = $oil_row_3['product_category'];
    $oil_imgpath_3 = "script/productsuploads/";
    $oil_imgname_3 = $oil_imgpath_3.$oil_id_3.".jpg";
    $oil_image_3   = $oil_imgname_3;

$oil_product_list_3 .='

        <div class="col-lg-3 col-md-3 col-sm-6">

        <div class="section-3-items shrink">
        <a href="item.php?it=show&id='.$oil_id_3.'">
        <img src=" ' .$oil_image_3. ' " class="img-responsive" alt=""></a>
        <a href="item.php?it=show&id='.$oil_id_3.'">
        <h3 class="third-h secondcolor">
        <span class=" firstcolor glyphicon glyphicon-stop"></span>' .$oil_title_3. '</h3></a>
        </div>

        </div>

';


    }
}
  else {
    $oil_product_list_3 = "You have no Product listed in your carousel yet";
    
}

 ?>
<div class="section-3 third-bg text-center">
  <h2 class="second-h firstcolor wow fadeIn">Awesome & Great Product</h2>
  <hr class="center-block">
  <p class="lead wow fadeIn">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam vel perspiciatis officia praesentium, tempora temporibus recusandae explicabo. Incidunt laudantium omnis rem dolore voluptates, velit, ullam saepe, dignissimos autem quibusdam, eum!</p>
  <div class="container">
  <div class="row wow zoomIn">

 <?php echo $oil_product_list_3; ?>

  <a href="items.php?item=c&cat=<?php echo $oil_cat_3; ?>" class="btn btn-default firstcolor wow fadeInDown">Load More Projects</a>
  </div> <!-- row -->
  </div> <!-- container -->
</div> 