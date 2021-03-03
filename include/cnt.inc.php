<?php
try {
	$db = new pdo('mysql:host=' . $config["ip"] . ';dbname=' . $config["dbname"], $config["hostname"], $config["password"]);
}
catch ( PDOException $e ) {
	echo 'ERROR!';
	print_r( $e );
}