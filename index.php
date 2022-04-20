<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location: login.php");
}?>
<!Doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="js/vendor/jquery-1.12.0.min.js"></script>

  </head>
  <body>
	  <?php include "thome.php";include 'includes/config.php';?>
	  	<form id="addSubjectForm">
			<div class="container">
                <div class="row">
                    <?php $subject=mysqli_query($conn,"select * from subject");
                    while($subjectData=mysqli_fetch_array($subject)){?>
                    <div class="col-md-4 shadow rounded">
                        <div class="card mt-4" style="cursor:pointer;" onclick="addPractical('<?=$subjectData['sub_code']?>')">
                            <div id="mainContainer0" class="card-body p-4 d-flex align-items-center justify-content-center" style="height:200px;">
                                <span><?=$subjectData['sub_code']." - ".$subjectData['sub_name']?></span>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
			</div>
		</form>
 </body>
 <script>
    var session="<?=$_SESSION['type']?>";
    function addPractical(e){
        if(session=="student") window.location.href="test.php?id="+e;
        else window.location.href="practicallist.php?id="+e;
    }
 </script>
 </html>