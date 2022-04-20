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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="js/vendor/jquery-1.12.0.min.js"></script>


  </head>
  <body>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Practical</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <input type="hidden" id="editId">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Practical Name:</label>
            <input type="text" class="form-control" id="practicalName">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Aim:</label>
            <textarea class="form-control" id="aim"></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Test Case:</label>
            <input type="text" class="form-control" id="testCase">
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" id="btnUpdate" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  	<?php include "thome.php";include 'includes/config.php';?>
	  	<form id="addPracticalForm">
			<div class="container">
				<div class="card mt-4">
					<div class="card-body p-4">
						<div class="row">
							<div class="col-md-12">
								<label for="title" ><b><h2>Practicals</h2> </b></label>
                                <label style="float:right;" for="title" ><button onclick="redirect()" type="button" class="btn btn-primary">Add Practical <i class="fa fa-plus"></i></button></label>
								<p class="text-center text-light" style="background-color:rgb(255,0,0,0.5);border-radius:5px;" id="errorMessage"></p>
								<p class="text-center text-light bg-success" style="border-radius:5px;" id="successMessage"></p>
							</div>
							<table class="table table-striped">
						  <thead>
						    <tr>
						      <th scope="col">Practical Name</th>
						      <th scope="col">Aim</th>
							  <th scope="col">Test Cases</th>
                              <th scope="col">Action</th>
						    </tr>
						  </thead>
						  <tbody id="newRow">
                              <?php $query=mysqli_query($conn,"select * from addpractical where sub_code='".$_GET['id']."'");
                              while($data=mysqli_fetch_array($query)){?>
                                <tr id="rowId0">
                                    <td><?=$data['practical_name']?></td>
                                    <td><?=$data['aim']?></td>
                                    <td><?=$data['test_case']?></td>
                                    <td><button type="button" data-toggle="modal" data-target="#exampleModal" onclick="setValue('<?=$data['id']?>','<?=$data['practical_name']?>','<?=$data['aim']?>','<?=$data['test_case']?>')" class="btn btn-info mr-1"><i class="fa fa-edit"></i></button><button type="button" class="btn btn-danger" value="<?=$data['id']?>" onclick="deleteBtn(this)"><i class="fa fa-trash"></i></button></td>
                                </tr>
                            <?php }?>
						    
						  </tbody>
					</table>
						</div>
					</div>
				</div>
			</div>
		</form>
 </body>
 <script>
     var id="<?=$_GET['id']?>";
	 function deleteBtn(e){
		$.ajax({
			url: "DBop.php",
			type: "post",
			data: {save: "deletePractical",id: e.value},
			success: function(resp){
				window.location.href="practicallist.php?id="+id;
			},
			error: function(stat){
				alert(stat.responseText);
			}
		})
	 }
     function redirect(){
         window.location.href="addpractical.php?id="+id;
     }
     $("#btnUpdate").on("click", function(){
         $.ajax({
             url:"DBop.php",
             type:"post",
             data:{
                 save: "updatePractical",
                 id: $("#editId").val(),
                 pname: $("#practicalName").val(),
                 aim: $("#aim").val(),
                 testCase: $("#testCase").val()
             },
             success: function(resp){
                window.location.href="practicallist.php?id="+id;
             },
             error: function(stat){
                 alert(stat.responseText);
             }
         })
     })
     function setValue(id,pname,aim,testcase){
         $("#editId").val(id);
         $("#practicalName").val(pname);
         $("#aim").val(aim);
         $("#testCase").val(testcase);
     }
 </script>
 </html>