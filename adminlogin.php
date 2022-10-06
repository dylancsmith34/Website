<?php 
require_once"config.php";
require_once "session.php";
error_reporting(E_ALL); 
ini_set('display_errors', 1);
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
    $userLogin = trim($_POST["userLogin"]);
    $userPassword = trim($_POST["userPassword"]);
    
    if (empty($userLogin)){
        $error .= '<p class="error">Please enter a username.</p>';
    }
    
    if (empty($userPassword)){
                $error .= '<p class="error">Please enter a password.</p>';
    }
    if (empty($error)) {

        $dsn = "mysql:host=$host;dbname=$db"; 
        $pdo = new PDO($dsn, $username, $password);
            if($stmt = $pdo->prepare("SELECT * FROM users WHERE username = :userLogin")){
                $stmt->bindParam(':userLogin', $userLogin);
                $stmt->execute();
                $row = $stmt->fetch();
            

                if($row){
                    if($userPassword == $row['password']){
                        $_SESSION["uid"] = $row["uid"];
                        $_SESSION["user"] = $row;
                
                        header('location: admin.php');
                        exit;
                    }
                    else{
                        $error .= '<p class="error">Invalid password</p>';

                    } 
 

                }
                else{
                    $error .= '<p class="error">Invalid username</p>';

                }
            }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="loginstyles.css">
</head>
<body>
<div><?php require('header.php');?></div>

<center>
    <div class="login">
        <h1>Login</h1>
  
        <form action="" method="post">
            <input type="text" name="userLogin" placeholder="Username" required="required" />
            <input type="password" name="userPassword" placeholder="Password" required="required" />
            <input type='submit' name="login" class="btn btn-primary btn-block btn-large" value="Login">
            <?php echo $error ?>
        </form>
    </div>
</center>
    </body>
</html>
