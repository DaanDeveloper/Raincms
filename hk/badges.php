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
    else if (!user::Check("staff")) {
        header("location: /me");
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
	else if (!User::Check("security_hk")) {
        header("location: /housekeeping");
        exit();
    }
    include "templates/badges.php";
?>