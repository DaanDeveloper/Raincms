<?php
        session_start();
        ob_start();
        require __DIR__."/../../config.php";
        require __DIR__."/../../include/cnt.inc.php";
        $stmt = $db->prepare("SELECT pincode FROM users WHERE username = :user");
        $stmt->bindParam(':user', $_SESSION['username']);
        $stmt->execute();
        while($row = $stmt->fetch()) {
            if ($_POST['pincode'] == $row['pincode']) {
                $_SESSION['security_hk'] = true;
                echo true;
            }
            else {
                echo false;
            }
        }