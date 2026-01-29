<?php

$host ="mysql:host=localhost;dbname=cubicMarket;charset=utf8";
$user ="root";
$password ="";

try {
    $db = new PDO($host,$user,$password);

    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//    echo "Connected successfully";

} catch (PDOException $e) {
    die ("Connection failed ");
}
