<?php

    //Yasia Sylla R01483577
    session_start();
    if(!isset($_SESSION['username']))
    {
        session_destroy();
        header("location:userlogin.html");
    }
?>