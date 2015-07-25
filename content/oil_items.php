<?php 
  require "data/connect.php";

  $req = $conn->query('SELECT product_id FROM products');

  $nbre_total_articles = $req->rowCount();

  $nbre_articles_par_page = 12;

  $nbre_pages_max_gauche_et_droite = 4;

  $last_page = ceil($nbre_total_articles / $nbre_articles_par_page);

  if(isset($_GET['page']) && is_numeric($_GET['page'])){
    $page_num = $_GET['page'];
  } else {
    $page_num = 1;
  }

  if($page_num < 1){
    $page_num = 1;
  } else if($page_num > $last_page) {
    $page_num = $last_page;
  }

  $limit = 'LIMIT '.($page_num - 1) * $nbre_articles_par_page. ',' . $nbre_articles_par_page;
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //Cette requête sera utilisée plus tard
$oil_product_list_1="";
if ($_GET['item'] == 'c' ) {
  $cat = intval($_GET['cat']);


  $sql = "SELECT * FROM products WHERE product_category=$cat ORDER BY product_id DESC $limit";
 $oil_1 = $conn->query($sql);

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

  $pagination = '';

  if($last_page != 1){
    if($page_num > 1){
      $previous = $page_num - 1;
      $pagination .= '<a href="items.php?page='.$previous.'">Précédent</a> &nbsp; &nbsp;';

      for($i = $page_num - $nbre_pages_max_gauche_et_droite; $i < $page_num; $i++){
        if($i > 0){
          $pagination .= '<a href="items.php?page='.$i.'">'.$i.'</a> &nbsp;';
        }
      }
    }

    $pagination .= '<span class="active">'.$page_num.'</span>&nbsp;';

    for($i = $page_num+1; $i <= $last_page; $i++){
      $pagination .= '<a href="items.php?page='.$i.'">'.$i.'</a> ';
      
      if($i >= $page_num + $nbre_pages_max_gauche_et_droite){
        break;
      }
    }

    if($page_num != $last_page){
      $next = $page_num + 1;
      $pagination .= '<a href="items.php?page='.$next.'">&nbsp; &nbsp; Suivant</a> ';
    }
  }
?> 

    <style>
    
.section-3{
  margin-top: 55px;
}
    
    #pagination{
      background-color: #eaeaea;
      padding: 10px;
    }

    #pagination .active{
      background-color: #012;
      color: #FFF;
      padding: 0px 5px 0px 5px;
      border-radius: 20%;
    }

    .post{
      background-color: #c5c5c5;
      margin-bottom: 10px;
      padding-left: 5px;
      border-radius: 4px;
    }
    </style>
    <div class="section-3 third-bg text-center portfilio">

  <div class="container">
  <div class="row wow zoomIn">
  

 <?php
  echo $oil_product_list_1;
  ?>
     <?php 
      //echo "<p><strong>($nbre_total_articles)</strong> articles au total !<br/>";
     echo "Page <b>$page_num</b> sur <b>$last_page</a>";

     

      echo '<div id="pagination">'.$pagination.'</div>';

      $req->closeCursor();
    ?>


 </div> <!-- row -->
  </div> <!-- container -->
</div> 