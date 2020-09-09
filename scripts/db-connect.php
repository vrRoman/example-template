<?php
  $connect = mysqli_connect('localhost', 'root', '0000');
  if (!$connect) {
    die('Error connect to DB');
  }
  $select_db = mysqli_select_db($connect, 'test');