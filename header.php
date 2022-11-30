<header>
<div class="top-header">
   <div class="left-box-header">
   <!-- <a href="index.php"><img src="img/logo.jpg" alt="" class="logo"></a> -->
    
     <a href="index.php" class="shapka">ASTRONOMUS</a>
   </div>
   <div class="right-box-header">

         <div class="right-nav">
            <?php
            if($_SESSION['user']['id']){
                 echo $_SESSION['user']['login'];?>
                 <a href="logout.php" class="button-sign margin-lft"><button>Выйти</button></a> 
                 <?php
            }else{ ?>
            <?php //echo $_SESSION['user']['id'];?>
            <div class="button-create">
                <a href="#popup_3" class="popup-link"><button>Создать аккаунт</button></a>
            </div>

            <div class="button-sign">
                <a href="#popup_2" class="popup-link"><button>Войти</button></a>
            </div>
            <?php }?>
            
        </div>
   </div>
</div>

</header>

