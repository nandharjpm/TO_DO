<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <ul>
            <li><a href="admin/register.php"><button>REGISTER</button></a></li>
        </ul>
    </div>
    <div class="cont-1">
        <form action="login.php" method="post">
            <div class="cont-2">
                <label for="email">Email :</label><br>
                <input type="email" name="email" id="email" value="<?php if (!empty($mail)) {
                                                                        echo $mail;
                                                                    } elseif (isset($_COOKIE['remember_email'])) {
                                                                        echo $_COOKIE['remember_email'];
                                                                    } ?>"><br>
                <label for="pwd">Password :</label><br>
                <input type="password" name="pwd" id="pwd" value="<?php if (!empty($pwd)) {
                                                                        echo $pwd;
                                                                    } elseif (isset($_COOKIE['remember_pwd'])) {
                                                                        echo $_COOKIE['remember_pwd'];
                                                                    } ?>"><br><br>
                <input type="checkbox" name="remember" id="remember"><label for="remember">Remember me</label><br>
                <a href="home.php"><input type="submit" value="submit" class="sub" name="submit"></a>

            </div>
        </form>
    </div>
</body>

</html>
<?php


if (isset($_POST['submit'])) {
    require_once('database/connection.php');
    $mail = $_POST['email'];
    $pwd = $_POST['pwd'];
    if ($mail == "praveen08@gmail.com" && $pwd = "12345678") {
            
            header("location:admin/admin.php");
            session_start();
            $_SESSION['user'] = "yes";
          
        }
    else {
        $sql = "SELECT * FROM register WHERE mail='$mail'";
        $result = mysqli_query($con, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($user) {
            if (password_verify($pwd, $user["pwd"])) {
                session_start();
                $_SESSION['user'] = "yes";

                if (isset($_POST['remember'])) {
                    $remember = $_POST['remember'];
                    setcookie('remember_email', $mail, time() + (3600 * 24 * 365));
                    setcookie('remember_pwd', $pwd, time() + (3600 * 24 * 365));
                }
                header("location:user/viewtask.php");
                die();
                /* echo "success"; */
            } else {
                echo "USER NOT FOUND";
            };
        };
    }
};


?>