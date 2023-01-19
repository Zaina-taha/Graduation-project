<?php
session_start();
require_once 'connection.php';
$result=$_REQUEST["selected"];
$link=$_REQUEST["web"];


$sql1=mysqli_query($conn, "SELECT ID FROM annotation where AnnotatedText='$result' and website='$link' ");
$row1  = mysqli_fetch_array($sql1);
$AnoId= intval($row1['ID']); 



    if (isset($_POST["save"])&&isset($_SESSION['useruid'])) {
        $searchKey=$_SESSION['useruid'];
        $sql=mysqli_query($conn, "SELECT usersId  FROM users where usersUid='$searchKey'");
        $row  = mysqli_fetch_array($sql);
        $IDs= intval($row['usersId']); 

        $result=$_REQUEST["selected"];
        $link=$_REQUEST["web"];
        $annotation=$_REQUEST["annotation"];
        $tags=$_REQUEST["tags"];


        $sql1=mysqli_query($conn, "SELECT ID FROM annotation where AnnotatedText='$result' and website='$link' ");
        $row1  = mysqli_fetch_array($sql1);
        $AnoId= intval($row1['ID']); 






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
                    $sql="INSERT INTO comments(userId,annotationID,AnnotationText,tags,video) VALUES (?,?,?,?,?);";

                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("location:../new.php?error=stmtFailed");
                    }
                    mysqli_stmt_bind_param($stmt, "sssss", $IDs, $AnoId, $annotation, $tags, $target_file);

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


   

 




