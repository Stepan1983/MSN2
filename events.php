<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
  <?php
  session_start();
  $id = $_SESSION['id']; //id залогиненного
  $host = 'sbasta4e.beget.tech'; // имя хоста
  $user = 'sbasta4e_1';    // имя пользователя
  $pass = 'CHEmpion_123';          // пароль
  $name = 'sbasta4e_1'; 
      
  $id = $elem['id'];

  $query = "SELECT * FROM dataUsers WHERE id=$_SESSION[userId]";
  $link = mysqli_connect($host, $user, $pass, $name);

  $result = mysqli_query($link, $query);
  $user = mysqli_fetch_assoc($result);


     
    if($user['event'] == 1 && $user['id_friends'] == $_SESSION['id'] ) {
      echo "<b style = 'color:green'>Вы подписаны на данного пользователя</b>";
    } else {
      echo "<form method = \"POST\"> 
              <input type=\"hidden\" value = \"1\" name = \"events\" >
              <input type=\"submit\" value = \"Предложить дружбу\">
            </form>";
    }
                    
  if (!empty($_POST['events'])) {
      $host = 'sbasta4e.beget.tech'; // имя хоста
      $user = 'sbasta4e_1';    // имя пользователя
      $pass = 'CHEmpion_123';          // пароль
      $name = 'sbasta4e_1'; 
    
      $event = $_POST['events'];                  
      $link = mysqli_connect($host, $user, $pass, $name);
      $query = "UPDATE dataUsers SET event=$event, id_friends = '$_SESSION[id]' WHERE id = $_SESSION[userId]";
      $result = mysqli_query($link, $query) or die(mysqli_error($link));

      
  }   

        

      ?>
  

  
</body>
</html>