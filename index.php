<?php
    require "include/auto.inc.php";
    if (isset($_SESSION["banned"])) {
        require "include/banned.inc.php";
        session_unset();
        session_destroy();
    }
    else if (User::Check("loggedIn")) {
        header("location: /me");
        exit();
    }
    include "templates/login.php";
?>