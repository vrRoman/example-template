<?php
  if (!isset($_SESSION)) {
    session_start();
  }
  require_once 'db-connect.php';
  
  if ( isset($_POST['change-full-name']) ) {
    $full_name = trim($_POST['full-name']);
    $password = trim($_POST['password-full-name']);
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
      if ($full_name == $_SESSION['user']['full_name']) {
        $errors[] = 'New full name matches old';
      }
    } else {
      $errors[] = 'Enter your name';
    }
    if ($password) {
      if (!password_verify($password, $_SESSION['user']['password'])) {
        $errors[] = 'Invalid password';
      }
    } else {
      $errors[] = 'Enter your password';
    }
    
    if ($errors) {
      echo '<script>document.addEventListener("DOMContentLoaded", () => {
        let changeWindow = document.querySelector(".change-full-name"),
            errors = document.createElement("div");
        errors.classList.add("errors");
        let html = "';
      foreach ($errors as $error) {
        echo '<div class=\"error\">'.$error.'</div>';
      }
      echo '";
        errors.innerHTML = html;
        
        changeWindow.querySelector(".container").appendChild(errors);
        changeWindow.classList.remove("disabled");
        })
        </script>';
    } else {
      $email = $_SESSION['user']['email'];
      $query = "UPDATE `users` SET `full_name` = '$full_name' WHERE `email` = '$email'";
      
      mysqli_query($connect, $query);
      echo '<div class="successful">You have successfully changed your full name</div>';
      $_SESSION['user']['full_name'] = $full_name;
    }
    echo '<script>
        document.querySelector(".main-btn").classList.remove("active-btn");
        document.querySelector(".change-btn").classList.add("active-btn");
        document.querySelector(".main").classList.remove("active-block");
        document.querySelector(".change").classList.add("active-block");
        document.querySelectorAll(".line")[0].classList.remove("active-line");
        document.querySelectorAll(".line")[1].classList.add("active-line");
        </script>';
  }
  
  
  
  elseif ( isset($_POST['change-email']) ) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password-email']);
    $errors = [];
  
    if ($email) {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email';
      } else {
        $checkEmail = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");
        if (mysqli_num_rows($checkEmail) != 0) {
          $errors[] = 'A user with this email already exists';
        }
      }
    } else {
      $errors[] = 'Enter your email';
    }
    if ($password) {
      if (!password_verify($password, $_SESSION['user']['password'])) {
        $errors[] = 'Invalid password';
      }
    } else {
      $errors[] = 'Enter your password';
    }
  
    if ($errors) {
      echo '<script>document.addEventListener("DOMContentLoaded", () => {
        let changeWindow = document.querySelector(".change-email"),
            errors = document.createElement("div");
        errors.classList.add("errors");
        errors.innerHTML = "';
      foreach ($errors as $error) {
        echo '<div class=\"error\">'.$error.'</div>';
      }
      echo '"
        document.querySelector(".main-btn").classList.remove("active-btn");
        document.querySelector(".change-btn").classList.add("active-btn");
        document.querySelector(".main").classList.remove("active-block");
        document.querySelector(".change").classList.add("active-block");

        changeWindow.querySelector(".container").appendChild(errors);
        changeWindow.classList.remove("disabled");
        })
        </script>';
    } else {
      $old_email = $_SESSION['user']['email'];
      $query = "UPDATE `users` SET `email` = '$email' WHERE `email` = '$old_email'";
      mysqli_query($connect, $query);
      echo '<div class="successful">You have successfully changed your email</div>';
      $_SESSION['user']['email'] = $email;
    }
    echo '<script>
        document.querySelector(".main-btn").classList.remove("active-btn");
        document.querySelector(".change-btn").classList.add("active-btn");
        document.querySelector(".main").classList.remove("active-block");
        document.querySelector(".change").classList.add("active-block");
        </script>';
  }
  
  
  
  elseif ( isset($_POST['change-password']) ) {
    $new_password = trim($_POST['new-password']);
    $confirm_new_password = trim($_POST['confirm-new-password']);
    $old_password = trim($_POST['old-password']);
    $errors = [];
  
    if ($new_password) {
      if (strlen($new_password) < 5) {
        $errors[] = 'Password must be at least 5 characters';
      } elseif (strlen($new_password) > 50) {
        $errors[] = 'Password is too long';
      }
      if (!password_verify($new_password, $_SESSION['user']['password'])) {
        if ($confirm_new_password) {
          if ($confirm_new_password !== $new_password) {
            $errors[] = 'Passwords mismatch';
          }
        } else {
          $errors[] = 'Confirm your password';
        }
      } else {
        $errors[] = 'New password matches old';
      }
    } else {
      $errors[] = 'Enter your password';
    }
    if ($old_password) {
      if (!password_verify($old_password, $_SESSION['user']['password'])) {
        $errors[] = 'Invalid old password';
      }
    } else {
      $errors[] = 'Enter your old password';
    }
  
    if ($errors) {
      echo '<script>document.addEventListener("DOMContentLoaded", () => {
        let changeWindow = document.querySelector(".change-password"),
            errors = document.createElement("div");
        errors.classList.add("errors");
        errors.innerHTML = "';
      foreach ($errors as $error) {
        echo '<div class=\"error\">'.$error.'</div>';
      }
      echo '";
        document.querySelector(".main-btn").classList.remove("active-btn");
        document.querySelector(".change-btn").classList.add("active-btn");
        document.querySelector(".main").classList.remove("active-block");
        document.querySelector(".change").classList.add("active-block");

        changeWindow.querySelector(".container").appendChild(errors);
        changeWindow.classList.remove("disabled");
        })
        </script>';
    } else {
      $email = $_SESSION['user']['email'];
      $new_password = password_hash($new_password, PASSWORD_DEFAULT);
      $query = "UPDATE `users` SET `password` = '$new_password' WHERE `email` = '$email'";
      mysqli_query($connect, $query);
      echo '<div class="successful">You have successfully changed your password</div>';
      $_SESSION['user']['password'] = $new_password;
    }
    echo '<script>
        document.querySelector(".main-btn").classList.remove("active-btn");
        document.querySelector(".change-btn").classList.add("active-btn");
        document.querySelector(".main").classList.remove("active-block");
        document.querySelector(".change").classList.add("active-block");
        </script>';
  }
