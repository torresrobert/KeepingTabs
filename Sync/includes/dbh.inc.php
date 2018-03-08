<?php

$dbServername = "localhost";
$dbUsername = "torresro_robert";
$dbPassword = "fauxVille0921!";
$dbName = "torresro_keepingtabs";

$cfg['blowfish_secret'] = 'These violent delights have violent ends1!';

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName) or die("Not connected.");
