<?php
session_start();
if(!isset($_SESSION['email'])){
  header("location: login.php");
}?>
<!DOCTYPE html>

<html>
<head>

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Compiler</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/style.css">
        
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="js/vendor/jquery-1.12.0.min.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->



</head>
<body>
<?php include "thome.php";include "includes/config.php";?>
<div class="row log">
  <div class="col-sm-12">
    <div class=""><h3 style="text-align:center;">Online Compiler</h3></div>
  </div>
</div>
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="form-group">
<form action="compile.php" id="form" name="f2" method="POST" >
<label for="lang">Choose Language</label>

<select class="form-control" name="language">
<option value="c">C</option>
<option value="cpp">C++</option>


</select><br><br>



<ul class="nav nav-tabs">
  <?php $query=mysqli_query($conn,"select * from addpractical where sub_code='".$_GET["id"]."'");
  while($data=mysqli_fetch_array($query)){?>
  <li class="nav-item">
    <button class="nav-link active btn" aria-current="page" onclick="retrieveData('<?=$data['id']?>')"><?=$data['practical_name']?></button>
  </li>
  <?php }?>
  
</ul>
<br><br>
<textarea class="form-control" name="name" id="nameTextarea" rows="1" cols="50"></textarea><br><br>

<label for="ta">Write Your Code</label>
<textarea class="form-control" name="code" id="codeTextarea" 
onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}" oncopy  rows="10" cols="50"></textarea><br><br>

<label for="in">Enter Your Input</label>
<textarea class="form-control" name="input" onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}" oncopy="return false" onpaste="return false" oncut="return false" rows="2"  cols="50"></textarea><br><br>

<button type="button" class="btn btn-success"  name="save" style="float:right" id="saveBtn" onclick="saveProgram(this)">Save</button>


<input type="submit" id="st" class="btn btn-success" value="Run Code" style="float:right"><br><br><br>



</form>
<label for="out">Output</label>
<textarea id='div' class="form-control" readonly="readonly" name="output" rows="10" cols="50"></textarea><br><br>

</div>
</div>
</div>
</div>
<br><br><br>
</div>
</div>
</div>
</div>
<script type="text/javascript">
  
  $(document).ready(function(){

     $("#st").click(function(){
  
           $("#div").html("Loading ......");


     });

  });
  function retrieveData(e){
    $.ajax({
        url: "DBop.php",
        type: "post",
        data: {save:"retrieve",id:e},
        dataType: "json",
        success: function(resp){
            $("#saveBtn").val(e);
            $("#codeTextarea").val(resp.file);
            $("#nameTextarea").val(resp.aim);
        },
        error: function(stat){
            alert(stat.responseText);
        }
    })
  }
  function saveProgram(e){
    $.ajax({
        url: "DBop.php",
        type:"post",
        data: {save:"insert",code:$("#codeTextarea").val(),name:$("#nameTextarea").val(),subject:e.value,},
        success: function(resp){
            alert(resp);
        },
        error: function(stat){
            alert(stat.responseText);
        }
    })
  }


</script>

<script>

$(document).ready(function(){
    
    $('form').on('submit', function(e){
      
      e.preventDefault();

      
      $.ajax({
            type: "post",
            url: "compile.php", 
            datatype: "html", 
            data: $('form').serialize(),
            success: function(result) { 

                
                $('#div').html(result);
            }
        });
    });
});
</script>

</body>
</html>


