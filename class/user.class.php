<?php
session_start();
ob_start();
class User {

	public static function Check($checkData) {
		if ($checkData == "loggedIn") {
			if (isset($_SESSION["username"])) {
				return true;
			}
			else {
				return false;
			}
		}

		else if ($checkData == "staff") {
			if ($_SESSION["rank"] > 2 && $_SESSION["rank"] < 12) {
				return true;
			}
			else {
				return false;
			}
		}

		else if ($checkData == "security") {
			if (user::Check("staff")) {
				if (isset($_SESSION['security'])) {
					return true;
				}
				else {
					return false;
				}
			}
			else {
				return true;
			}
		}

		else if ($checkData == "banned") {
			require "config.php";
			require "include/cnt.inc.php";
			$ip = user::userIp();
			$stmt = $db->prepare("SELECT * FROM bans WHERE `user_id` = :id");
			$stmt->execute([":id" => $_SESSION["id"]]);
			if ($stmt->RowCount() > 0) {
				while($row = $stmt->fetch()) {
					if ($row["ban_expire"] >= strtotime('now')) {
						return true;
					}
					else {
						return false;
					}
				}
			}
			$stmt = $db->prepare("SELECT * FROM bans WHERE `ip` = :ip");
			$stmt->execute([":ip" => $ip]);
			if ($stmt->RowCount() > 0) {
				while($row = $stmt->fetch()) {
					if ($row["ban_expire"] >= strtotime('now')) {
						return true;
					}
					else {
						return false;
					}
				}
			}
			return false;
		}
	}

	public static function userSettings($setting) {
		require "config.php";
		require "include/cnt.inc.php";
		$stmt = $db->prepare("SELECT * FROM users_settings WHERE id = :userid");
		$stmt->execute([":userid" => $_SESSION['id']]);
		while ($row = $stmt->fetch()) {
			return $row[$setting];
		}
	}

	public static function userCurrency($currencyType) {
		require "config.php";
		require "include/cnt.inc.php";
		if ($currencyType == "-1") {
			$stmt = $db->prepare("SELECT credits FROM users WHERE id = :userid");
			$stmt->execute([":userid" => $_SESSION["id"]]);
			$count = $stmt->rowCount();
				while($row = $stmt->fetch()) {
				if ($row["credits"] > 0) {
					$balance = $row['credits'];
					if ($balance >= 1000 && $balance < 1000000) {
						return $balance >= 1000 && $balance < 1000000 ? round($balance, -3)/1000 . "K" : "Invalid Number";
					}
						else if ($balance >= 1000000 && $balance < 1000000000) {
						return $balance >= 1000000 && $balance < 1000000000 ? round($balance, -6)/1000000 . "M" : "Invalid Number";
					}
				}
				else {
					return 0;
				} 
			}
		}
		else {
			$stmt = $db->prepare("SELECT amount FROM users_currency WHERE type = :type && user_id = :user_id");
			$stmt->execute([':user_id' => $_SESSION['id'], ':type' => $currencyType]);
				while($row = $stmt->fetch()) {
				if ($row["amount"] > 0) {
					$balance = $row['amount'];
				if ($balance >= 1000 && $balance < 1000000) {
					return $balance >= 1000 && $balance < 1000000 ? round($balance, -3)/1000 . "K" : "Invalid Number";
				}				
				else if ($balance >= 1000000 && $balance < 1000000000) {
					return $balance >= 1000000 && $balance < 1000000000 ? round($balance, -6)/1000000 . "M" : "Invalid Number";
				}
				else {
					return $balance;
				}

			}
			else {
				return 0;
			}
		}
		}
	}

	public static function userInfo($userInfo) {
		require "config.php";
		require "include/cnt.inc.php";
		$stmt = $db->prepare("SELECT * FROM users WHERE id = :userid");
		$stmt->execute([":userid" => $_SESSION['id']]);
		while ($row = $stmt->fetch()) {
			return $row[$userInfo];
		}
	}

    public static function userIp(){
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
			$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		}
		return $_SERVER['REMOTE_ADDR'];
    }

}