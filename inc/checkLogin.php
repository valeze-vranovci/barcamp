<?php 
  include'dbconn.php'; 
?>
 <?php
    ob_start();

    $username=$_POST['username']; 
    $password=$_POST['password']; 

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

   $sql="SELECT * FROM login WHERE username = '" . $username. "' AND password = '" . $password . "' ";

  $result = mysqli_query($conn,$sql);
  $count=mysqli_num_rows($result);

  $row = mysqli_fetch_array($result);
    if($count==1){
        session_start();
    //Ruaj te dhena ne session
        $_SESSION['logged_in'] = TRUE;
        $_SESSION['username']   = $row['username'];
        $_SESSION['password']   = $row['password'];
        header("location:../index.php");
    }
    else {
     echo "Kontrollo te dhenat";
    }
 ?>
