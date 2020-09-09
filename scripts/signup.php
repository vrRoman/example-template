<?php
  require_once 'db-connect.php';
  
  if (isset($_POST['do-signup'])) {
    $full_name = trim($_POST['full_name-reg']);
    $login = trim($_POST['login-reg']);
    $password = trim($_POST['password-reg']);
    $passwordConfirm = trim($_POST['password_confirm-reg']);
  
    $errors = [];
  
    if ($full_name) {
      if (strlen($full_name) > 50) {
        $errors[] = 'Full name is too long';
      } elseif (strlen($full_name) < 5) {
        $errors[] = 'Full name is too short';
      }
      if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/", $full_name)) {
        $errors[] = 'Full name contains forbidden characters';
      }
    } else {
      $errors[] = 'Enter your name';
    }
    
    if ($login) {
      if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email';
      } else {
        $checkEmail = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$login'");
        if (mysqli_num_rows($checkEmail) != 0) {
          $errors[] = 'A user with this email already exists';
        }
      }
    } else {
      $errors[] = 'Enter your email';
    }
    
    if ($password) {
      if (strlen($password) < 5) {
        $errors[] = 'Password must be at least 5 characters';
      } elseif (strlen($password) > 50) {
        $errors[] = 'Password is too long';
      }
    } else {
      $errors[] = 'Enter your password';
    }
    if ($passwordConfirm) {
      if ($passwordConfirm !== $password) {
        $errors[] = 'Passwords mismatch';
      }
    } else {
      $errors[] = 'Confirm your password';
    }
    
    if ($errors) {
      echo '<div class="reg-errors">';
      foreach ($errors as $error) {
        echo '<div class="error">' . $error . '</div>';
      }
      echo '</div>';
      
      echo "<script>
        document.querySelector('.registration-button').classList.add('active-btn')
        document.querySelector('.login-button').classList.remove('active-btn')
        document.querySelector('.registration-block').classList.add('active-block')
        document.querySelector('.login-block').classList.remove('active-block')
      </script>";
    } else {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO `users` (`id`, `full_name`, `email`, `password`) VALUES (NULL, '$full_name', '$login', '$password')";
      
      mysqli_query($connect, $query);
      echo '<script>
        document.querySelector(".reg-successful").style.display = "inline-block"
      </script>';
    }
  }