<?php
session_start();
require_once 'connection.php';


   


    if (isset($_POST["save"])&&isset($_SESSION['useruid'])) {
        $searchKey=$_SESSION['useruid'];
        $sql=mysqli_query($conn, "SELECT usersId  FROM users where usersUid='$searchKey'");
        $row  = mysqli_fetch_array($sql);
        $IDs= intval($row['usersId']); 


        $result=$_REQUEST["selected"];
        $link=$_REQUEST["web"];
        $annotation=$_REQUEST["annotation"];
        $tags=$_REQUEST["tags"];






        $maxsize=524288000;

        if (isset($_FILES['file']['name'])&& $_FILES['file']['name'] !='') {
            $name=$_FILES['file']['name'];
            $target_dir="upload/";
            $target_file=$target_dir.$name;
            $extension=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extension_arr=array("mp4","avi","3gp","mov","mpeg","webm");
            if (in_array($extension, $extension_arr)) {
                if ($_FILES['file']['size'] >= $maxsize) {
                    echo "<script>alert('File too large')</script>";
                } elseif (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                    $sql="INSERT INTO annotation(userID,AnnotatedText,AnnotationText,tags,website,video) VALUES (?,?,?,?,?,?);";

                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("location:../new.php?error=stmtFailed");
                    }
                    mysqli_stmt_bind_param($stmt, "ssssss", $IDs, $result, $annotation, $tags, $link, $target_file);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    mysqli_query($conn, $sql);



                    // header("location:welcome.php");
                }
            } else {
                echo "<script>alert('Invalid file extension')</script>";
            }
        } else {
            echo "<script>alert('please select a file')</script>";
        }
    }


    // if (isset($_POST["show"])) {
    //     $result=$_REQUEST["selected"];
    //     $link=$_REQUEST["web"];
    //     $id=$_REQUEST["id"];


    //     require_once 'connection.php';
    //     require_once 'functions.inc.php';
    //     $sql=mysqli_query($conn, "SELECT AnnotatedText,AnoId  FROM Annotaion where website='$link'");
    //     $row  = mysqli_fetch_array($sql);
    // }

 




