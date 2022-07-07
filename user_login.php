<?php

include 'config.php';

session_start();

if(isset($_POST['login'])){

   $email = $_POST['email'];
 
   $pass = $_POST['pass'];
  

   $select_user = $conn->prepare("SELECT * FROM `user` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:index.php');
   }else{
      header('location:index.php');
   }

}

?>