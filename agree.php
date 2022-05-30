<?php
  session_start();
  include 'layoutLogged.html';
  $id = $_SESSION['id']; //id залогиненного
  $host = 'sbasta4e.beget.tech'; // имя хоста
  $user = 'sbasta4e_1';    // имя пользователя
  $pass = 'CHEmpion_123';          // пароль
  $name = 'sbasta4e_1'; 
      
  

  $query = "SELECT * FROM dataUsers WHERE id=$_SESSION[id]";
  $link = mysqli_connect($host, $user, $pass, $name);
  $result = mysqli_query($link, $query);
  $user = mysqli_fetch_assoc($result);
  //echo "<a href = 'profile.php?userId=$user[id_friends]'>пользователь</a>"; 
  

  if($user['event'] == 1 && $user['agree'] != 1) {
    echo "Вам предложил дружбу ";
    echo "<a href = 'profile.php?userId=$user[id_friends]'>пользователь</a>";
    echo "<form method = \"POST\"> 
            <input type=\"hidden\" type = \"checkbox\" value = \"1\" name = \"agree\" >
            <input type=\"submit\" value = \"Принять дружбу\">
          </form>";
  } else {
    echo "Предложений дружбы нет";
  }


                    
  if (!empty($_POST['agree'])) {
    
      $agree = $_POST['agree'];
    
      $host = 'sbasta4e.beget.tech'; // имя хоста
      $user = 'sbasta4e_1';    // имя пользователя
      $pass = 'CHEmpion_123';          // пароль
      $name = 'sbasta4e_1'; 
      
      $link = mysqli_connect($host, $user, $pass, $name);
    
      $query = "UPDATE dataUsers SET agree=$agree WHERE id = '$_SESSION[id]'";
      $result = mysqli_query($link, $query) or die(mysqli_error($link));

      //$query = "SELECT * FROM dataUsers WHERE id=$_SESSION[userId]";
      //$link = mysqli_connect($host, $user, $pass, $name);
    
      //$result = mysqli_query($link, $query);
      //$user = mysqli_fetch_assoc($result);

      

  }   

        

      ?>
  

  
</body>
</html>