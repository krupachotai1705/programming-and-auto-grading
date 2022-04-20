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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="js/vendor/jquery-1.12.0.min.js"></script>


  </head>
  <body>
  	<?php include "thome.php";include 'includes/config.php';?>
	  	<form id="addPracticalForm">
			<div class="container">
				<div class="card mt-4">
					<div class="card-body p-4">
						<div class="row">
							<div class="col-md-12">
								<label for="title" ><b><h2>Add Practicals</h2> </b></label>
								<p class="text-center text-light" style="background-color:rgb(255,0,0,0.5);border-radius:5px;" id="errorMessage"></p>
								<p class="text-center text-light bg-success" style="border-radius:5px;" id="successMessage"></p>
							</div>
							<table class="table table-striped">
						  <thead>
						    <tr>
						      <th scope="col">Practical Name</th>
						      <th scope="col">Aim</th>
								   <th scope="col">Test Cases</th>
									<th> <button type="button" class="btn btn-primary btn-round" id="btnPlus" onclick="addNewRow()"><b class="fa fa-plus"></b></button></th>
						    </tr>
						  </thead>
						  <tbody id="newRow">
						    <tr id="rowId0">
						      <td><input type="text" name="practical[]" class="form-control"></td>
						      <td><textarea name="aim[]" class="form-control" style="height:40px;"></textarea></td>
						      <td><input type="text" name="testCase[]" class="form-control"></td>
						      <td><button type="button" class="btn btn-danger btn-round" id="btnDel" onclick="deleteRow(0)"><b class="fa fa-trash"></b></button></td>
						    </tr>
						    
						  </tbody>
					</table>
							<div class="col-6 mb-3">
								<button type="button" class="btn btn-primary" id="btnSave"><b>Save</b></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
 </body>
 <script>
	 var dropdown=1;
	 var id="<?=$_GET['id']?>";
	 $("#btnSave").on("click", function(){
		$.ajax({
			url: "DBop.php",
			type: "post",
			data: {save: "addPractical",data: $("#addPracticalForm").serializeArray(),id: id},
			success: function(resp){
				window.location.href="practicallist.php?id="+id;
			},
			error: function(stat){
				alert(stat.responseText);
			}
		})
	 })
	 function addNewRow(){
            $.ajax({
                url: "DBop.php",
                type: "post",
                data: {save:"addNewRow",id: dropdown},
                success: function(resp){
                    $("#newRow").append(resp);
                    dropdown = dropdown+1;
                },
                error: function(stat, mess){
                    alert(stat.responseText);
                }
            });
        }
        function deleteRow(e){
            $("#rowId"+e).remove();
        }
 </script>
 </html>