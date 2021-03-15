<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style/login.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/fontawesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <title>Inlog - <?=$hotel["hotelname"]?></title>
</head>
<body class="login-background">
    <div id="login-container">
    <div id="login-main">
    <div class="login-logo"><div class="login-online"><?=Game::usersOnline(), " " , $hotel["shorthotelname"]?>'s online</div></div>
        <div class="login-form">
            <p id="error"></p>
            <input id="username" class="login-form-text" placeholder="Gebruikersnaam..." type="text">
            <input id="password" class="login-form-text" placeholder="Wachtwoord..." type="password">
            <input id="loginSubmit" class="login-form-submit" value="Inloggen" type="submit">
            <p id="error-username"></p><p id="error-password"></p>
        </div>
        <div class="login-form-background"></div>
        <div class="login-reg-box">
                MAAK VRIENDEN & CHAT MET ONLINE MENSEN BIJ <?=$hotel["hotelname"]?>
            </div>
            <a class="login-reg-box-a" href="registreren">SPEEL NU GRATIS!</a>
    </div>
    </div>
    <?php include "templates/footer.php";?>
        <div class="login-box-info">
        </div>
</body>
</html>
<script>
$("#loginSubmit").click(function(){
    loginProcess();
});

$(".login-form-text").keyup(function(e) {
    if (e.keyCode == 13) {
        loginProcess();
    }
});
function loginProcess() {
$(document).ready(function(){
            function error(errorText, errorId, errorVisibility) {
                document.getElementById(errorId).style.visibility = errorVisibility;
                $(`#${errorId}`).html(errorText);
                var timer = setTimeout(function() {
                document.getElementById(errorId).style.visibility = "hidden";
                }, 2000);
            }
			var username = $("#username").val().trim();
			var password = $("#password").val().trim();
			if( username != "" && password != "" ){
					$.ajax({
							url:'/include/login.inc.php',
							type:'post',
							data:{username:username,password:password},
							success:function(response){
									if(response == true){
                                            window.location = "/me";
                                        }
                                        else{
                                            error("Foute gebruikers naam of wachtwoord!", "error", "visible")
									}
							}
					});
			}
			else {
                const loginFields = {
                username: username,
                password: password
                }

                Object.entries(loginFields).forEach(field => {
                if (!field[1]) error("Vul dit veld in!", `error-${field[0]}`, "visible");
            })
		}
	});
}
</script>