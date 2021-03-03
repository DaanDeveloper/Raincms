<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style/fontawesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
    <div class="nav-logo"><div class="nav-online"><?=Game::usersOnline(), " " , $hotel["shorthotelname"]?>'s online</div></div>
        <input value="Naar Hotel" class="nav-hotel" onclick="window.open('/hotel','toolbar=0,scrollbars=0,location=1,statusbar=1,menubar=0,resizable=1,width=1270,height=700');return false;" type="submit">
            <div class="nav-nav">
                <div class="nav-title"><?=$hotel["hotelname"]?></div>
                <div class="nav-home">Home <div class="nav-home-dropdown-background"></div><div class="nav-home-dropdown"><a href="/me">Me</a><br><a href="/instellingen">Instellingen</a><br><a href="/loguit">Uitloggen</a></div></div>
                <div class="nav-community">Community <div class="nav-community-dropdown-background"></div><div class="nav-community-dropdown"><a href="/nieuws">Nieuws</a><br><a href="/leaderboard">Leaderboard</a><br><a href="/teams">Teams</a></div></div>
                <div class="nav-shop"><?=$hotel["shorthotelname"]?> Winkel <div class="nav-shop-dropdown-background"></div><div class="nav-shop-dropdown"><a href="/provip">Pro-Vip</a><br><a href="/belcr">Bel-cr</a></div></div>
                <a href="https://discord.gg/SUpfPHvppx" class="nav-discord">Discord</a>
                <?php if (user::Check("staff")) {echo"<a href='/housekeeping' class='nav-hk'>HouseKeeping</a>";}?>
            </div>
            <div class="nav-burgermenu">
                <div class="nav-burgermenu-toggle"><a id="nav-burgermenu-toggle" onclick="burgerMenu()"></a></div>
                <div class="nav-burgermenu-title"><?=$hotel["hotelname"]?></div>
                <div id="nav-toggle" class="nav-toggle">
                <div onclick="menuA('home', '125px')" id="nav-burgermenu-home">Home<div id="nav-burgermenu-home-dropdown"><br><div class="nav-burgermenu-dropdown-a"><a href="/me">Me</a></div><div class="nav-burgermenu-dropdown-a"><a href="/instellingen">Instellingen</a></div><div class="nav-burgermenu-dropdown-a"><a href="/loguit">Uitloggen</a></div></div></div>
                <div onclick="menuA('community', '135px')" id="nav-burgermenu-community">Community<div id="nav-burgermenu-community-dropdown"><br><div class="nav-burgermenu-dropdown-a"><a href="/nieuws">Nieuws</a></div><div class="nav-burgermenu-dropdown-a"><a href="/leaderboard">Leaderboard</a></div><div class="nav-burgermenu-dropdown-a"><a href="/teams">Teams</a></div></div></div>
                <div onclick="menuA('shop', '100px')" id="nav-burgermenu-shop"><?=$hotel["shorthotelname"]?> Winkel<div id="nav-burgermenu-shop-dropdown"><br><div class="nav-burgermenu-dropdown-a"><a href="provip">Pro-Vip</a></div><div class="nav-burgermenu-dropdown-a"><a href="">Bel-cr</a></div></div></div>
                <a onclick="window.open('https://discord.gg/SUpfPHvppx', 'new')" class="nav-discord">Discord</a><br>
                <?php if (user::Check("staff")) {echo"<div class='nav-hk'><a href='/housekeeping'>HouseKeeping</a></div>";}?>
                </div>
            </div>
        <div id="nav-nav-background-white" class="nav-nav-background-white"></div>
    <div class="nav-nav-background"></div>
<script>
    let burgerMenuToggleChecked = false;
    let burgerMenuToggle = document.head.appendChild(document.createElement("style"));
    function burgerMenu() {
        if (burgerMenuToggleChecked == false) {
            burgerMenuToggle.innerHTML = "#nav-burgermenu-toggle {transform: rotate(135deg);} #nav-burgermenu-toggle:before {top: 0;transform: rotate(90deg);} #nav-burgermenu-toggle:after {top: 0;transform: rotate(90deg); }#nav-nav-background-white {height: calc(100% - 190px);}#nav-toggle {display: block;}";
            burgerMenuToggleChecked = true;
        }
        else {
            burgerMenuToggle.innerHTML = "#nav-burgermenu-toggle {transform: rotate(0deg);}";
            burgerMenuToggleChecked = false;
        }
    }
    let menuAToggleChecked = false;
    let menuAToggle = document.body.appendChild(document.createElement("style"));
    function menuA(navName, navHeight) {
        if (menuAToggleChecked == false) {
            document.getElementById(`nav-burgermenu-${navName}`).style.height = navHeight;
            document.getElementById(`nav-burgermenu-${navName}-dropdown`).style.display = "block";
            document.getElementById(`nav-burgermenu-${navName}-dropdown`).style.margin = "0 0 100px 0";
            menuAToggleChecked = true;
        }
        else {
            document.getElementById(`nav-burgermenu-${navName}`).style.height = "";
            document.getElementById(`nav-burgermenu-${navName}-dropdown`).style.display = "none";
            document.getElementById(`nav-burgermenu-${navName}-dropdown`).style.margin = "0 0 100px 0";
            menuAToggleChecked = false;
        }
    }
</script>