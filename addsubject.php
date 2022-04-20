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
	  <?php include "thome.php";?>
	  	<form id="addSubjectForm">
			<div class="container">
				<div class="card mt-4">
					<div class="card-body p-4">
						<div class="row">
							<div class="col-md-12">
								<label for="title" ><b><h2>Add Subject</h2> </b></label>
								<p class="text-center text-light" style="background-color:rgb(255,0,0,0.5);border-radius:5px;" id="errorMessage"></p>
								<p class="text-center text-light bg-success" style="border-radius:5px;" id="successMessage"></p>
							</div>
							<div class="col-6 mb-3">
								<label for="scode" class="form-label"><b>Subject code</b></label>
								<input type="text" class="form-control" name="txtScode" required>
							</div>
							<div class="col-6 mb-3">
								<label for="sname" class="form-label"><b>Subject name</b></label>
								<input type="text" class="form-control" name="txtSname" required>
							</div>
							<div class="col-6 mb-3">
								<label for="fname" class="form-label"><b>Faculty name</b></label>
								<input type="text" class="form-control" name="txtFname" required>
							</div>
							<div class="col-6 mb-3">
								<label for="semester" class="form-label"><b>Semester</b></label><br>
								<select class="custom-select my-1 mr-sm-2"  class="form-control" name="selectSemester" required>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
								</select>
							</div>
							
							<div class="col-6 mb-3">
								<button type="button" class="btn btn-primary" id="btnSave"><b>Save</b></button>
								<button type="button" class="btn btn-primary" id="btnClear"><b>Clear</b></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
 </body>
<script>
	$("#btnSave").on("click", function(){
		$.ajax({
			url: "DBop.php",
			type: "post",
			data: {save: "addSubject", data: $("#addSubjectForm").serializeArray()},
			dataType: "json",
			success: function(resp){
				if(resp.status==0){
					$("#errorMessage").html(resp.message);
				}else if(resp.status==1){
					$("#errorMessage").html("");
					$("#successMessage").html(resp.message);
					$("#btnClear").trigger("click");
				}
			},
			error: function(stat){
				alert(stat.responseText);
			}
		})
	})
	$("#btnClear").on("click",function(){
		$(this).closest('form').find("input[type=text],input[type=email],input[type=number],input[type=password]").val("");
	})
</script>
 </html>