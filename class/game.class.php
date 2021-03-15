<?php
class Game {
    public static function usersOnline() {
    require __DIR__."/../config.php";
	require __DIR__."/../include/cnt.inc.php";
        $stmt = $db->prepare("SELECT `online` FROM users WHERE `online` = :count");
        $stmt->execute(array(":count" => 1));
        return $stmt->rowcount();
	}

  public static function updateSso() {
      return 'RAINCMS-'.substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 50).'-SSO';
	}

}

