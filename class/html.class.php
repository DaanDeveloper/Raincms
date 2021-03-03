<?php

class html {

    static public function news($newsInfo) {
        require "config.php";
		require "include/cnt.inc.php";
        $stmt = $db->prepare("SELECT * FROM cms_news ORDER BY id DESC LIMIT 1");
        $stmt->execute();
        while($row = $stmt->fetch()) {
            return $row[$newsInfo];
        }
    }

    static public function teams($team, $data, $data2, $data3) {
        switch($team) {
            case "developer": $teamNumber = 9;break;
            case "owner": $teamNumber = 8;break;
            case "manager": $teamNumber = 7;break;
            case "supermod": $teamNumber = 6;break;
            case "mod": $teamNumber = 5;break;
            case "support": $teamNumber = 4;break;
            case "expert": $teamNumber = 3;break;
        }
        require "config.php";
		require "include/cnt.inc.php";
        $stmt = $db->prepare("SELECT * FROM users WHERE rank=:rank");
        $stmt->execute([":rank" => $teamNumber]);
        $count = $stmt->rowcount();
        if ($count > 0) {
        while($row = $stmt->fetch()) {
            switch($data) {
                case "username": echo '<div class="name"><b>'.htmlspecialchars($row["username"], ENT_QUOTES, 'UTF-8').'</b></div>';break;
                case "motto": echo '<div class="motto">'.htmlspecialchars($row["motto"], ENT_QUOTES, 'UTF-8').'</div>';break;
                case "online": echo $row["online"];break;
                case "look": echo '<div class="look" style="height:120px;background:no-repeat url(https://www.habbo.com/habbo-imaging/avatarimage?figure='.$row["look"].'&amp;head_direction=3&amp;direction=3&amp;action=wav&amp;img_format=png);"></div>';break;
                default: echo "";break;
            }
            switch($data2) {
                case "username": echo '<div class="name"><b>'.htmlspecialchars($row["username"], ENT_QUOTES, 'UTF-8').'</b></div>';break;
                case "motto": echo '<div class="motto">'.htmlspecialchars($row["motto"], ENT_QUOTES, 'UTF-8').'</div>';break;
                case "online": echo $row["online"];break;
                case "look": echo '<div class="look" style="height:120px;background:no-repeat url(https://www.habbo.com/habbo-imaging/avatarimage?figure='.$row["look"].'&amp;head_direction=3&amp;direction=3&amp;action=wav&amp;img_format=png);"></div>';break;
                default: echo "";break;
            }
            switch($data3) {
                case "username": echo '<div class="name"><b>'.htmlspecialchars($row["username"], ENT_QUOTES, 'UTF-8').'</b></div>';break;
                case "motto": echo '<div class="motto">'.htmlspecialchars($row["motto"], ENT_QUOTES, 'UTF-8').'</div>';break;
                case "online": echo $row["online"];break;
                case "look": echo '<div class="look" style="height:120px;background:no-repeat url(https://www.habbo.com/habbo-imaging/avatarimage?figure='.$row["look"].'&amp;head_direction=3&amp;direction=3&amp;action=wav&amp;img_format=png);"></div>';break;
                default: echo "";break;
            }
        }
    }
    else {
        echo "<div class='team-empty'>Nog niemand.</div>";
    }
}

public static function leaderBoard($data) {
    switch($data) {
        case "bel-credits": $currency = "101"; $currencyShort = "bel-credits";break;
        case "diamonds": $currency = "0"; $currencyShort = "diamanten";break;
        case "onlineTime": $onlineTime = "0";break;
    }   
        if (isset($currency)) {
            require "config.php";
            require "include/cnt.inc.php";
            $stmt = $db->prepare("SELECT * FROM users_currency WHERE type = :currency ORDER BY amount DESC LIMIT 5");
            $stmt->execute([":currency" => $currency]);
            while($row = $stmt->fetch()) {
                $amount = $row["amount"];
                $user_id = $row["user_id"];
                $stmtUser = $db->prepare("SELECT * FROM users WHERE id = :user_id");
                $stmtUser->execute([":user_id" => $user_id]);
                while($user = $stmtUser->fetch()) {
                    echo '<div class="name"><b>'.htmlspecialchars($user["username"], ENT_QUOTES, 'UTF-8').'</b></div>';
                    echo '<div class="amount">'.htmlspecialchars($amount ." " . $currencyShort, ENT_QUOTES, 'UTF-8').'</div>';
                    echo '<div class="look" style="height:120px;background:no-repeat url(https://www.habbo.com/habbo-imaging/avatarimage?figure='.$user["look"].'&amp;head_direction=3&amp;direction=3&amp;action=wav&amp;img_format=png);"></div>';
                }
            }
        }
        else {
            require "config.php";
            require "include/cnt.inc.php";
            $stmt = $db->prepare("SELECT * FROM users_settings ORDER BY online_time DESC LIMIT 5");
            $stmt->execute();
            while($row = $stmt->fetch()) {
            $user_id = $row["user_id"];
            $amount = ($row["online_time"] / 3600);
                $stmtUser = $db->prepare("SELECT * FROM users WHERE id = :user_id");
                $stmtUser->execute([":user_id" => $user_id]);
                while($user = $stmtUser->fetch()) {
                    echo '<div class="name"><b>'.htmlspecialchars($user["username"], ENT_QUOTES, 'UTF-8').'</b></div>';
                    echo '<div class="amount">'.htmlspecialchars(round($amount - 1) . " uur online", ENT_QUOTES, 'UTF-8').'</div>';
                    echo '<div class="look" style="height:120px;background:no-repeat url(https://www.habbo.com/habbo-imaging/avatarimage?figure='.$user["look"].'&amp;head_direction=3&amp;direction=3&amp;action=wav&amp;img_format=png);"></div>';
                }
            }
        }
}

}