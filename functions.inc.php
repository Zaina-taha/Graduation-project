<?php
    session_start();

function invalidUid($username){

    $result="";
    if(preg_match("/^[a-zA-Z0-9]*$/",$username)){
     $result=true;
    }
     $result=false;
    return $result;
}

function invalidEmail($email){
    $result="";
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $result=true;                                                                                                           
    }
     $result=false;
    return $result;
}

  function uidExists($conn, $username, $email){

   $sql="SELECT*FROM users WHERE usersUid=? OR usersEmail=?;";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt,$sql)){
    header("location:../signup.html?error=stmtFailed");
   }

   mysqli_stmt_bind_param($stmt,"ss", $username, $email);
   mysqli_stmt_execute($stmt);

   $resultData= mysqli_stmt_get_result($stmt);
   $row = mysqli_fetch_assoc($resultData);
   if(mysqli_fetch_assoc($resultData)){
    return $row;
   }
    $result=false;
    return $result;

    mysqli_stmt_close($stmt);
   }

   function createUser($conn,$username,$email, $address, $pwd){
    $pmd5=md5($pwd);
    $sql="INSERT INTO users(usersUid,usersEmail,usersAddr,usersPwd) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
     header("location:../signup.html?error=stmtFailed");
    }
    $pmd5=md5($pwd);
     mysqli_stmt_bind_param($stmt,"ssss", $username, $email,$address, $pmd5);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: welcome.php"); 
    
    }


       
    