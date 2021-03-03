<?php
    require "include/auto.inc.php";
    if (User::Check("loggedIn")) {
        header("location: /me");
        exit();
    }
    include "templates/register.php";
?>