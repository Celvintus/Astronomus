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

      $article     = pg_query($link, "SELECT id,name,price,id_lector,duration,description,art FROM publicr.product WHERE id = '$getarticleid'");
      $article_row = pg_fetch_assoc($article);
      
      $lector      = pg_query($link, "SELECT id_user,name_lector FROM publicr.lectors WHERE id_lector = '" .$article_row['id_lector']."'");
      $lector_row  = pg_fetch_assoc($lector);
     if($_SESSION['user']['id']){
         if ($lector_row['id_user'] == $_SESSION['user']['id']){
               // echo 'xe,';
               // echo $lector_row['id_user'];
               // echo $_SESSION['user']['id'];
               header('location: article(autorisated).php?articleid='.$getarticleid.'');
            }
     }
  
     
   
   }
      if ($_POST['id']){
            $id = $_POST['id'];
            // echo $id;
            // echo $_SESSION['user']['id'];
            $sqlCheck = "SELECT * FROM publicr.busket WHERE id_product = ".$id." AND id_user = ".$_SESSION['user']['id']."";
            $check = pg_query($link,$sqlCheck);
            //echo pg_num_rows($check);
            //echo $check['id'];
            //if($check['id'] != ""){
            if(pg_num_rows($check) != ""){
               $_SESSION['checkProd'] = 'Вы уже положили в корзину этот товар';
           }else{
             $sql = "INSERT INTO publicr.busket(id_user,id_product) VALUES (".$_SESSION['user']['id'].",".$article_row['id'].");";
            pg_query($link,$sql);
            # делает релокацию на эту же страницу и сбрасывает данные POST-запроса
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
                     <?=$article_row['name']?>
                  </h2>
               </div>
               <div>
                  <span>
                     Лектор:
                     <?=$lector_row['name_lector']?>
                  </span>
               </div>
               <div>
                  <span>
                     Длительность:
                     <?=$article_row['duration']?> мин.
                  </span>
               </div>
               <div>
                  <span>
                     Стоимость:
                     <?=$article_row['price']?> руб.
                  </span>
               </div>
               <?php
                    if ($_SESSION['checkProd']) {
                        echo '<span class="error bottom_error">' . $_SESSION['checkProd'] . '</span>';
                    }
                    unset($_SESSION['checkProd']);
                    ?>
               <div class="article-add">
                  <div class="button-create">
                     <?php
                      if($_SESSION['user']['id']){
                     ?>
                     <form  method="post" action="#" id="add-basket-form"class="basket-form" >
                           <input type="hidden" name="id" value="<?=$article_row['id']?>">
                           <input type="submit"  value="Добавить в корзину" class="button-standard button-bigger">
                     </form>
                  <?php }?>
                  </div>
               </div>
            </div>
         </div>
         <div class="BOTTOM-ARTICLE">
            <span>
               <?=$article_row['description']?>
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