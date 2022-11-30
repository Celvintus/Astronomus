<?php 
      session_start();

      # Подключение БД
      require_once('db.php');
    $add_error = "Некоторые поля не заполнены.";

    if (isset($_REQUEST['submit_registration'])) {

      # Проверка корректности заполнения почты
      if (!$_REQUEST['email_login']) {
          $_SESSION['message_error'] = $add_error;
          header('location: index.php');
      }
      else {
        $shielded_email = pg_escape_string($link, $_REQUEST['email']);# Экранирование
        if (pg_num_rows(pg_query($link, "SELECT id FROM publicr.user WHERE login = '$shielded_email'")) > 0) {
            $_SESSION['message_error'] = "Такой пользователь уже существует.";
            header('location: index.php');
        }

        else if  (filter_var($_REQUEST['email_login'], FILTER_VALIDATE_EMAIL)) {
                $email = htmlspecialchars($_REQUEST['email_login']);
                header('location: index.php');
                // echo "Адрес указан корректно.";
                }else{
                $_SESSION['message_error'] = "Адрес указан не правильно.";
                header('location: index.php');
                }
        }
   

          
    }


      # Проверка корректности заполнения пароля
      if (!$_REQUEST['password_login'] || !$_REQUEST['password_login_Repeate']) {
          $_SESSION['message_error'] = $add_error;
          header('location: index.php');
      }
      else {
          if (strlen($_REQUEST['password_login']) < 8 || strlen($_REQUEST['password_login']) > 16) {
              $_SESSION['message_error'] = "Пароль должен содержать не менее 8 и не более 20 символов.";
              header('location: index.php');
          }
          else {
              if ($_REQUEST['password_login'] != $_REQUEST['password_login_Repeate']) {
                  $_SESSION['message_error'] = "Неподтверждённый пароль.";
                  header('location: index.php');
              }
              else {
                  if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_REQUEST['password_login'])) {
                      $_SESSION['message_error'] = "Пароль ненадёжен. Пароль должен содержать: <br> Хотя бы одну букву латинского алфавита; хотя бы одну цифру.";
                      header('location: index.php');
                  }
                  else {
                      $elementary_password  = md5($_REQUEST['password_login']);
                      $shielded_password    = pg_escape_string($link, $elementary_password);

                      if (pg_num_rows(pg_query($link, "SELECT id FROM publicr.user WHERE password = '$shielded_password'")) > 0) {
                          $_SESSION['message_error'] = "Такой пользователь уже существует.";
                          header('location: index.php');
                          
                      }
                      else {
                          $password  = $elementary_password;
                      }
                  }
              }
          }
      }



      # Регистрация аккаунта в БД
      if (isset($email, $password)) {
          $data       = time();
          $hash       = md5($email . time());

          $headers    = "MIME-Version: 1.0\r\n";
          $headers    .= "Content-type: text/html; charset=utf-8\r\n";
          $headers    .= "To: <" .$email. ">\r\n";
          $headers    .= "From: <mail@astronom.ru>\r\n";

          $subject    = "Активация аккаунта";
          $message    =   '<p>
                              Чтобы подтвердить Ваш аккаунт, перейдите по <a href="http://astranom.ru/index.php?hash=' .$hash. '">ссылке</a>
                          </p>';

          $sql_addVal = "INSERT INTO publicr.user ( login,  password, hash, email_confirmed) VALUES (  '$email',  '$password',  '$hash', 0)";
          pg_query($link, $sql_addVal);
          mail($email, $subject, $message/*, $headers*/);
      header('location: index.php');
      }
  