<?php 

session_start();
if(!isset($_SESSION['user'])){
    header("location:../login.php");

}

?>

<?php 

require('../database/connection.php');
$id =$_GET['updateid'];

$sql ="select * from `crud` where id=$id";

$r =mysqli_query($con,$sql);
$row =mysqli_fetch_assoc($r);
$name =$row['Ename'];
$mail =$row['mail'];
$work =$row['work'];
$id =$_GET['updateid'];


if(isset($_POST['submit'])){
    $ename =$_POST['ename'];
    $mail =$_POST['mail'];
    $work =$_POST['work'];
    $sql ="update `crud` set id=$id, Ename='$ename', mail='$mail', work='$work' WHERE id=$id";
    $r= mysqli_query($con,$sql);
    if($r){
        header('location:display.php');
        /* echo "connected"; */
    }else{
        echo "not connected";
    };

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container">
        <ul>
            <li><a href="display.php"><button>TASKS</button></a></li>
        </ul>
        <ul>
            <li><a href="logout.php"><button>LOGOUT</button></a></li>
        </ul>
    </div>
    <div class="cont-1">
        <div class="cont-2">
            <form  method="post">
                <label for="ename">EMPLOYEE NAME :</label><br>
                <input type="text" name="ename" id="ename" value="<?php echo $name ?>"><br><br>
                <label for="mail">Email :</label><br>
                <input type="email" name="mail" id="mail" value="<?php  echo $mail ?>"><br><br>
                <label for="work">TASK:</label><br>
                <textarea name="work" id="work" cols="30" rows="5"  ><?php  echo $work ?></textarea><br><br>
                <input type="submit" value="UPDATE" class="sub" name="submit">
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>

    <script>
        jQuery('#addtaskform').validate({
            rules: {
                ename: {
                    required: true,
                    String:true,
                    minlength: 3,
                    maxlength: 20
                },
                mail:{
                    required:true,
                    email:true,
                },
                work:{
                    required:true,
                    String:true,
                    minlength:5,
                    maxlength:100
                }
            },
            messages:{
                ename:{
                    required:"Please Enter a Employee Name",
                    String:"Name Shoul be a String",
                    minlength:"Name should be atleast 3 characters",
                    maxlength:"Name should be more than 20 characters",
                },
                mail:{
                    required:"Email is required",
                    email:"Invalid Email",
                },
                work:{
                    required:"Please Mention a work",
                    String: "Task Shoul be in string",
                    minlength:"Assign the task detaily",
                    maxlength:"characters should not be exceded than 100 letters",
                }
            }
        })
    </script>
</body>
</html>

