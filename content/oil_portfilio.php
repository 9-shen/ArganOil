<?php 
  require "data/connect.php";

  $req = $conn->query('SELECT upload_id FROM user_uploads');

  $nbre_total_articles = $req->rowCount();

  $nbre_articles_par_page = 16;

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
$oil_portfilio_list="";
  $sql = "SELECT * FROM user_uploads ORDER BY upload_id DESC $limit";
 $req = $conn->query($sql);

while ($row = $req->fetch(PDO::FETCH_OBJ)) {
      $upload_id = $row->upload_id;
      $image_name = $row->image_name;
      $source ="script/gallery/uploads/$image_name";
      $img = $source;

$oil_portfilio_list .='

        <div class="col-lg-3 col-md-3 col-sm-6">

        <div class="section-3-items shrink">
        <img src=" ' .$img. ' " class="img-responsive imgList" alt="">
        </div>

        </div>

';


    }
  $pagination = '';

  if($last_page != 1){
    if($page_num > 1){
      $previous = $page_num - 1;
      $pagination .= '<a href="portfilio.php?page='.$previous.'">Précédent</a> &nbsp; &nbsp;';

      for($i = $page_num - $nbre_pages_max_gauche_et_droite; $i < $page_num; $i++){
        if($i > 0){
          $pagination .= '<a href="portfilio.php?page='.$i.'">'.$i.'</a> &nbsp;';
        }
      }
    }

    $pagination .= '<span class="active">'.$page_num.'</span>&nbsp;';

    for($i = $page_num+1; $i <= $last_page; $i++){
      $pagination .= '<a href="portfilio.php?page='.$i.'">'.$i.'</a> ';
      
      if($i >= $page_num + $nbre_pages_max_gauche_et_droite){
        break;
      }
    }

    if($page_num != $last_page){
      $next = $page_num + 1;
      $pagination .= '<a href="portfilio.php?page='.$next.'">&nbsp; &nbsp; Suivant</a> ';
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
  echo $oil_portfilio_list;
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