<?php

if (empty($_POST["username"]) && empty($_POST["password"])) {
    echo false;
}

else if (empty($_POST["username"]) || empty($_POST["password"])) {
    echo false;
}

else {
    require "../config.php";
    require "cnt.inc.php";
    require "../class/user.class.php";
    require "../class/game.class.php";
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :user");
    $stmt->bindParam(':user', $_POST["username"]);
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $passwordCheck = password_verify($_POST["password"], $row['password']);

        if ($passwordCheck == true) {
            $stmt = $db->prepare("UPDATE users SET last_login=:last_login WHERE username=:user");
            $stmt->execute(array(':last_login' => strtotime('now'), ':user' =>  $_POST["username"]));

            $stmt = $db->prepare("UPDATE users SET ip_current=:ip_current WHERE username=:user");
            $stmt->execute(array(':ip_current' => User::userIp(), ':user' => $_POST["username"]));

            $stmt = $db->prepare("UPDATE users SET auth_ticket=:auth_ticket WHERE username=:user");
            $stmt->execute(array(':auth_ticket' => Game::updateSso(), ':user' => $_POST["username"]));

                $_SESSION["id"] = $row["id"];
                $_SESSION['username'] = $row['username'];
				$_SESSION['rank'] = $row['rank'];
				echo true;
            }
            else {
                echo false;
        }
    }
}