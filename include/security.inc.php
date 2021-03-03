<?php
        session_start();
        ob_start();
        $pincode = $_POST['pincode'];
        require "../config.php";
        require "cnt.inc.php";
        $stmt = $db->prepare("SELECT pincode FROM users WHERE username = :user");
        $stmt->bindParam(':user', $_SESSION['username']);
        $stmt->execute();
        while($row = $stmt->fetch()) {
            if ($pincode == $row['pincode']) {
                $_SESSION['security'] = true;
                echo true;
            }
            else {
                echo false;
            }
        }