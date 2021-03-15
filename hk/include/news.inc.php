<?php
session_start();
require __DIR__ ."/../../config.php";
require __DIR__ ."/../../include/cnt.inc.php";
$stmt = $db->prepare("INSERT INTO cms_news (title, image, shortstory, longstory, author, type) VALUES (:title, :image, :shortstory, :longstory, :author, 'news')");   
$stmt->execute([':title' => $_POST["title"], ':image' => $_POST["image"], ':shortstory' => $_POST["shortstory"], ':longstory' => $_POST["longstory"], ':author' => $_SESSION["username"]]);
echo true;