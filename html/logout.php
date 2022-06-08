<?php 
    session_start();
    $_SESSION['logon'] = false;
    header('Location: /login.php');