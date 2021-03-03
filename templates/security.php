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
		<a href="/logout">Uitloggen</a>
    </div>
</body>
</html>
<script>
$(document).ready(function(){
	$("#loginpin").click(function(){
			let pincode = $("#pincode").val().trim();

			if( pincode != ""){
					$.ajax({
							url:'/include/security.inc.php',
							type:'post',
							data:{pincode:pincode},
							success:function(response){
									let error = "";
									if(response == true){
											window.location = "me";
									}else{
											error = "Foute pincode!";
									}
									$(".error").html(error);
							}
					});
			}
			else {
				error = "Vul de pincode in!";
				$(".error").html(error);
			}
	});
});
</script>