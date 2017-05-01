<?php 
$dsn = 'mysql:dbname=life_with_dog;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->query('SET NAMES utf8');
<<<<<<< HEAD
=======
?>
>>>>>>> ba32b1cd28b3590d4b58880161eba73e8c4ec917
