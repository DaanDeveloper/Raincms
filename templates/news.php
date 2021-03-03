<!DOCTYPE html>
<head>
    <link rel='shortcut icon' type='image/x-icon' href='../templates/images/favicon.ico'>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/news.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuws - <?=$hotel["hotelname"]?></title>
</head>
<body>
    <div id="news-container">
        <div id="news-main">
            <!-- include nav -->
            <?php include "templates/nav.php";?>
            <!-- main page -->
            <div class="news">
                <div class="news-last">Laatste nieuws</div>
                <div class="news-title"><?=html::news('title')?></div>
                <div class="news-longstory"><?=html::news('longstory')?></div>
                <div class="news-author">Geschreven door <?=html::news('author')?></div>
            </div>
        </div>
    </div>
    <!-- include footer -->
    <?php include "templates/footer.php";?>
</body>
</html>