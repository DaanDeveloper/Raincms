<!DOCTYPE html>
<head>
    <link rel='shortcut icon' type='image/x-icon' href='../templates/images/favicon.ico'>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/shop.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/fontawesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <title>Winkel - <?=$hotel["hotelname"]?></title>
</head>
<body>
    <div id="shop-container">
        <div id="shop-main">
            <!-- include nav -->
            <?php include "templates/nav.php";?>
            <?php
            if ($_SERVER['REQUEST_URI'] == "/belcr") {
                //belcr template
                echo'
                <div class="shop-center">
                    <div class="shop-title">Bel Credits kopen</div>
                    <div class="shop-belcr-center">
                        <div class="shop-text"><br><b>Wat zijn Bel Credits?</b><br>Bel Credits zijn munten die je in game kunt gebruiken om ultra rares te kopen.</div>
                        <div class="not">Is momenteel niet beschikbaar!</div>
                        <div class="shop-price"><input type="checkbox">  €2,99: 10 Bel-Credits<br><input class="shop-checkbox" type="checkbox">  €5,99: 30 Bel-Credits<br><input class="shop-checkbox" type="checkbox">  €9,99: 100 Bel-Credits<br><input class="shop-checkbox" type="checkbox">  €29,99: 500 Bel-Credits<br><input class="shop-submit" value="Kopen" type="submit"></div>
                    </div>
                    <div class="shop-img-belcr"></div>
                </div>';
            }
            else if ($_SERVER['REQUEST_URI'] == "/provip") {
                //provip template
                echo'
                <div id="error-shop"></div>
                <div id="succes-shop"></div>
                <div class="shop-center">
                    <div class="shop-title">Pro-Vip kopen</div>
                    <div class="shop-img-provip-badge"></div>
                    <div class="shop-text"><br><b>Wat is Pro-Vip?</b><br>Pro-vip is een soort rank waardoor je meer commands krijgt, een extra shop waar je meubels kunt kopen die alleen vips kunnen kopen, een badge die alleen vips hebben en 1 miljoen credits! Dit alles kost '.$hotel["provipcost"].' diamanten.</div>
                    <div class="shop-text info"><br><br><b>Welke commands krijg ik?</b><br>:spull x dit is het zelfde als :pull x maar dan heb je een verder range dat je iemand naar je toe kan trekken.<br>:spush x dit is het zelfde als :push x maar je duwt je target veel verder. <br> Je krijgt ook nog wat enables erbij.</div>
                    <div class="shop-buy-provip"><input class="shop-submit" type="submit" value="Pro-Vip kopen" onclick="proVip()"></div>
                    <div class="shop-img-provip"></div>
                </div>';
            }
            ?>
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
        }, 4000);
    }
    function proVip() {
        let submit = true;
        $.ajax({
			url:'/include/shop.inc.php',
			data:{submit:submit},
		    type:'post',
			success:function(response){
			   	if(response == true){
                    error("Je bent nu Pro-Vip!", "succes-shop", "visible")
			 	}
                 switch (response) {
                     case "already":
                     error("Je hebt al Pro-Vip gekocht het zou zonden zijn om het nog eens te kopen.", "error-shop", "visible");
                     break;
                     case "poor":
                     error("Je hebt niet genoeg diamanten om Pro-Vip te kopen.", "error-shop", "visible");
                     break;
                     case "online":
                     error("Je mag niet in het hotel zitten als je iets wilt kopen.", "error-shop", "visible");
                     break;
                 }
		    }
		});
    }
</script>