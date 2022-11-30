<?php 

    session_start();

    # Подключение БД
    require_once('db.php');
    // $res = pg_query($link, "SELECT * FROM "public"."user";");
    // $val = pg_fetch_result($res, 1, 0);
    // echo $val['name'];
    // $psq = pg_query($link, "SELECT * FROM publicr.user;");
    // $result = pg_fetch_row($psq);
    
    // while ($row = pg_fetch_row($psq)) {
    //     echo "id: $row[0]  name: $row[1]";
    //     echo "<br />\n";
    //   }
    # Ответ сервера на введённые данные
 
    
    if ($_GET['hash']) {
        $hash     = $_GET['hash'];
        $sql_hash = "SELECT id, email_confirmed FROM publicr.user WHERE hash = '" . $hash . "'";
        $result   = pg_query($link, $sql_hash);
        if ($result) {
            while($row1 = pg_fetch_assoc($result)) { 
                if ($row1['email_confirmed'] == 0) {
                    pg_query($link, "UPDATE publicr.user SET email_confirmed = 1 WHERE id =" .$row1['id']);
                    echo "<script>alert('Ваш аккаунт активирован! Необходимо войти');</script>";
                }
            } 
        } 
    }
    if ($_GET['filt']) {
        $filter     = $_GET['filt'];

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
    <!-- <link rel="stylesheet" href="css/normalize.css"> -->

</head>

<body>
    <!-- Шапка сайта -->
    <?php
        include('header.php');
     ?>

    <main class="page">
        <div class="filter-container">
            <div class="left-filters">
                <div>
                    Фильтры для поиска
                </div>
                <div class="filter-form">
                    <form id="filter-form" class="" >
                     <div class="submenu-container">
                        <select id="selectfilter" name="filt">
                            <option value="all" name="all">Все фильтры</option>
                            <option value="Звёзды" name="Звёзды">Звёзды</option>
                            <option value="Планета" name="Планета">Планета</option>
                        </select>
                        <input type="submit"  value="Загрузить" class="">
                     </div>
                    </form>
                   
                </div>
               
                
            </div>
            <div class="right-filters">
                <a class="basket" href="shop-basket.php">Моя корзина</a>
            </div>
        </div>
        <div class="parent">
        <?php
        if ($_GET['filt']) {
            $sql = pg_query($link,
            "SELECT id,name,price,art FROM publicr.product where type = '".$_GET['filt']."'");
            if ($_GET['filt'] == "all") {
                $sql = pg_query($link,
                "SELECT id,name,price,art FROM publicr.product");
            }
        }else{
            $sql = pg_query($link,
            "SELECT id,name,price,art FROM publicr.product");
        }
         
         while ($result = pg_fetch_array($sql)) {   
        ?>
            <div class="icheika">
                <div>
                    <a href="article.php?articleid=<?=$result['id']?>">
                    <img src="img/<?=$result['art']?>.jpg" alt="" class="preview">
                    </a>
                </div>
                <div class="icheika-text">
                    <span><?=$result['name']?></span>
                    <span><?=$result['price']?> р.</span>
                </div>
            </div>

        <?php }?>

       
            <!-- <div class="icheika">
                <div><img src="img/48.jpeg" alt="" class="preview"></div>
                <div class="icheika-text">
                    <span>Ваня пидр</span>
                    <span>Девочка топ</span>
                </div>

            </div>
            <div class="icheika">2</div>
            <div class="icheika">3</div> -->

        </div>
    </main>



 
    <?php 
    include('footer.php');
    ?>

    <script type="text/javascript" src="js/script.js"></script>

</body>

</html>