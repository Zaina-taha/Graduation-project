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

   <?php 
    require_once 'connection.php';
     if(isset($_GET['search'])){
        $searchKey = $_GET['search'];
        $sql = "SELECT annotation.*,users.usersUid FROM annotation INNER JOIN users on users.usersId=annotation.userID  WHERE tags LIKE '%$searchKey%'";
        
     }else{
     $sql = "SELECT annotation.*,users.usersUid FROM annotation INNER JOIN users on users.usersId=annotation.userID";
     $searchKey="";
    }

     $result = mysqli_query($conn,$sql);

     
   ?>

   <form action="" method="GET"> 
     <div class="col-md-6">
        <input type="text" name="search" class='form-control' placeholder="Search By Tags" value=<?php echo $searchKey; ?> > 
     </div>
     <div class="col-md-6 text-left">
      <button class="btn">Search</button>
     </div>
   </form>

   <br> 
   <br>
</div>

<table class="table table-bordered">
  <tr>
    <th>Username</th>
    <th>tags</th>
     <th>AnnotatedText</th>
     <th>AnnotationText</th>
     <th>Video</th>
     <th>Website</th>
     
  </tr>
  <?php 
  while( $row = $result->fetch_object() ): 
    ?>
  <tr>
    <td><?php echo $row->usersUid ?></td>
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