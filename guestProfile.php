<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital@0;1&family=PT+Sans+Caption:wght@400;700&display=swap" rel="stylesheet">
  <title>Document</title>
</head>
<body>
  <h2>Профиль пользователя
</h3>
  <div class = "wrapperUser">
    <div class="userImg">
      <img src = "https://papik.pro/uploads/posts/2021-12/1639295657_1-papik-pro-p-sotsseti-klipart-1.png " width = '100px'>
    </div>
    <div class="userTitle">
      <?php
        session_start();
        $id = $_SESSION['id'];
        $host = 'sbasta4e.beget.tech'; // имя хоста
        $user = 'sbasta4e_1';    // имя пользователя
        $pass = 'CHEmpion_123';          // пароль
        $name = 'sbasta4e_1'; 
				    
        $query = "SELECT * FROM dataUsers WHERE id=$_SESSION[userId]";
        $link = mysqli_connect($host, $user, $pass, $name);
    
    		$result = mysqli_query($link, $query);
    		$user = mysqli_fetch_assoc($result);

        echo "<p>Имя: $user[name]</p>";
        echo "<p>Фамилия: $user[surname]</p>";
        echo "<p>О пользователе: $user[title]</p>";

      ?>
    </div>
    
  </div>
  
  
</body>
</html>