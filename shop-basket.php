<?php 

    session_start();

    # Подключение БД
    require_once('db.php');
   if(!$_SESSION['user']['id'])
   header('location: index.php');
   if ($_POST['id_deleate']){
      $id_deleate = $_POST['id_deleate'];

      $sql_deleate = "DELETE FROM publicr.busket WHERE id_user = ".$_SESSION['user']['id']." AND id_product	= ".$id_deleate."";
      $result   = pg_query($link, $sql_deleate);
      header('location: shop-basket.php');
   }
      $sql_all_price = "SELECT SUM(price) FROM publicr.busket,publicr.product
       WHERE id_user = ".$_SESSION['user']['id']." AND id_product = publicr.product.id";
      $result   = pg_query($link, $sql_all_price);
      $price  	 = pg_fetch_assoc($result);
      if($price['sum'] == ""){
         $price['sum'] = 0;
      }
      if($price['sum'] != 0){
         if (isset($_POST['allBuy'])) {
            $sql_deleate_all = "DELETE FROM publicr.busket WHERE id_user = ".$_SESSION['user']['id']."";
            $result   = pg_query($link, $sql_deleate_all);
            $email      =   $_SESSION['user']['login'];
            $subject    =   "Активация аккаунта";
            $message    =   '<p>Вы приобрели товар</p>';
            mail($email, $subject, $message/*, $headers*/);
            header('location: shop-basket.php');
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
         <?php
          $client_product     = pg_query($link, "SELECT publicr.product.id,name,price,duration,art FROM publicr.product,publicr.busket WHERE publicr.product.id = id_product AND id_user = ".$_SESSION['user']['id']."");
         while ($result = pg_fetch_array($client_product)) {   
        ?>
      <div class="container-product">
         <div class="right-container-product">
            <div class="prewiew">
               <img src="img/<?=$result['art']?>.jpg" alt="" class="prewiew-basket">
            </div>
            <div class="info-right-cont">
               <div class="title"><?=$result['name']?></div>
               <div class="duration">Длительность лекции: <?=$result['duration']?>мин.</div>
            </div>
            
            
         </div>
         <div class="price">
         <form class="popup-form" method="post">
                <input type="hidden" name="id_deleate" value="<?=$result['id']?>">
                <input type="image" name="submit" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4Igp3aWR0aD0iMjQiIGhlaWdodD0iMjQiCnZpZXdCb3g9IjAgMCAyNCAyNCIKc3R5bGU9IiBmaWxsOiMwMDAwMDA7Ij48cGF0aCBkPSJNIDQuNzA3MDMxMiAzLjI5Mjk2ODggTCAzLjI5Mjk2ODggNC43MDcwMzEyIEwgMTAuNTg1OTM4IDEyIEwgMy4yOTI5Njg4IDE5LjI5Mjk2OSBMIDQuNzA3MDMxMiAyMC43MDcwMzEgTCAxMiAxMy40MTQwNjIgTCAxOS4yOTI5NjkgMjAuNzA3MDMxIEwgMjAuNzA3MDMxIDE5LjI5Mjk2OSBMIDEzLjQxNDA2MiAxMiBMIDIwLjcwNzAzMSA0LjcwNzAzMTIgTCAxOS4yOTI5NjkgMy4yOTI5Njg4IEwgMTIgMTAuNTg1OTM4IEwgNC43MDcwMzEyIDMuMjkyOTY4OCB6Ij48L3BhdGg+PC9zdmc+" alt="Submit" class="deleate-btn" />
         </form>
          <span class="price-shop"><?=$result['price']?>руб.</span>
         </div>
      </div>
      <?php }?>
      <div class="ahui-buy">
         <span>цена: <?=$price['sum']?>руб.</span>
         <form class="popup-form" method="post">
                <input type="submit" name="allBuy" value="Купить лекции" class=""/>
         </form>
      </div>
   </main>

   </div>
   <?php 
    include('footer.php');
    ?>
   <script type="text/javascript" src="js/script.js"></script>
</body>
</html>