<?php

$host ="localhost";
$user ="root";
$pass ="";
$db   ="arganoil";


try {
$conn = new PDO("mysql:host=$host; dbname=$db", $user, $pass);

}
catch(PDOException $e){
	echo "Not Connected :". $e->getMessage();

}