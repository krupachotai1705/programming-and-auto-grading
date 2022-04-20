<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Compiler</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">    
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="js/vendor/jquery-1.12.0.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
            <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
                <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                    <p class="text-center text-light" style="background-color:rgb(255,0,0,0.5);border-radius:5px;" id="errorMessage"></p>

                    <form class="mx-1 mx-md-4">

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fa fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Your Name</label>
                        <input type="text" id="name" class="form-control" />
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fa fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">Your Email</label>
                        <input type="email" id="email" class="form-control" />
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fa fa-phone fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">Mobile Number</label>
                        <input type="email" id="phone" class="form-control" />
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4c">Password</label>
                        <input type="password" id="password" class="form-control" />
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fa fa-key fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4cd">Confirm password</label>
                        <input type="password" id="cpassword" class="form-control" />
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="button" id="registerButton" class="btn btn-primary btn-lg">Register</button>
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        <p class="small fw-bold">Already have an account?
                        <a href="login.php" class="link-danger">Login</a></p>
                    </div>
                    </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                    <img src="img/draw1.webp" class="img-fluid" alt="Sample image">
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>
    <script>
        $("#registerButton").on("click",function(){
            if($("#name").val()==""){
                $("#errorMessage").html("Name is required");
            }else if($("#email").val()==""){
                $("#errorMessage").html("Email is required");
            }else if($("#phone").val()==""){
                $("#errorMessage").html("Mobile Number is required");
            }else if($("#password").val()==""){
                $("#errorMessage").html("Password is required");
            }else if($("#cpassword").val()==""){
                $("#errorMessage").html("Confirm Password is required");
            }else if($("#password").val()!=$("#cpassword").val()){
                $("#errorMessage").html("Password doesn't match");
            }else{
                $("#errorMessage").html("");
                $.ajax({
                    url: "DBop.php",
                    type: "post",
                    data: {save:"register", name:$("#name").val(), email:$("#email").val(), phone:$("#phone").val(), pass:$("#password").val()},
                    success: function(resp){
                        if(resp=="success"){
                            window.location.href="login.php";
                        }
                    },
                    error: function(stat){
                        alert(stat.responseText);
                    }
                })
            }
        })
    </script>
</body>
</html>