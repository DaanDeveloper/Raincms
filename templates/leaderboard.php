<!DOCTYPE html>
<head>
    <link rel='shortcut icon' type='image/x-icon' href='../templates/images/favicon.ico'>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/leaderboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard - <?=$hotel["hotelname"]?></title>
</head>
<body>
    <div id="leaderboard-container">
        <div id="leaderboard-main">
            <!-- include nav -->
            <?php include "templates/nav.php";?>
            <!-- main page -->
            <div class="leaderboard-center">
                <div class="leaderboard-box"><div class="title">Bel-Credits</div><div class="leaderboard-info"><?=html::leaderBoard("bel-credits")?></div></div>
                <div class="leaderboard-box"><div class="title">Diamanten</div><div class="leaderboard-info"><?=html::leaderBoard("diamonds")?></div></div>
                <div class="leaderboard-box"><div class="title">Online tijd</div><div class="leaderboard-info"><?=html::leaderBoard("onlineTime")?></div></div>
            </div>
        </div>
    </div>
    <!-- include footer -->
    <?php include "templates/footer.php";?>
</body>
</html>