<?php

$driver_options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);


try{
	$dbh = new PDO("mysql:host=localhost;dbname=phpcources","root", "", $driver_options);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo $e->getMessage();
}

return $dbh;