<?php 
    if(!isset($_SESSION['expire'])){
        session_start();
    }
    if(isset($_POST["more_time"])){
        $now = time() + 600; /* Asigna 10 min más */
        $_SESSION['expire'] =  $now;
    }else if(isset($_POST["session_destroy"])){
        session_destroy();   
    }
?>