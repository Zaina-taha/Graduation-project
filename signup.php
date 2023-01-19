<?php

if(isset($_POST["submit"])){
    $username=$_POST["uid"];
    $email=$_POST["email"];
    $address=$_POST["address"];
    $pwd=$_POST["pwd"];

    require_once 'connection.php';
    require_once 'functions.inc.php';


if(invalidUid($username) !== false){
    header("location:http://localhost/video/login.html?error=invalidUid");
    exit();
}

if(invalidEmail($email) !== false){
    header("location:http://localhost/video/login.html?error=invalidEmail");
    exit();
}

if(uidExists($conn,$username,$email) !== false){

    header("location:http://localhost/video/login.html?error=usernameTakenOrEmail");

    
    exit();
}
 createUser($conn,$username,$email, $address, $pwd);

}
else{
    header("location:http://localhost/video/login.html");
    exit();
}

                  


// echo "<script>alert('Woops! Email or Password is Wrong.')</script>";