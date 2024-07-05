<?PHP 
require_once('../database/connection.php');

if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sql="DELETE FROM crud WHERE id=$id";
    $r =mysqli_query($con,$sql);
    if($r){
        /* echo "Deleted Sucessfully"; */
        header('location:display.php');
    }else{
        echo "error";
    }
}



?>