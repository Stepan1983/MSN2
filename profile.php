<?php
session_start();
  $host = 'sbasta4e.beget.tech'; // имя хоста
  $user = 'sbasta4e_1';    // имя пользователя
  $pass = 'CHEmpion_123';          // пароль
  $name = 'sbasta4e_1'; 
      
  $query = "SELECT * FROM dataUsers WHERE id = $_GET[userId]";
  $link = mysqli_connect($host, $user, $pass, $name);
  $result = mysqli_query($link, $query) or die(mysqli_error($link));

 if(isset($_GET['userId'])) {
   //echo $_GET['userId'];
   $_SESSION['userId'] = $_GET['userId'];
   if($_SESSION['auth']) {
     include'layoutLogged.html';
     include 'guestProfile.php';
     include 'events.php';
   } else {
     include'layoutLogout.html';
     include 'guestProfile.php';
   }
   
 } else {
   echo "Такого пользователя не существует";
 }




?>