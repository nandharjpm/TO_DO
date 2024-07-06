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
            <li><a href="../login.php"><button>LOGIN</button></a></li>
        </ul>
    </div>

    <div class="cont-1">
        <div class="cont-2">
            <form action="" method="post" id="reg" style="line-height: 1.5;">
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
                <input type="submit" value="Register" class="sub" name="submit" style="margin-left: 25%;">

            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>

    <script>
        jQuery('#reg').validate({
            rules:{
                fname:{
                    required:true,
                    String:true,
                    minlength:3,
                    maxlength:20,
                },
                mail:{
                    required: true,
                    email: true,
                },
                dob:{
                    required:true,
                },
                mob:{
                    required:true,
                    digits:true,
                    minlength:10,
                    maxlength:10,
                },
                pwd:{
                    required: true,
                    minlength: 6
                },
                rpwd:{
                    required:true,
                    equalTo:'#pwd',
                },
                messages:{
                    required:"Name is Required",
                    String:"Name should be a string",
                    minlength:"Name should be atleast 3 letters",
                    maxlength:"Name should not be more than 20 characters",
                },
                mail:{
                    required: "Email is Required",
                    email: "Invalid Email",
                },
                dob:{
                    required:"Date Of birth is Required",
                },
                mob:{
                    required:"Mobile Number is required",
                    digits:"Mobile number should not be as a string",
                    minlength: "Mobile number shoul be be 10 digits",
                    maxlength:"Mobile number exceeded",
                },
                pwd:{
                    required:"Password is required",
                    minlength:"Password should be atleast minimum 6 characters",
                },
                rpwd:{
                    required:"Please confirm your password",
                    equalTo:"Password is mismatched"
                }

            }
        })
    </script>
</body>

</html>

<?php

require_once('../database/connection.php');
if (isset($_POST['submit'])) {
    $name = $_POST['fname'];
    $mail = $_POST['mail'];
    $dob = $_POST['dob'];
    $mob = $_POST['mob'];
    $pwd = $_POST['pwd'];
    $rpwd = $_POST['rpwd'];
    $hpwd = password_hash($pwd, PASSWORD_DEFAULT);
    $error = array();

    if (empty($name) or empty($mail) or empty($dob) or empty($mob) or empty($pwd) or empty($rpwd)) {
        array_push($error, "Fill all details");
    };
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        array_push($error, "PLEASE ENTER VALID EMAIL ID");
    };
    if (strlen($pwd) < 8) {
        array_push($error, "PASSWORD MUST BE MINIMUM 8 CHARACTORS");
    };
    if (($pwd) !== $rpwd) {
        array_push($error, "PASSWORD AND CONFIROM PASSWORD NOT SAME");
    };
    $sql = "SELECT * FROM register WHERE mail='$mail'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        array_push($error, "MAIL ID ALREADY EXSIT");
    };
    $sql = "SELECT * FROM register WHERE mobile='$mob'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        array_push($error, "MOBILE NUMBER  ALREADY EXSIT");
    };




    if (count($error) > 0) {
        foreach ($error as $err) {
            echo "<div class='alert alert-danger' style='color:red;text-align:center;'>$err</div>";
        };
    } else {
        $sql = "INSERT INTO register(name,mail,dob,mobile,pwd) VALUES('$name','$mail','$dob','$mob','$hpwd')";
        $r = mysqli_query($con, $sql);
        if ($r) {
            /* echo "connected"; */
            header('location:login.php');
        } else {
            echo "error";
        }
    }
}


?>