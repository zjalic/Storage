<?php
session_start();
if($_SESSION['auth'] == True){
    $file2Del = $_GET['file'];
    unlink("../storage/$file2Del");
    header("Location: content.php");
} else {
    header("Location: index.php");
}