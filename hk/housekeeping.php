<?php
    require "include/auto.inc.php";
    if (!User::Check("loggedIn")) {
        header("location: /");
        exit();
    }
    else if (!User::Check("security")) {
        header("location: /security");
        exit();
    }
    else if (!user::Check("staff")) {
        header("location: /me");
        exit();
    }
    else if (User::Check("banned")) {
        $userId = user::userInfo("id");
        session_unset();
        session_destroy();
        session_start();
        $_SESSION["banned"] = $userId;
        header("location: /");
        exit();
    }
	else if (User::Check("security_hk")) {
        header("location: /housekeeping/home");
        exit();
    }
?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security - <?=$hotel["hotelname"]?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
</head>
<body>
    <div class="form" id="login-form">
        <p class="error"></p>
		<input id="pincode" type="password" name="pincode" placeholder="Pincode">
	    <input id="loginpin" value="Login" type="submit"><br>
		<a href="/me">Terug</a>
    </div>
</body>
</html>
<script>
$(document).ready(function(){
	$("#loginpin").click(function(){
		let pincode = $("#pincode").val().trim();
		if( pincode != ""){
		$.ajax({
			url:'hk/include/security.inc.php',
			type:'post',
			data:{pincode:pincode},
			success:function(response){
			    let error = "";
			    if(response == true){
			    		window.location = "housekeeping/home";
			    }else{
			    		error = "Foute pincode!";
			    }
			    $(".error").html(error);
			}
			});
	}else{
		error = "Vul de pincode in!";
		$(".error").html(error);
	}
});
});
</script>