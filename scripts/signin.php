<?php
  if (!isset($_SESSION)) {
    session_start();
  }
  
  require_once 'db-connect.php';
  
  if ( isset($_POST['do-login']) ) {
    $login = trim($_POST['login-signin']);
    $password = trim($_POST['password-signin']);
    
    $checkUser = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$login'");

    if (mysqli_num_rows($checkUser) == 0) {
      echo '<div class="login-errors"><div class="error">Wrong login or password</div></div>';
    } else {
      $checkPassword = mysqli_query($connect, "SELECT password FROM `users` WHERE email = '$login'");
      
      if ( password_verify($password, mysqli_fetch_assoc($checkPassword)['password']) ) {
        $user = mysqli_fetch_assoc($checkUser);
        $_SESSION['user'] = [
          "id" => $user['id'],
          "full_name" => $user['full_name'],
          "email" => $user['email'],
          "password" => $user['password']
        ];
        
        header('Location: index.php');
      } else {
        echo '<div class="login-errors"><div class="error">Wrong login or password</div></div>';
      }
    }
  }