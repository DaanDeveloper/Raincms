<!DOCTYPE html>
<head>
    <link rel='shortcut icon' type='image/x-icon' href='../templates/images/favicon.ico'>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/teams.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/fontawesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams - <?=$hotel["hotelname"]?></title>
</head>
<body>
    <div id="teams-container">
        <div id="teams-main">
            <!-- include nav -->
            <?php include "templates/nav.php";?>
            <!-- main page -->
            <div class="teams-center">
                <div class="teams-box"><div class="title">Eigenaar</div><div class="team-info"><?php html::teams("owner", "username", "motto", "look");?></div></div>
                <div class="teams-box"><div class="title">Developer</div><div class="team-info"><?php html::teams("developer", "username", "motto", "look");?></div></div>
                <div class="teams-box"><div class="title">Assistent Manager</div><div class="team-info"><?php html::teams("manager", "username", "motto", "look");?></div></div>
                <div class="teams-box"><div class="title">Super Mod</div><div class="team-info"><?php html::teams("supermod", "username", "motto", "look");?></div></div>
                <div class="teams-box"><div class="title">Moderator</div><div class="team-info"><?php html::teams("mod", "username", "motto", "look");?></div></div>
            </div>
        </div>
    </div>
    <!-- include footer -->
    <?php include "templates/footer.php";?>
</body>
</html>