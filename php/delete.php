<?php 
session_start();
require('dbconnect.php');

// ログイン判定プログラム
if (isset($_SESSION['login_user_id']) && $_SESSION['time']+ 3600 > time()) {
  $_SESSION['time'] = time();
  $sql = 'SELECT * FROM `users` WHERE `user_id`=? ';
  $data = array($_SESSION['login_user_id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $login_user = $stmt->fetch(PDO::FETCH_ASSOC);

}else{
    // ログインしていない場合
    header('Location: login.php');
    exit();
}

if (isset($login_user['user_id'])) {
	echo $_REQUEST['reservation_id'];

	$sql = 'SELECT * FROM `reservations` WHERE `reservation_id`=?';
	$data = array($_REQUEST['reservation_id']);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$record = $stmt->fetch(PDO:: FETCH_ASSOC);

	echo '<pre>';
	var_dump($record);
	echo '</pre>';
  
	if ($record['host_id'] == $login_user['user_id']) {
		$sql = 'DELETE FROM `reservations` WHERE `reservation_id`=?';
		$data = array($_REQUEST['reservation_id']);
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);
	}

header('location: notice.php');
exit();
}

?>
