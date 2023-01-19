<?php
require_once 'connection.php';
session_start();
// $searchKey=$_SESSION['useruid'];
// echo $searchKey;
if(isset($_SESSION['useruid'])){
  $searchKey=$_SESSION['useruid'];
  $sql = "SELECT annotation.*,users.usersUid FROM annotation INNER JOIN users on users.usersId=annotation.userID  WHERE usersUid LIKE '$searchKey'";
   
}else{
$sql = "SELECT annotation.*,users.usersUid FROM annotation INNER JOIN users on users.usersId=annotation.userID";
$searchKey="";
}

$result = mysqli_query($conn,$sql);

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <meta charset="UTF-8">
  <title>PHP Search</title>
</head>
<body>
<div class="container">
   <div class="row">
   <div class="col-md-8 col-md-offset-2" style="margin-top: 5%;">
   <div class="row">

  
   <br> 
   <br>
</div>
 <table class="table table-bordered">
  <tr>
    <th>tags</th>
     <th>AnnotatedText</th>
     <th>AnnotationText</th>
     <th>Video</th>
     <th>Website</th>
     
  </tr>
  <?php 
  while( $row = $result->fetch_object()): 
    ?>
  <tr>
     <td><?php echo $row->tags ?></td>
     <td><?php echo $row->AnnotatedText ?></td>
     <td><?php echo $row->AnnotationText ?></td>
     <td><?php $location= $row->video; echo "
     <video src='".$location."' controls width='175px' height='175px'> </video>" ?>
     
     <td><?php  $url = $row->website;  echo "<a href='" . $url . "'>" . $url . "</a> " ?></td>
    
  </tr>
  <?php endwhile; ?>
</table>
</div>
</div>
</div>
</body>
</html>