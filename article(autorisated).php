<?php 

    session_start();

    # Подключение БД
    require_once('db.php');
    if ($_GET['articleid']) { 
      $getarticleid     = $_GET['articleid'];
      #проверка на sql инъекции
       if(!(is_numeric($getarticleid))){
           header('location: index.php');
       }

      $article     = pg_query($link, "SELECT id_user,name_lector,id,name,price,publicr.product.id_lector,duration,description,art FROM publicr.product, publicr.lectors
                                      WHERE id = '$getarticleid'AND publicr.product.id_lector = publicr.lectors.id_lector
                                      AND id_user = '".$_SESSION['user']['id']."';");
      $article_row = pg_fetch_assoc($article);

      if($article_row['id_user'] !== $_SESSION['user']['id']){
         header('location: index.php');
      }
    

      if ($_POST['description-name']){
         $descrition = $_POST['description-name'];
         $sql = "UPDATE publicr.product SET name='".$descrition."' WHERE id = '".$article_row['id']."'";
         pg_query($link,$sql);
         header( "Location: #", true, 303 );
          exit();   
     }


      if ($_POST['description-duration']){
         $duration = $_POST['description-duration'];
         if(is_numeric($duration)){
            $duration_it = (int)$duration;
            if(is_int($duration_it) && $duration_it > 0){
               $sql = "UPDATE publicr.product SET duration='".$duration_it."' WHERE id = '".$article_row['id']."'";
               pg_query($link,$sql);
               header( "Location: #", true, 303 );
               exit();   
            }
         }
         }

         
         if ($_POST['description-price']){
            $price = $_POST['description-price'];
            if(is_numeric($price)){
               $price_it = (int)$price;
               if(is_int($price_it) && $price_it > 0){
                  $sql = "UPDATE publicr.product SET price='".$price_it."' WHERE id = '".$article_row['id']."'";
                  pg_query($link,$sql);
                  header( "Location: #", true, 303 );
                  exit();   
               }
            }
            }
            

         if ($_POST['description-text']){
            $text = $_POST['description-text'];
               $sql = "UPDATE publicr.product SET description='".$text."' WHERE id = '".$article_row['id']."'";
               pg_query($link,$sql);
               header( "Location: #", true, 303 );
               exit();   
            }
   }

 ?>

<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
   <title>Главная страница</title>
   <!-- CSS -->
   <link rel="stylesheet" href="css/style.css">


</head>

<body>
   <!-- Шапка сайта -->
   <?php
        include('header.php');
     ?>

   <main class="page">

      <div class="article-container">
         <div class="top-article">
            <div>
               <p class="crop"><span><img src="img/<?=$article_row['art']?>.jpg" alt="" class="preview"></span></p>
            </div>
            <div class="top-article-right">
               <div class="icheika-text">
                  <h2>
                     <?=$article_row['name']?><button class="edit" id="edit-name-article"> </button>
                  </h2>
                  <form  method="post" action="#" id="description-name-form"class="description-name-change" >
                        <textarea name="description-name" id="description-name" cols="15" rows="2" class="description-name"><?=$article_row['name']?> </textarea>
                        <input type="submit"  value="Загрузить" class="button-standard">
                  </form>
               </div>
               <div>
                  <span>
                     Лектор:
                     <?=$article_row['name_lector']?>
                    
                  </span>
               </div>
               <div>
                  <span>
                     Длительность:<?=$article_row['duration']?> мин.<button class="edit" id="edit-duration-article"> </button>
                     <form  method="post" action="#" id="description-duration-form"class="description-name-change" >
                        <textarea name="description-duration" id="description-duration" cols="15" rows="2" class="description-name"><?=$article_row['duration']?> </textarea>
                        <input type="submit"  value="Загрузить" class="button-standard">
                     </form>
                     
                  </span>
               </div>
               <div>
                  <span>
                     Стоимость:<?=$article_row['price']?> руб.<button class="edit" id="edit-price-article"> </button>
                     <form  method="post" action="#" id="description-price-form"class="description-name-change" >
                        <textarea name="description-price" id="description-price" cols="15" rows="2" class="description-name"><?=$article_row['price']?> </textarea>
                        <input type="submit"  value="Загрузить" class="button-standard">
                     </form>
                  </span>
               </div>
               
            </div>
         </div>
         <div class="BOTTOM-ARTICLE">
            <span>
               <?=$article_row['description']?><button class="edit" id="edit-text-description-article"> </button>
               <form  method="post" action="#" id="description-text-form"class="description-name-change" >
                     <textarea name="description-text" id="description-text" cols="25" rows="10" class="description-text"><?=$article_row['description']?> </textarea>
                     <input type="submit"  value="Загрузить" class="button-standard">
               </form>
            </span>
         </div>

      </div>

   </main>


   </div>
   <?php 
    include('footer.php');
    ?>

   <script type="text/javascript" src="js/script.js"></script>

</body>

</html>