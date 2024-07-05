<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
        <ul>
            <li><a href="../login.php" ><button>LOGIN</button></a></li>
        </ul>
    </div>

<div class="cont-1">
    <div class="cont-2">
        <form action="" method="post" style="line-height: 1.5;">
            <label for="fname">FULL NAME :</label><br>
            <input type="text" name="fname" id="fname"><br>
            <label for="mail">EMAIL :</label><br>
            <input type="email" name="mail" id="mail"><br>
            <label for="dob">DOB:</label><br>
            <input type="date" name="dob" id="dob"><br>
            <label for="mob">MOBILE NUMBER:</label><br>
            <input type="number" name="mob" id="mob"><br>
            <label for="pwd">PASSWORD:</label><br>
            <input type="password" name="pwd" id="pwd" show><br>
            <label for="pwd">CONFORM PASSWORD:</label><br>
            <input type="password" name="rpwd" id="rpwd"><br><br>
            <input type="submit" value="Register" class="sub" name="submit" style="margin-left: 25%;" >

        </form>
    </div>
</div>
</body>
</html>

<?php  

require_once ('../database/connection.php');
if(isset($_POST['submit'])){
    $name =$_POST['fname'];
    $mail =$_POST['mail'];
    $dob =$_POST['dob'];
    $mob =$_POST['mob'];
    $pwd =$_POST['pwd'];
    $rpwd =$_POST['rpwd'];
    $hpwd =password_hash($pwd,PASSWORD_DEFAULT);
    $error=array();

    if( empty($name) OR empty($mail) OR empty($dob) OR empty($mob) OR empty($pwd) OR empty($rpwd) ){
        array_push($error,"Fill all details");
    };
    if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        array_push($error,"PLEASE ENTER VALID EMAIL ID");
    };
    if(strlen($pwd)<8){
        array_push($error,"PASSWORD MUST BE MINIMUM 8 CHARACTORS");
    };
    if(($pwd)!==$rpwd){
        array_push($error,"PASSWORD AND CONFIROM PASSWORD NOT SAME");
    };
    $sql ="SELECT * FROM register WHERE mail='$mail'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_num_rows($result);
    if($row>0){
        array_push($error,"MAIL ID ALREADY EXSIT");
    };
    $sql ="SELECT * FROM register WHERE mobile='$mob'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_num_rows($result);
    if($row>0){
        array_push($error,"MOBILE NUMBER  ALREADY EXSIT");
    };




    if(count($error)>0){
        foreach($error as $err){
            echo "<div class='alert alert-danger' style='color:red;text-align:center;'>$err</div>";
            
        };
    }
    else{
        $sql ="INSERT INTO register(name,mail,dob,mobile,pwd) VALUES('$name','$mail','$dob','$mob','$hpwd')";
        $r =mysqli_query($con,$sql);
        if($r){
            /* echo "connected"; */
            header('location:login.php');
        }
        else{
            echo "error";
        }
    
    
    }

}


?>