<!DOCTYPE html>
<head>
    <link rel='shortcut icon' type='image/x-icon' href='../templates/images/favicon.ico'>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/me.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$_SESSION["username"], " - ", $hotel["hotelname"]?></title>
</head>
<body>
<div id="me-container">
        <div id="me-main">
            <!-- include nav -->
            <?php include "templates/nav.php";?>
            <!-- main page -->
            <div class="me-center">
                <div class="me-left-container">
                    <div style="margin-top:-20px;height:130px;background:no-repeat url(https://www.habbo.com/habbo-imaging/avatarimage?figure=<?=user::userInfo('look')?>&amp;direction=2&amp;head_direction=3&amp;size=l&amp;gesture=sml&amp;action=wav&amp;&amp;img_format=png);"></div>
                    <div class="me-left-container-title">Hey <?=htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8')?>!</div>
                    <div class="me-left-container-currency"><?="<div class='icon-credits'><b>",user::userCurrency("-1"),"</b></div> ","<div class='icon-pixels'><b>",user::userCurrency("5"),"</b></div><div class='icon-diamonds'><b>",user::userCurrency("0"),"</b></div><div class='icon-belcr'><b>",user::userCurrency("101"),"</b></div>"?></div>
                    <div class="me-left-container-status"><div onclick="window.location = '/instellingen'"></div><?=htmlspecialchars(user::userInfo('motto'), ENT_QUOTES, 'UTF-8')?></div>
                    <div class="me-left-container-last-online">Laaste online: <?=date("d/m/Y H:i",user::userInfo("last_online"));?></div>
                    <input value="Naar Hotel" class="me-hotel" onclick="window.open('/hotel','toolbar=0,scrollbars=0,location=1,statusbar=1,menubar=0,resizable=1,width=1270,height=700');return false;" type="submit">
                </div>
                <div class="me-right-container">
                    <div class="news-a"><a href="/nieuws">Lees verder</a></div>
                    <div class="news-title"><?=html::news('title')?></div>
                    <div class="news-shortstory"><?=html::news('shortstory')?></div>
                </div>
                <div class="me-left-container-background"></div>
                <div class="me-right-container-background" style="background-size: 700px 320px;background-repeat: no-repeat;background-image: url(<?=html::news('image')?>);margin-left: 450px;position: absolute;margin-top: 110px;width: 600px;height: 320px;"></div>
            </div>
        </div>
    </div>
    <!-- include footer -->
    <?php include "templates/footer.php";?>
</body>
</html>