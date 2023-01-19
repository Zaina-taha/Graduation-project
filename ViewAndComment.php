<?php
require_once 'connection.php';
session_start();
    $Ano= $_GET['ID'];
    $sql = "SELECT comments.*,users.usersUid FROM comments INNER JOIN users on users.usersId=comments.userId WHERE annotationID='$Ano'";
    $result = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style>
    body {

        margin: 0;
        background: linear-gradient(rgba(114, 106, 106, 0.5), rgba(139, 135, 135, 0.5)), url("TTT.jpg");
        font: 600 16px/18px 'Open Sans', sans-serif;
        background-repeat: no-repeat;
        height: 100%;
        background-position: center;
        background-size: cover;


    }

    .theHead {

        text-align: center;
    }

    p {
        font-size: 18px;
        margin: 2px;
        padding: 8px;
        color: #F6F9FE;
    }



    .button-17 {

        align-items: center;
        font-family: Comic Sans MS;
        appearance: none;
        background-color: #fff;
        margin: 1px;
        border-radius: 24px;
        border-style: none;
        box-shadow: rgba(0, 0, 0, .2) 0 3px 5px -1px, rgba(0, 0, 0, .14) 0 6px 10px 0, rgba(0, 0, 0, .12) 0 1px 18px 0;
        box-sizing: border-box;
        color: #3c4043;
        cursor: pointer;
        font-size: 16px;
        fill: currentcolor;
        display: inline-block;
        font-weight: 500;
        height: 48px;
        justify-content: center;
        letter-spacing: .25px;
        line-height: normal;
        max-width: 100%;
        overflow: visible;

        text-align: center;
        text-transform: none;
        transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1), opacity 15ms linear 30ms, transform 270ms cubic-bezier(0, 0, .2, 1) 0ms;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        width: 120px;
        height: 50px;
        will-change: transform, opacity;
        z-index: 0;
    }

    .button-17:hover {
        background: #F6F9FE;
        color: #4596cf;
    }

    .button-17:active {
        box-shadow: 0 4px 4px 0 rgb(60 64 67 / 30%), 0 8px 12px 6px rgb(60 64 67 / 15%);
        outline: none;
    }

    .button-17:focus {
        outline: none;
        border: 2px solid #4285f4;
    }

    .button-17:not(:disabled) {
        box-shadow: rgba(60, 64, 67, .3) 0 1px 3px 0, rgba(60, 64, 67, .15) 0 4px 8px 3px;
    }

    .button-17:not(:disabled):hover {
        box-shadow: rgba(60, 64, 67, .3) 0 2px 3px 0, rgba(60, 64, 67, .15) 0 6px 10px 4px;
    }

    .button-17:not(:disabled):focus {
        box-shadow: rgba(60, 64, 67, .3) 0 1px 3px 0, rgba(60, 64, 67, .15) 0 4px 8px 3px;
    }

    .button-17:not(:disabled):active {
        box-shadow: rgba(60, 64, 67, .3) 0 4px 4px 0, rgba(60, 64, 67, .15) 0 8px 12px 6px;
    }

    .button-17:disabled {
        box-shadow: rgba(60, 64, 67, .3) 0 1px 3px 0, rgba(60, 64, 67, .15) 0 4px 8px 3px;
    }


    input[type=text] {
        width: 250px;
        height: 100px;
        padding: 10px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        margin: 15px;

        background-color: #f8f8f8;
        font-size: 16px;
        resize: none;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: grey;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;

        /* Position the tooltip */
        position: absolute;
        z-index: 1;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
    }

    .btnclass {
        display: flex;
        justify-content: center;
    }
    .btnclass1 {
        display: flex;
        justify-content: flex-start;
    }

    button.margin-right {
        margin-right: 10px;
    }

    .Mybrd {
        border-top: double;
        padding: 10px;
    }

    button {
        width: 150px;
        padding: 10px;
        display: block;
        margin: 20px auto;
        border: 2px solid #111111;
        cursor: pointer;
        background-color: white;
    }

    #start-camera {
        margin-top: 50px;
    }

    #video {
        display: none;
        margin: 50px auto 0 auto;
    }

    #start-record,
    #stop-record,
    #download-video {
        display: none;
    }

    #download-video {
        text-align: center;
        margin: 20px 0 0 0;
    }
    .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 1);
}
.styled-table thead tr {
    background-color: white;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color:white;
}
.styled-table tbody tr:nth-of-type(odd) {
    background-color:white;
}



.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    /* color: #009879; */
}
    </style>


</head>
<br>
<body onload="checkCookie1();website1();">

<div class="btnclass1">
        <p>AnnotatedText:</p>
        <p  id="AnnotatedT" name="AnnotatedT"> </p>
        <p>AnnotationText:</p>
        <p  id="AnnotationT" name="AnnotationT"> </p>
        <p>Tags:</p>
        <p  id="Tags1" name="Tags1"> </p>
        </div>
        <div class="btnclass1" >
        
        <p>Link:</p>
        <p  id="website" name="website"> </p>
        <p>Video : </p>
        <video id="myVideo" controls width="300" height="240"></video>
        
        </div>
        <br>
        <br>
        <div class="container">
   <div class="row">
   <div class="col-md-8 col-md-offset-2" style="margin-top: 5%;">
   <div class="row">

  
   <br> 
   <br>
