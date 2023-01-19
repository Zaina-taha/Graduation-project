<?php

if (isset($_POST["submit"])) {
   $username=$_POST["uid"];
   $pwd = md5($_POST['pwd']);


   require_once 'connection.php';
    require_once 'functions.inc.php';
    $sql=mysqli_query($conn,"SELECT * FROM users where usersUid='$username' and usersPwd='$pwd'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        // $_SESSION["userid"]=$uidExists["usersId"];
        $_SESSION["useruid"]=$username;
        // $_SESSION["usersId"]=$usersId;

    //    $user=$_SESSION["useruid"];
        header("Location: welcome.php"); 
    }
    else
    {
        echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
    }
   
}