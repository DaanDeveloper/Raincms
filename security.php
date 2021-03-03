<?php
    require "include/auto.inc.php";
if (!User::Check("loggedIn")) {
    header("location: /");
    exit();
}

else if (User::Check("security")) {
    header("location: /me");
    exit();
}

include "templates/security.php";