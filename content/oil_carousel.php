
<?php 
require 'data/connect.php';

 ?>
<div id="carousel-default" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-default" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-default" data-slide-to="1"></li>
    <li data-target="#carousel-default" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  
 <div class="carousel-inner" role="listbox">
  <?php 
$carousel_list ="";
$carousel = "SELECT * FROM carousel WHERE rank=1 ORDER BY date_time DESC LIMIT 1";
$carouselStmt = $conn->query($carousel);
$carouselRow = $carouselStmt->fetch(PDO::FETCH_BOTH);

$carouselId = $carouselRow['carousel_id'];
$carouselImgPath = "script/images/";
$carouselImgName = $carouselImgPath.$carouselId.".jpg";
$carouselImage = $carouselImgName;
$title = $carouselRow['title'];
$caption = $carouselRow['caption'];

?>
    <div class="item active">
      <img src="<?php echo $carouselImage; ?>" class="img-responsive"   alt="...">
      <div class="carousel-caption hidden-xs">
       <h2 class="second-h"><?php echo $title; ?></h2>
       <p class="lead"><?php echo $caption; ?></p>
       
      </div>
    </div>
     <?php 
$carousel_list_2 ="";
$carousel_2 = "SELECT * FROM carousel WHERE rank=2 ORDER BY date_time DESC LIMIT 1";
$carouselStmt_2 = $conn->query($carousel_2);
$carouselRow_2 = $carouselStmt_2->fetch(PDO::FETCH_BOTH);

$carouselId_2 = $carouselRow_2['carousel_id'];
$carouselImgPath = "script/images/";
$carouselImgName_2 = $carouselImgPath.$carouselId_2.".jpg";
$carouselImage_2 = $carouselImgName_2;
$title_2 = $carouselRow_2['title'];
$caption_2 = $carouselRow_2['caption'];

?>

    <div class="item">
      <img src="<?php echo $carouselImage_2; ?>" class="img-responsive"  alt="...">
      <div class="carousel-caption hidden-xs">
       <h2 class="second-h"><?php echo $title_2; ?></h2>
       <p class="lead"><?php echo $caption_2; ?></p>
      </div>
    </div>
      <?php 
$carousel_list_3 ="";
$carousel_3 = "SELECT * FROM carousel WHERE rank=3 ORDER BY date_time DESC LIMIT 1";
$carouselStmt_3 = $conn->query($carousel_3);
$carouselRow_3 = $carouselStmt_3->fetch(PDO::FETCH_BOTH);

$carouselId_3 = $carouselRow_3['carousel_id'];
$carouselImgPath = "script/images/";
$carouselImgName_3 = $carouselImgPath.$carouselId_3.".jpg";
$carouselImage_3 = $carouselImgName_3;
$title_3 = $carouselRow_3['title'];
$caption_3 = $carouselRow_3['caption'];

?>
     <div class="item">
      <img src="<?php echo $carouselImage_3; ?>" class="img-responsive"  alt="...">
      <div class="carousel-caption hidden-xs">
       <h2 class="second-h"><?php echo $title_3; ?></h2>
       <p class="lead"><?php echo $caption_3; ?></p>
       
      </div>
    </div>
    
 </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-default" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-default" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>