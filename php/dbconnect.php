<?php
$dsn = 'mysql:dbname=life_with_dog;host=localhost';
$users = 'root';
$password = '';
$dbh =new PDO($dsn, $users, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->query('SET NAMES utf8');
?>