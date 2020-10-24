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

session_start();
session_destroy();
$remoteAdd = $_SERVER['REMOTE_ADDR'];
//$txt = "(?) Incoming IP: " . $remoteAdd . " Connecting " . date("j M Y - G:i");
//$myfile = file_put_contents('../logs/logs.dat', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
?>
<html>
<head>
    <title>Storage</title>
    <link rel="icon" href="assets/img/icon.png">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div id="login">
      <form method="post" action="index.php" name='form-login'>
        <span class="fontawesome-user"></span>
          <input type="text" id="user" name="user" placeholder="Username">
       
        <span class="fontawesome-lock"></span>
          <input type="password" id="pass" name="pass" placeholder="Password">
        
        <input type="submit" value="Login">

</div>
</body>
</html>