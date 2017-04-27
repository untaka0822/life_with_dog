<?php
session_start();
require('dbconnect.php');

$_SESSION['login_member_id'] = 1;
$you = 2;
$start_date = '';
$end_date = '';

if (!isset($_SESSION['reserve'])) {
    header('Location: sns_reservation.php');
    exit();
}

if (!empty($_POST)) {
    $start_date = $_SESSION['reserve']['start_year'] . $_SESSION['reserve']['start_month'] . $_SESSION['reserve']['start_date'];
    $end_date = $_SESSION['reserve']['end_year'] . $_SESSION['reserve']['end_month'] . $_SESSION['reserve']['end_date'];

    $sql = 'INSERT INTO `reservations` SET `host_id`= ?, `client_id`=?,  `date_start`=?, `date_end`=?';
    $data = array($_SESSION['login_member_id'], $you, $start_date, $end_date);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    header('Location: thanks_reservation.php');
    exit();

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
</head>
<body>
<br>
<h1>予約内容の確認</h1>
<br>
<form method="post" action="check_reservation.php">
<div class="confirm">
  <p>開始日 : <?php echo $_SESSION['reserve']['start_year']; ?>年 <?php echo $_SESSION['reserve']['start_month']; ?>月 <?php echo $_SESSION['reserve']['start_date']; ?>日</p>
  <p>終了日 : <?php echo $_SESSION['reserve']['end_year']; ?>年 <?php echo $_SESSION['reserve']['end_month']; ?>月 <?php echo $_SESSION['reserve']['end_date']; ?>日</p>
  <p>体験者 : ○○ ○○様</p>
</div>
<br>
<div class="buttons">
  <div class="button">
    <a href="sns_reservation.php" class="btn btn-primary btn-mg">戻る</a>
  </div>
  <form method="post" action="check_reservation.php">
    <input type="submit" name="data" value="予約完了" class="btn btn-primary btn-mg">
  </form>
</div>
</body>
</html>