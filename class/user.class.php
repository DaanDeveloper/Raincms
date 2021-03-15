<?php
session_start();
ob_start();
class User {

	public static function Check($checkData) {
		switch ($checkData){
			case "loggedIn":
				if (isset($_SESSION["username"])) {
					return true;
					break;
				}
				else {
					return false;
					break;
				}
	
			case "staff":
				if ($_SESSION["rank"] > 2 && $_SESSION["rank"] < 12) {
					return true;
					break;
				}
				else {
					return false;
					break;
				}
	
			case "security":
				if (user::Check("staff")) {
					if (isset($_SESSION['security'])) {
						if ($_SESSION['security'] == true) {
							return true;
							break;
						}else{
							return false;
							break;
						}
					}else{
						return false;
						break;
					}
				}else {
					return true;
					break;
				}
	
			case "security_hk":
				if (user::Check("staff")) {
					if (isset($_SESSION['security_hk'])) {
						if ($_SESSION['security_hk'] == true) {
							return true;
							break;
						}else{
							return false;
							break;
						}
					}else{
						return false;
						break;
					}
				}else {
					return true;
					break;
				}
	
			case "banned":
				require __DIR__ ."/../config.php";
				require __DIR__ ."/../include/cnt.inc.php";
				$ip = user::userIp();
				$stmt = $db->prepare("SELECT * FROM bans WHERE `user_id` = :id");
				$stmt->execute([":id" => $_SESSION["id"]]);
				if ($stmt->RowCount() > 0) {
					while($row = $stmt->fetch()) {
						if ($row["ban_expire"] >= strtotime('now')) {
							if(preg_match('/unbanned:/i',$row['ban_reason'])) {
								return false;
							}else {
								return true;
							}
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
						if(preg_match('/unbanned:/i',$row['ban_reason'])) {
							return false;
						}else {
							return true;
						}
					}else {
						return false;
					}
				}
			}
			return false;
		}
	}

	public static function userSettings($setting) {
		require __DIR__ ."/../config.php";
		require __DIR__ ."/../include/cnt.inc.php";
		$stmt = $db->prepare("SELECT * FROM users_settings WHERE id = :userid");
		$stmt->execute([":userid" => $_SESSION['id']]);
		while ($row = $stmt->fetch()) {
			return $row[$setting];
		}
	}

	public static function userCurrency($currencyType) {
		require __DIR__ ."/../config.php";
		require __DIR__ ."/../include/cnt.inc.php";
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
				if ($row["amount"] >= 1) {
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
				return $row["amount"];
			}
		}
		}
	}

	public static function userInfo($userInfo) {
		require __DIR__ ."/../config.php";
		require __DIR__ ."/../include/cnt.inc.php";
		$stmt = $db->prepare("SELECT * FROM users WHERE id = :userid");
		$stmt->execute([":userid" => $_SESSION['id']]);
		while ($row = $stmt->fetch()) {
			return $row[$userInfo];
		}
	}

    public static function userIp(){
		return isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR'];
	}

}