</div>
 <table class="styled-table">
  <tr>
     <th>username</th>
     <th>AnnotationText</th>
     <th>tags</th>
     <th>Video</th>
     
  </tr>
  <?php 
  while( $row = $result->fetch_object()): 
    ?>
  <tr class="active-row">
     <td><?php echo $row->usersUid ?></td>
     <td><?php echo $row->AnnotationText ?></td>
     <td><?php echo $row->tags ?></td>
     <td><?php $location= $row->video; echo "
     <video src='".$location."' controls width='175px' height='175px'> </video>" ?>
     
    
  </tr>
  <?php endwhile; ?>

        

    <form method="POST" action="comments.inc.php"  enctype="multipart/form-data">
       <p >Add Comments:</p>
        <input type="hidden" name="selected" id="selected"/>
        <input type="hidden"  name="web" id="web" />
        <div class="col">
            <p class="col-sm-2 " style="color: #F6F9FE;"> <b> Write your notation</b> </p>
            <input class="form-control" type="text" id="annotation" name="annotation" />
        </div>
        <div class="col">
            <p class="col-sm-2" style=" color: #F6F9FE;"> <b> Write your tags</b> </p>
            <input class="form-control" type="text" id="tags" name="tags" />
        </div>
        <input type="file" name="file">

        <div class="btnclass">
            <button onclick="save()"class="button-17" type="submit" id="save" name="save" >Save</button>

        <form  method="post" action="welcome.php" target="_blank">
     <button  onclick="login()" class="button-17" role="button"> <strong> Login </strong></button>
     </div>
  <p style="color: #F6F9FE;"><strong>Tip:</strong> <small>Save will still unabled until you logged in </small></p>
</form>


    </form>

    <p class="Mybrd" style="color: #F6F9FE;"> </p>
    <button id="start-camera">Start Camera</button>
    <video id="video" width="320" height="240" autoplay=""></video>
    <button id="start-record">Start Recording</button>
    <button id="stop-record">Stop Recording</button>
    <a id="download-video" download="test.webm">Download Video</a>

    <script>
    let camera_button = document.querySelector("#start-camera");
    let video = document.querySelector("#video");
    let start_button = document.querySelector("#start-record");
    let stop_button = document.querySelector("#stop-record");
    let download_link = document.querySelector("#download-video");

    let camera_stream = null;
    let media_recorder = null;
    let blobs_recorded = [];

    camera_button.addEventListener('click', async function() {
        try {
            camera_stream = await navigator.mediaDevices.getUserMedia({
                video: true,
                audio: true
            });
        } catch (error) {
            alert(error.message);
            return;
        }

        video.srcObject = camera_stream;
        camera_button.style.display = 'none';
        video.style.display = 'block';
        start_button.style.display = 'block';
    });

    start_button.addEventListener('click', function() {
        media_recorder = new MediaRecorder(camera_stream, {
            mimeType: 'video/webm'
        });

        media_recorder.addEventListener('dataavailable', function(e) {
            blobs_recorded.push(e.data);
        });

        media_recorder.addEventListener('stop', function() {
            let video_local = URL.createObjectURL(new Blob(blobs_recorded, {
                type: 'video/webm'
            }));
            download_link.href = video_local;

            stop_button.style.display = 'none';
            download_link.style.display = 'block';
        });

        media_recorder.start(1000);

        start_button.style.display = 'none';
        stop_button.style.display = 'block';
    });

    stop_button.addEventListener('click', function() {
        media_recorder.stop();
    });
    </script>

</body>

<script>
function checkCookie1() {
    var params = new URLSearchParams(window.location.search);
       searchTerm = params.get("searchTerm");
       AnnotationText=params.get("AnnotationText");
       website=params.get("website");
       tags=params.get("tags");
       video=params.get("video");

      document.getElementById("AnnotatedT").innerHTML=searchTerm;
      document.getElementById("AnnotationT").innerHTML=AnnotationText;
      document.getElementById("Tags1").innerHTML=tags;
      document.getElementById("website").innerHTML=website;

    var video2 = document.getElementById("myVideo");
    video2.src = video;
    video2.muted = true;
    video2.playsinline = true;

    video2.play();

}

function website1()
   {
    
      link=document.getElementById("website").innerHTML;
      var webb=document.getElementById("web");
      webb.value=link;

      link=document.getElementById("AnnotatedT").innerHTML;
      var resultt=document.getElementById("selected");
      resultt.value=link;
   }


</script>


<script>
function save(){
    web = document.getElementById("web").value;
	tags = document.getElementById("tags").value;
    selected = document.getElementById("selected").value;
    annotation = document.getElementById("annotation").value;

  
    fileName = "comments.inc.php?web=" + web + "&tags=" + tags +"$selected"+selected+"$annotation"+annotation;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", fileName, true);
    xmlhttp.send();
}

function login()
   {
    
    
     window.open("http://localhost/video/login.html")
  
   }

	
 </script>



