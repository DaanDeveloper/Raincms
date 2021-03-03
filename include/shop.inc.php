<?php
if (isset($_POST["submit"])) {
    require "../class/user.class.php";
    require "../config.php";
    require "../include/cnt.inc.php";

    $stmt = $db->prepare("SELECT online,rank,credits FROM users WHERE id = :userid");
	$stmt->execute([":userid" => $_SESSION['id']]);
	while ($row = $stmt->fetch()) {
        $credits = $row["credits"];
        if ($row["online"] !== 1) {
            if ($row["rank"] >= 2) {
                echo "already";
            }
            else {
                $stmt = $db->prepare("SELECT * FROM users_currency WHERE user_id=:id && type=0");
                $stmt->execute(["id" => $_SESSION["id"]]);
                while ($row = $stmt->fetch()) {
                    $userAmount = $row["amount"];
                }           
                if ($hotel["provipcost"] <= $userAmount) {
                    $newDiamonds = ($userAmount - $hotel["provipcost"]);
                    $stmt = $db->prepare("UPDATE users_currency SET `amount`= :amount WHERE user_id=:id && type=0");
                    $stmt->execute([":id" => $_SESSION["id"], ":amount" => $newDiamonds]);
                    $newCredits = ($credits + 1000000);
                    $stmt = $db->prepare("UPDATE users SET `rank`= 2, credits=:credits WHERE id=:id");
                    $stmt->execute([":id" => $_SESSION["id"], ":credits" => $newCredits]);
                    $stmt = $db->prepare("INSERT INTO users_badges (user_id, badge_code) VALUES (:id, :badge_code)");
                    $stmt->execute([":id" => $_SESSION["id"], ":badge_code" => "VIP"]);
                    echo true;
                }
                else {
                    echo "poor";
                }
            }
        }
        else {
            echo "online";
        }
	}
}

else {
    die("You are not allowed to see this file.");
    exit();
}