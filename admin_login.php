<?php

include 'config.php';

session_start();

if(isset($_POST['login'])){

   $name = $_POST['name'];  
   $pass = $_POST['pass'];
 

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:admin_page.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login</title>

    <!--font link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!--custom style link-->
    <link rel="stylesheet" href="admin_style.css">


</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>
    
<section class="form-container">

    <form action="" method="post">
        <p>if you are not admin, get over here! <span>(ง'̀-'́)ง</span></p>
        <input type="text" name="name" required placeholder="enter your username" maxlength="50" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="pass" required placeholder="enter your password" maxlength="50" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="login now" class="btn" name="login">
        <a href="https://www.youtube.com/watch?v=rRPQs_kM_nw"><input value="Relax meme" class="btn"></a>
        <a href="index.php"><input value="back to shop" class="btn"></a>
    </form>

</section>


</body>
</html>