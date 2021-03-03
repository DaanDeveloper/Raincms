<?php
    require "include/auto.inc.php";
    if (!User::Check("loggedIn")) {
        header("location: /");
        exit();
    }
    else if (!User::Check("security")) {
        header("location: /security");
        exit();
    }
    else if (User::Check("banned")) {
        $userId = user::userInfo("id");
        session_unset();
        session_destroy();
        session_start();
        $_SESSION["banned"] = $userId;
        header("location: /");
        exit();
    }

    require "templates/shop.php";