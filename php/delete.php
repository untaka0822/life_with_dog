<?php 
session_start();
require('dbconnect.php');
$_SESSION['login_user_id'] = 2;

if (isset($_SESSION['login_user_id'])) {
	echo $_REQUEST['reservation_id'];

	$sql = 'SELECT * FROM `reservations` WHERE `reservation_id`=?';
	$data = array($_REQUEST['reservation_id']);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$record = $stmt->fetch(PDO:: FETCH_ASSOC);

	echo '<pre>';
	var_dump($record);
	echo '</pre>';

	if ($record['host_id'] == $_SESSION['login_user_id']) {
		$sql = 'DELETE FROM `reservations` WHERE `reservation_id`=?';
		$data = array($_REQUEST['reservation_id']);
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);
	}
	echo '<pre>';
	var_dump($stmt);
	echo '</pre>';
}
header('location: notice.php');
exit();
 ?>
