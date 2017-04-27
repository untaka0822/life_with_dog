<<<<<<< HEAD
<?php
=======

<?php 
>>>>>>> f721ef99e56624a6aea1aaa447a8f546db48bced
$dsn = 'mysql:dbname=life_with_dog;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD
$dbh->query('SET NAMES utf8');
=======
// PDOExceptionが使用可能になる。この中にエラー文が格納される。
$dbh->query('SET NAMES utf8');

>>>>>>> f721ef99e56624a6aea1aaa447a8f546db48bced
?>