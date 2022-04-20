<?php
session_start();
include 'includes/config.php';

if(isset($_POST['save'])){
    if($_POST['save']=="login"){
        $loginQ="select * from teacher where `email`='".$_POST["email"]."' and `password`='".$_POST['pass']."'";
        $loginData=mysqli_query($conn,$loginQ);
        $studentLoginQ="select * from student where `email`='".$_POST["email"]."' and `password`='".$_POST['pass']."'";
        $studentLoginData=mysqli_query($conn,$studentLoginQ);
        if($loginData->num_rows>0){
            $_SESSION["email"]=$_POST["email"];
            $_SESSION["type"]="teacher";
            echo "success";
        }else if($studentLoginData->num_rows>0){
            $_SESSION["email"]=$_POST["email"];
            $_SESSION["type"]="student";
            echo "success";
        }else{
            echo "error";
        }
    }

    if($_POST['save']=="register"){
        extract($_POST);
        $register=mysqli_query($conn,"insert into teacher (`name`,`email`,`mobile`,`password`) values ('$name','$email',$phone,'$pass')")or die(mysqli_error($conn));
        if($register) echo "success";
    }

    if($_POST['save']=="addStudent"){
        $data=$_POST['data'];
        $sid=$data[0]['value'];
        $name=$data[1]['value'];
        $email=$data[2]['value'];
        $mobile=$data[3]['value'];
        $sem=$data[4]['value'];
        $pass=$data[5]['value'];
        $data=array("status"=>-1,"message"=>"");
        if($sid==""){
            $data=array("status"=>0,"message"=>"Student ID is required");
            print_r(json_encode($data));
        }else if($name==""){
            $data=array("status"=>0,"message"=>"Student Name is required");
            print_r(json_encode($data));
        }else if($email==""){
            $data=array("status"=>0,"message"=>"Student Email is required");
            print_r(json_encode($data));
        }else if($mobile==""){
            $data=array("status"=>0,"message"=>"Student Mobile is required");
            print_r(json_encode($data));
        }else if($sem==""){
            $data=array("status"=>0,"message"=>"Student Sem is required");
            print_r(json_encode($data));
        }else if($pass==""){
            $data=array("status"=>0,"message"=>"Student Password is required");
            print_r(json_encode($data));
        }else{
            $addStudent=mysqli_query($conn, "insert into student (`stu_id`,`name`,`email`,`mobile`,`password`,`semester`) values ('$sid','$name','$email',$mobile,'$pass','$sem')")or die(mysqli_error($conn));
            if($addStudent){
                $data=array("status"=>1,"message"=>"Data added successfully");
                print_r(json_encode($data));
            }
        }
    }

    if($_POST['save']=="addSubject"){
        $data=$_POST['data'];
        $sid=$data[0]['value'];
        $name=$data[1]['value'];
        $email=$data[2]['value'];
        $sem=$data[3]['value'];
        $data=array("status"=>-1,"message"=>"");
        if($sid==""){
            $data=array("status"=>0,"message"=>"Subject code is required");
            print_r(json_encode($data));
        }else if($name==""){
            $data=array("status"=>0,"message"=>"Subject name is required");
            print_r(json_encode($data));
        }else if($email==""){
            $data=array("status"=>0,"message"=>"Faculty name is required");
            print_r(json_encode($data));
        }else if($sem==""){
            $data=array("status"=>0,"message"=>"Semester is required");
            print_r(json_encode($data));
        }else{
            $addStudent=mysqli_query($conn, "insert into subject (`sub_code`,`sub_name`,`fac_name`,`semester`) values ('$sid','$name','$email',$sem)")or die(mysqli_error($conn));
            if($addStudent){
                $data=array("status"=>1,"message"=>"Data added successfully");
                print_r(json_encode($data));
            }
        }
    }

    if($_POST['save']=="insert"){
        $code=$_POST['code'];
        $name=$_POST['name'];
        $subject=$_POST['subject'];
        $insert="INSERT INTO saveprogram(`name`,`file`,`sub_code`)values('$name','$code','$subject');";
       if (mysqli_query($conn, $insert)){
           echo"Inserted!";
        }else{
            echo "Error: ".$insert."<br>" . mysqli_error($conn);
        }
    }
    if($_POST['save']=="retrieve"){
        $data=array();
        $retrieve="SELECT addpractical.aim,saveprogram.file from addpractical,saveprogram where addpractical.id=saveprogram.sub_code and addpractical.id='".$_POST['id']."'";
        $retrieveData=mysqli_query($conn, $retrieve)or die(mysqli_error($conn));
        $retrieveRow=mysqli_fetch_array($retrieveData);
        $second="SELECT * from addpractical where id='".$_POST['id']."'";
        $secondData=mysqli_query($conn, $second)or die(mysqli_error($conn));
        $secondRow=mysqli_fetch_array($secondData);
        if($retrieveRow=="") $data=array("aim"=>$secondRow['aim'],"file"=>"");
        else $data=array("aim"=>$secondRow['aim'],"file"=>$retrieveRow['file']);
        echo json_encode($data);
    }
    if($_POST['save']=="addNewRow"){
        $table='<tr id="rowId'.$_POST['id'].'">
            <td><input type="text" name="practical[]" class="form-control"></td>
            <td><textarea name="aim[]" class="form-control" style="height:40px;"></textarea></td>
            <td><input type="text" name="testCase[]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-round" id="btnDel" onclick="deleteRow('.$_POST['id'].')"><b class="fa fa-trash"></b></button></td>
        </tr>';
        echo $table;
    }
    if($_POST['save']=="addPractical"){
        $postData=$_POST['data'];
        $pname="";
        $aim="";
        $testCase="";
        foreach($postData as $item){
            if($item['name']=="practical[]"){
                if($pname=="") $pname=$item['value'];
                else $pname.=",".$item['value'];
            }if($item['name']=="aim[]"){
                if($aim=="") $aim=$item['value'];
                else $aim.=",".$item['value'];
            }if($item['name']=="testCase[]"){
                if($testCase=="") $testCase=$item['value'];
                else $testCase.=",".$item['value'];
            }
        }
        $pnameArray=explode(',',$pname);
        $aimArray=explode(',',$aim);
        $testCaseArray=explode(',',$testCase);
        foreach($pnameArray as $key=>$item){
            $query=mysqli_query($conn,"insert into addpractical (`aim`,`test_case`,`sub_code`,`practical_name`) values ('".$aimArray[$key]."','".$testCaseArray[$key]."','".$_POST['id']."','".$pnameArray[$key]."')")or die(mysqli_error($conn));
        }
    }
    if($_POST['save']=="updatePractical"){
        extract($_POST);
        $query=mysqli_query($conn,"update addpractical set practical_name='$pname', aim='$aim', test_case='$testCase' where id=$id")or die(mysqli_error($conn));
    }
    if($_POST['save']=="deletePractical"){
        $delete=mysqli_query($conn,"delete from addpractical where id=".$_POST['id']);
        echo $delete;
    }
}
?>
