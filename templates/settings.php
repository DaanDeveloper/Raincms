<!DOCTYPE html>
<head>
    <link rel='shortcut icon' type='image/x-icon' href='../templates/images/favicon.ico'>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/settings.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/fontawesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <title>Instellingen - <?=$hotel["hotelname"]?></title>
</head>
<body>
    <div id="settings-container">
        <div id="settings-main">
            <!-- include nav -->
            <?php include "templates/nav.php";?>
            <!-- main page -->
            <div class="settings">
                <div class="settings-password">
                    <div class="settings-password-title">Wachtwoord veranderen</div>
                        <input class="settings-password-form" id="oldPassword" type="password" placeholder="Oud wachtwoord...">
                        <p id="error-oldPassword"></p>
                        <p id="succes"></p>
                        <input class="settings-password-form" id="newPassword" type="password" placeholder="Nieuw wachtwoord...">
                        <p id="error-newPassword"></p>
                        <input class="settings-password-form" id="rNewPassword" type="password" placeholder="Herhaal je nieuw wachtwoord...">
                        <p id="error-rNewPassword"></p>
                        <input class="settings-password-submit" onclick="resetPassword()" value="INSTELLEN" type="submit">
                    </div>
                    <div class="settings-hotel">
                        <div class="settings-hotel-title">Hotel instellingen</div>
                        <div class="settings-text friends">Mogen mensen je een vriendschapsverzoek sturen?</div>
                        <label class="settings-hotel-switch">
                            <input onclick="settingsToggle('friends')" id="friends" class="settings-hotel-input" type="checkbox">
                            <span class="settings-hotel-slider"></span>
                        </label>
                        <div class="settings-text following">Mogen mensen je volgen naar een kamer?</div>
                        <label class="settings-hotel-switch">
                            <input onclick="settingsToggle('following')" id="following" class="settings-hotel-input" type="checkbox">
                            <span class="settings-hotel-slider"></span>
                        </label>
                        <div class="settings-text trade">Mogen mensen met je ruilen?</div>
                        <div class="settings-text friends"></div>
                        <label class="settings-hotel-switch">
                            <input id="trade" onclick="settingsToggle('trade')" class="settings-hotel-input" type="checkbox">
                            <span class="settings-hotel-slider"></span>
                        </label>
                        <div class="settings-text friends"></div>
                        <label class="settings-hotel-switch">
                            <input id="" class="settings-hotel-input" type="checkbox">
                            <span class="settings-hotel-slider"></span>
                        </label>
                        <div class="settings-img"></div>
                    </div>
                    <div class="settings-motto">
                        <div class="settings-motto-title">Motto veranderen</div>
                        <input class="settings-motto-form" id="newMotto" type="text" placeholder="Nieuwe motto...">
                        <p id="error-motto"></p>
                        <p id="succes-motto"></p>
                        <input class="settings-motto-submit" onclick="resetMotto()" value="INSTELLEN" type="submit">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- include footer -->
    <?php include "templates/footer.php";?>
</body>
</html>
<script>
    function error(errorText, errorId, errorVisibility) {
        document.getElementById(errorId).style.visibility = errorVisibility;
        $(`#${errorId}`).html(errorText);
        var timer = setTimeout(function() {
            document.getElementById(errorId).style.visibility = "hidden";
        }, 2000);
    }
    function resetMotto() {
        var newMotto = $("#newMotto").val().trim();
        if (newMotto != ""){
        $.ajax({
			url:'/include/settings.inc.php',
			type:'post',
			data:{newMotto:newMotto},
            success:function(response){
                if (response == "succes") {
                    error("Je motto is succes vol aangepast!", "succes-motto", "visible");
                }
            }
		});
    }
    else {
        error("Vul dit veld in!", "error-motto", "visible");
    }
}
    function resetPassword() {
        $(document).ready(function(){
            var oldPassword = $("#oldPassword").val().trim();
            var newPassword = $("#newPassword").val().trim();
            var rNewPassword = $("#rNewPassword").val().trim();
                if( oldPassword != "" && newPassword != "" && rNewPassword != ""){
                    $.ajax({
                        url:'/include/settings.inc.php',
                        type:'post',
                        data:{oldPassword:oldPassword,newPassword:newPassword,rNewPassword:rNewPassword},
                        success:function(response){
                            switch (response) {
                                case "password":
                                error("Je wachtwoord moet minstents 8 letters lang zijn en 1 cijfer!", "error-newPassword", "visible");
                                break;
                                case "pCheck":
                                error("Je oud wachtwoord komt niet overeen.", "error-oldPassword", "visible");
                                break;
                                case "rPassword":
                                error("Wachtwoorden komen niet overeen", "error-rNewPassword", "visible");
                                break;
                                case "succes":
                                error("Succesvol verandert!", "succes", "visible");
                                break;
                            }
                    }
                });
            }
            else {
                const settingsPasswordFields = {
                oldPassword: oldPassword,
                newPassword: newPassword,
                rNewPassword: rNewPassword,
                }

                Object.entries(settingsPasswordFields).forEach(field => {
                if (!field[1]) error("Vul dit veld in!", `error-${field[0]}`, "visible");
                })
			}
    });
    }
    let friends = "<?=user::userSettings('block_friendrequests')?>";
    let trade = "<?=user::userSettings('can_trade')?>";
    let following = "<?=user::userSettings('block_following')?>";
    window.onload = function checkSettings() {
        const settingsFields = {
                friends:friends,
                following:following,
                trade:trade
                }

                Object.entries(settingsFields).forEach(field => {
                if (field[1] == 0) {
                    document.getElementById(field[0]).checked = false;
                }
                else {
                    document.getElementById(field[0]).checked = true;
                }
                });
    }
    function settingsToggle(toggle) {
        switch (toggle) {
            case "friends" : 
            if (friends == 0) {
                let toggleState = 0;
                settinsSendData(toggle, toggleState);
            }
            else {
                let toggleState = 1;
                settinsSendData(toggle, toggleState);
            }
            break;
            case "following" : 
            if (following == 0) {
                let toggleState = "0";
                settinsSendData(toggle, toggleState);
            }
            else {
                let toggleState = "1";
                settinsSendData(toggle, toggleState);
            }
            break;
            case "trade" : 
            if (trade == 0) {
                let toggleState = "0";
                settinsSendData(toggle, toggleState);
            }
            else {
                let toggleState = "1";
                settinsSendData(toggle, toggleState);
            }
        }
    }
    function settinsSendData(toggle, toggleState) {
        $.ajax({
			url:'/include/settings.inc.php',
			type:'post',
			data:{toggle:toggle,toggleState:toggleState},
		});
    }
</script>