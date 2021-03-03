<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style/register.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <title>Registreren - <?=$hotel["hotelname"]?></title>
</head>
<body class="register-background">
    <div id="register-container">
    <div id="register-main">
    <div class="register-logo"><div class="register-online"><?=Game::usersOnline(), " " , $hotel["shorthotelname"]?>'s online</div></div>   
    <div class="register-already-login">
        <a href="/">Al een account?</a>
    </div>  
        <div class="register-form-background"></div>
            <div class="register-box-form">
                <div class="register-title">Registreren bij <?=$hotel["hotelname"]?></div>
                <input class="inputText" id="username" placeholder="Gebruikersnaam..." type="text">
                <p id="error-username"></p>
                <input class="inputText" id="email" placeholder="E-mail..." type="text">
                <p id="error-email"></p>
                <input class="inputText" id="password" placeholder="Wachtwoord..." type="password">
                <p id="error-password"></p>
                <input class="inputText" id="repeatPassword" placeholder="Herhaal wachtwoord..." type="password">
                <p id="error-repeatPassword"></p>
                <input class="inputSubmit" id="registerSubmit" value="Registeren" type="submit">
            </div>
            <div class="register-background-form"></div>
    </div>
    </div>
    <footer>
    <?php include "templates/footer.php";?>
    <div class="register-box-info"></div>
    </footer>
</body>
</html>
<script>
$("#registerSubmit").click(function(){
    registerProcess();
});

$(".inputText").keyup(function(e) {
    if (e.keyCode == 13) {
        registerProcess();
    }
});
function registerProcess() {
$(document).ready(function(){
			var username = $("#username").val().trim();
			var email = $("#email").val().trim();
            var password = $("#password").val().trim();
            var repeatPassword = $("#repeatPassword").val().trim();

            function error(errorText, errorId, errorVisibility) {
                document.getElementById(errorId).style.visibility = errorVisibility;
                $(`#${errorId}`).html(errorText);
                var timer = setTimeout(function() {
                    document.getElementById(errorId).style.visibility = "hidden";
                }, 2000);
            }

			if( username != "" && email != "" && password != "" && repeatPassword != ""){
					$.ajax({
							url:'/include/register.inc.php',
							type:'post',
							data:{username:username,email:email,password:password,repeatPassword:repeatPassword},
							success:function(response){
									if(response == true){
                                        window.location = "/me";
                                    }

                                    switch (response)
                                    {
                                        case "fusername":
                                            error("Vul een geldige gebruikers naam in!", "error-username", "visible");
                                            break;
                                        case "username":
                                            error("Gebruikers naam al in gebruik!", "error-username", "visible");
                                        break;
                                        case "email":
                                            error("Vul een geldig E-mail in!", "error-email", "visible");
                                        break;
                                        case "password":
                                            error("Je wachtwoord moet minstents 8 letters lang zijn en 1 cijfer!", "error-password", "visible");
                                        break;
                                        case "repeatPassword":
                                            error("Wachtwoorden komen niet overeen!", "error-repeatPassword", "visible");
                                        break;
                                }
							}
					});
			}
			else {
                const registerFields = {
                username: username,
                email: email,
                password: password,
                repeatPassword: repeatPassword
                }

                Object.entries(registerFields).forEach(field => {
                if (!field[1]) error("Vul dit veld in!", `error-${field[0]}`, "visible");
                })
			}
	});
}
</script>