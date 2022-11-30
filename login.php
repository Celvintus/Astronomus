<?php
	session_start();

	# Подключение БД
   require_once('db.php');


if (isset($_POST['submit_login'])) {
   if ($_POST['email_login'] && $_POST['password_login']) {
      $email_login    = htmlspecialchars($_POST['email_login']);
      $password_login = md5($_POST['password_login']);
      $check_user 	= pg_query($link, "SELECT * FROM publicr.user WHERE login = '$email_login' AND password = '$password_login'");
      $user 			= pg_fetch_assoc($check_user);
      
      if (pg_num_rows($check_user) > 0) {
         if ($user['email_confirmed'] == 0) {
            $_SESSION['message'] = 'Ваш аккаунт не активирован';
            header('location: index.php');
         }
         else {
            $_SESSION['user'] = [
               'id'          	   => $user['id'],
               'login'       	   => $user['login'],
            ];
            header('location: index.php');
         }
      }
      else {
         $_SESSION['message'] = 'Неверно введён логин или пароль';
         header('location: index.php');
      }
   }
   else {
      $_SESSION['message'] = "Поля должны быть заполнены.";
      header('location: index.php');
   }
}