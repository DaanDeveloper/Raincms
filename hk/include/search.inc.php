<?php

require __DIR__ ."/../../config.php";
require __DIR__ ."/../../include/cnt.inc.php";
$stmt = $db->prepare("SELECT * FROM users WHERE id = :search OR username = :search OR mail = :search OR ip_current = :search");
$stmt->execute(array(":search" => $_POST['search']));
if ($stmt->RowCount() > 0) {
    while($row = $stmt->fetch()) {
        if ($row['online'] == 1) {
            $status = "online";
        }
        else {
            $status = "offline";
        }
        echo "Id: ".$row['id']."<br> Naam: ".strip_tags($row["username"])."<br> Status: ".$status."<br> E-mail: ".strip_tags($row["mail"])."<br> Motto: ".strip_tags($row["motto"])."<br> Ip: ".$row['ip_current']."<br> Ip registratie: ".$row['ip_register'];
    }
}

    echo false;


