<?php
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
		echo "email";
	}

	else if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST["username"])){
		echo "fusername";
	}

	else if (!preg_match("/^(?=.*[a-z])(?=.*\\d).{8,}$/i", $_POST["password"])) {
		echo "password";
	}

	else if ($_POST["password"] !== $_POST["repeatPassword"]) {
		echo "fparepeatPasswordss";
	}

	else {
		require "../class/user.class.php";
		require "../class/game.class.php";
		require "../config.php";
		require "cnt.inc.php";
		$stmt = $db->prepare("SELECT username FROM users WHERE username = :user");
		$stmt->bindParam(':user', $_POST["username"]);
		$stmt->execute();
		$count = $stmt->rowCount();
		if ($count > 0) {
			echo "username";
		}
		else {
			$hashedpassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
			$stmt = $db->prepare("INSERT INTO users (username, password, mail, account_created, motto, look, credits, ip_register) VALUES (:username, :password, :mail, :account_created, :motto, :look, :credits, :ip_register)");   
			$stmt->execute(array(':username' => $_POST["username"], ':password' => $hashedpassword, ':mail' => $_POST["email"], ':account_created' => strtotime('now'), ':motto' => $hotel["motto"], ':look' => $hotel["look"], ':credits' => $hotel["credits"], ':ip_register' => user::userIp()));
            
			$stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        	$stmt->execute(array(":username" => $_POST["username"]));
			while($row = $stmt->fetch()) {
				$stmt = $db->prepare("UPDATE users SET last_login=:last_login WHERE username=:user");
				$stmt->execute([':last_login' => strtotime('now'), ':user' =>  $_POST["username"]]);
	
				$stmt = $db->prepare("UPDATE users SET ip_current=:ip_current WHERE username=:user");
				$stmt->execute([':ip_current' => User::userIp(), ':user' => $_POST["username"]]);
	
				$stmt = $db->prepare("UPDATE users SET auth_ticket=:auth_ticket WHERE username=:user");
				$stmt->execute([':auth_ticket' => Game::updateSso(), ':user' => $_POST["username"]]);
				
				$_SESSION["id"] = $row["id"];
				$_SESSION['username'] = $row['username'];
				$_SESSION['rank'] = $row['rank'];

				$stmt = $db->prepare("INSERT INTO `users_currency` (`user_id`, `type`, `amount`) VALUES (:id, :type, :amount)");
				$stmt->execute(array(":id" => $_SESSION["id"], ":type" => 5, ":amount" => $hotel["pixels"]));

				$stmt = $db->prepare("INSERT INTO `users_currency` (`user_id`, `type`, `amount`) VALUES (:id, :type, :amount)");
				$stmt->execute(array(":id" => $_SESSION["id"], ":type" => 0, ":amount" => $hotel["diamonds"]));

				$stmt = $db->prepare("INSERT INTO `users_currency` (`user_id`, `type`, `amount`) VALUES (:id, :type, :amount)");
				$stmt->execute(array(":id" => $_SESSION["id"], ":type" => 101, ":amount" => $hotel["belcredits"]));
				echo true;
			}
		}
	}