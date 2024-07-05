<?php 

session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");

}

?>

<?php

include_once('../database/connection.php');
$fetch ="SELECT * FROM crud";
$r = mysqli_query($con,$fetch);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>display</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
        
        <ul>
            <li><a href="../logout.php"><button>LOGOUT</button></a></li>
        </ul>
</div>
<div class="cont-1">
    <div class="tab">
        <table>
            <tr>
                <th>EMPLOYEE ID</th>
                <th>EMPLOYEE NAME</th>
                <th>MAIL ID</th>
                <TH >TASK</TH>
                <th>ACTIONS</th>
            </tr>
        
                <?php 
                while($row = mysqli_fetch_assoc($r)){
                    $id=$row['id'];
                    $ename=$row['Ename'];
                    $mail= $row['mail'];
                    $work = $row['work'];



                    



                    echo '<tr>
                    <td>'.$id.'</td>
                    <td>'.$ename.'</td>
                    <td>'.$mail.'</td>
                    <td>'.$work.'</td>
                    
                    </tr>';


                }
                
                    
                ?>
                   
            
        </table>
    </div>
</div>
</body>
</html>
