<?php
session_start();
if (isset($_POST["toggle"]) && isset($_POST["toggleState"])) {
    if ($_POST["toggle"] == "friends") {
    require "../config.php";
    require "cnt.inc.php";
    if ($_POST["toggleState"] == 0) {
        $stmt = $db->prepare("UPDATE users_settings SET block_friendrequests = '1' WHERE `user_id`=:id");
        $stmt->execute([':id' =>  $_SESSION["id"]]);
        echo true;
    }
    else {
        $stmt = $db->prepare("UPDATE users_settings SET block_friendrequests = '0' WHERE `user_id`=:id");
        $stmt->execute([':id' =>  $_SESSION["id"]]);
        echo false;
    }
    }
    if ($_POST["toggle"] == "following") {
        require "../config.php";
        require "cnt.inc.php";
        if ($_POST["toggleState"] == 0) {
            $stmt = $db->prepare("UPDATE users_settings SET block_following = '1' WHERE `user_id`=:id");
            $stmt->execute([':id' =>  $_SESSION["id"]]);
            echo true;
        }
        else {
            $stmt = $db->prepare("UPDATE users_settings SET block_following = '0' WHERE `user_id`=:id");
            $stmt->execute([':id' =>  $_SESSION["id"]]);
            echo false;
        }
        }
        if ($_POST["toggle"] == "trade") {
            require "../config.php";
            require "cnt.inc.php";
            if ($_POST["toggleState"] == 0) {
                $stmt = $db->prepare("UPDATE users_settings SET can_trade = '1' WHERE `user_id`=:id");
                $stmt->execute([':id' =>  $_SESSION["id"]]);
                echo true;
            }
            else {
                $stmt = $db->prepare("UPDATE users_settings SET can_trade = '0' WHERE user_id=:id");
                $stmt->execute([':id' =>  $_SESSION["id"]]);
                echo false;
            }
            }
        //     if ($_POST["toggle"] == "friends") {
        //         require "../config.php";
        //         require "cnt.inc.php";
        //         if ($_POST["toggleState"] == 0) {
        //             $stmt = $db->prepare("UPDATE users_settings SET block_friendrequests = '1' WHERE `user_id`=:id");
        //             $stmt->execute([':id' =>  $_SESSION["id"]]);
        //             echo true;
        //         }
        //         else {
        //             $stmt = $db->prepare("UPDATE users_settings SET block_friendrequests = '0' WHERE user_id=:id");
        //             $stmt->execute([':id' =>  $_SESSION["id"]]);
        //             echo false;
        //         }
        //         }
}

else if (isset($_POST["oldPassword"]) && isset($_POST["newPassword"]) && isset($_POST["rNewPassword"])) {
    require "../config.php";
    require "cnt.inc.php";
    if (!preg_match("/^(?=.*[a-z])(?=.*\\d).{8,}$/i", $_POST["newPassword"])) {
        echo "password";
    }
    else if ($_POST["newPassword"] == $_POST["rNewPassword"]) {
        $passwordHash = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
        $stmt = $db->prepare("SELECT password FROM users WHERE id = :id");
        $stmt->execute([":id" => $_SESSION['id']]);
        $count = $stmt->rowcount();
        if ($count > 0) {
            while($row = $stmt->fetch())
            $passwordCheck = password_verify($_POST["oldPassword"], $row['password']);
            if ($passwordCheck == false) {
                echo "pCheck";
            }
        
            else if ($passwordCheck == true) {
                $stmt = $db->prepare("UPDATE users SET password=:newpassword WHERE username=:user");
                $stmt->execute([':newpassword' => $passwordHash, ':user' => $_SESSION['username']]);
                echo "succes";
            }
        }
    }
    else {
        echo "rPassword";
    }
}

else if (isset($_POST["newMotto"])) {
    require "../config.php";
    require "cnt.inc.php";
    $stmt = $db->prepare("UPDATE users SET motto=:motto WHERE username=:user");
    $stmt->execute([":motto" => $_POST["newMotto"], ":user" => $_SESSION['username']]);
    echo "succes";
}