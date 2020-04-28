<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    session_start();

    $userInput = $_POST['user'];
    $passInput = $_POST['pass'];
    
    if($userInput == "root" && $passInput == "rootStorage"){
        $_SESSION['auth'] = True;
        die(header("Location: content.php"));
    } else {
        die(header("Location: index.php"));
    }
}

/*
$bp = mysqli_connect("127.0.0.1", "root", "" , "infos");
print_r($_POST);
$user = mysqli_real_escape_string($bp , stripslashes($_POST["user"]));
$pass = mysqli_real_escape_string($bp , stripslashes($_POST["pass"]));

$upit = "select * from infos where Aplikacija like 'Storage'";

$rez = mysqli_query($bp, $upit);
$login = mysqli_fetch_object($rez);
$userB = $login->Username;
$passB = $login->Password;

$remoteAdd = $_SERVER['REMOTE_ADDR'];

if(password_verify($pass, $passB) && ($user == $userB)){
    
    $_SESSION['user'] = $user;
    $_SESSION['IP'] = $remoteAdd;
    $txt = "(+) Incoming IP: " . $remoteAdd . " " . date("j M Y - G:i");
    $myfile = file_put_contents('../logs.dat', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    header("Location: content.php");
} else {
    $txt = "(-) Incoming IP: " . $remoteAdd . " -> Wrong Login Parametars " . date("j M Y - G:i");
    $myfile = file_put_contents('../logs.dat', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    header("Location: index.php");
}

    
} else {
    $txt = "(-) Incoming IP: " . $remoteAdd . "  -> NOT POST " .  date("j M Y - G:i");
    $myfile = file_put_contents('../logs.dat', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    header("Location: index.php");
}
*/ 

session_start();
session_destroy();
$remoteAdd = $_SERVER['REMOTE_ADDR'];
$txt = "(?) Incoming IP: " . $remoteAdd . " Connecting " . date("j M Y - G:i");
$myfile = file_put_contents('../logs/logs.dat', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
?>
<html>
<head>
    <title>Storage</title>
    <link rel="icon" href="assets/icon.png">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
  <div class="login">
    <h1>Пријава</h1>
    <form method="post" action="index.php">
      <p><input type="text" name="user" value="" placeholder="Име" required></p>
      <p><input type="password" name="pass" value="" placeholder="Лозинка" required></p>
      
      <p class="submit"><input type="submit" name="commit" value="Пријава"></p>
    </form>
  </div>
</div>
</body>
</html>