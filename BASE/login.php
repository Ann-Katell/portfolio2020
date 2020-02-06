Live Demo

<?php
   ob_start();
   session_start();
?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<html lang = "en">

<head>
    <title>Tutorialspoint.com</title>
    <link href = "css/bootstrap.min.css" rel = "stylesheet">
    
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #ADABAB;
        }
        
        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
        }
        
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        
        .form-signin .checkbox {
            font-weight: normal;
        }
        
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        
        .form-signin .form-control:focus {
            z-index: 2;
        }
        
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
        }
        
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
        }
        
    h2{
            text-align: center;
            color: #017572;
        }
    </style>
    
</head>

<body>
    
    <h2>Enter Username and Password</h2> 
    <div class = "container form-signin">
        
        <?php
            $msg = '';
            
        if (isset($_POST['login']) && !empty($_POST['username']) 
            && !empty($_POST['password'])) {

            if ($_POST['username'] == 'tutorialspoint' && 
                $_POST['password'] == '1234') {
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = 'tutorialspoint';
                
                echo 'You have entered valid use name and password';
            }else {
                $msg = 'Wrong username or password';
            }
        }
        ?>
        //------------------------//
        LOGIN MYSql
        //------------------------//
        // dans config.php
        <?php
define('DB_SERVER', 'localhost:3036');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'rootpassword');
define('DB_DATABASE', 'database');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>

<?php
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
    
    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
    
    $sql = "SELECT id FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    
    $count = mysqli_num_rows($result);
    
      // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {
        session_register("myusername");
        $_SESSION['login_user'] = $myusername;
        
        header("location: welcome.php");
    }else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>
    </div> <!-- /container -->
    
    <div class = "container">
    
        <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
            name = "username" placeholder = "username = tutorialspoint" 
            required autofocus></br>
            <input type = "password" class = "form-control"
            name = "password" placeholder = "password = 1234" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
            name = "login">Login</button>
        </form>

        Cliquez ici pour vous déconnecter <a href = "logout.php" tite = "Logout">Session.
        
    </div>

//-----------//
WELCOME PAGE
//-----------//
<?php
include('session.php');
?>
<h2><a href = "logout.php">Sign Out</a></h2>
//---------------//
// LOGOUT
//---------------//
    <?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["password"]);

echo 'You have cleaned session';
header('Refresh: 2; URL = login.php');
?> 
<?php
session_start();

if(session_destroy()) {
    header("Location: login.php");
}
?>
//---------------//
PAGE SESSION.PHP
//--------------//
<?php
include('config.php');
session_start();

$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");

$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_session = $row['username'];

if(!isset($_SESSION['login_user'])){
    header("location:login.php");
    die();
}
?>

</body>
</html>