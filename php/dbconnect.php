
<?php 
<<<<<<< HEAD
$dsh = 'mysql:dbname=life_with_dog;host=localhost';
=======
$dsn = 'mysql:dbname=life_with_dog;host=localhost';
>>>>>>> ed32b0d49da31dc9793944e118f27f0394be743d
$user = 'root';
$password = '';


<<<<<<< HEAD
$dbh = new PDO($dsh, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// PDOExceptionが使用可能になる。この中にエラー文が格納される
$dbh->query('SET NAMES utf8');
=======
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// PDOExceptionが使用可能になる。この中にエラー文が格納される。
$dbh->query('SET NAMES utf8');


>>>>>>> ed32b0d49da31dc9793944e118f27f0394be743d
?>