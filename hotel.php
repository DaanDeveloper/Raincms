<?php
    require "include/auto.inc.php";
	  require "include/cnt.inc.php";
    if (User::Check("banned")) {
        $userId = user::userInfo("id");
        session_unset();
        session_destroy();
        session_start();
        $_SESSION["banned"] = $userId;
        header("location: /");
        exit();
    }
    $stmt = $db->prepare("UPDATE users SET last_online=:last_online WHERE id=:id");
    $stmt->execute([':last_online' => strtotime('now'), ':id' =>  $_SESSION["id"]]);
?>

<title>Hotel - <?=$hotel["hotelname"]?></title>
<link rel="stylesheet" href="../style/nav-client.css">
<body>
<div class="nav-client-logo">R</div>
<a href="../hotel" class="nav-client-refresh">&#x21bb;</a>
<button onclick="openFullscreen();" class="nav-client-fullscreen">⤢</button>
<iframe src="/nitro-client/dist/index.html?sso=<?=user::userInfo("auth_ticket")?>" height="100%" width="100%"  style="border:0px;"></iframe>
</body>
<style>
body {
    height:100%;
    z-index:1;
    margin:0;
}
</style>
<script>
    var elem = document.documentElement;
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) {
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) {
    elem.msRequestFullscreen();
  }
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) {
    document.msExitFullscreen();
    }
  }
</script>