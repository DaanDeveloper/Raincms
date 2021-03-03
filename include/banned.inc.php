<?php
require "include/cnt.inc.php";
$stmt = $db->prepare("SELECT * FROM bans WHERE `user_id` = :id");
$stmt->execute([':id' => $_SESSION["banned"]]);
while($row = $stmt->fetch()) {
    $time = $row['ban_expire'];
	$time = date("d/m/Y H:i",$time);
    echo '<link rel="stylesheet" href="style/banned.css"><div class="banned-center"><div class="banned-border"><br><br><a class="banned-exit" href="/">X</a><div class="banned-bold">JE BENT VERBANNEN!</div><br><br><div class="banned-text"> Je bent verbannen van '.$hotel["hotelname"].' voor de reden: <span class="banned-text-bold">'.htmlspecialchars($row["ban_reason"], ENT_QUOTES, 'UTF-8').'. </span>Je kunt terug inloggen op: <span class="banned-text-bold">'.$time.'</div></div></div></div>';
}