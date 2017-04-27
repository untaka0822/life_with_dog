<?php
session_start();
require('dbconnect.php');

$me = 1;
$you = 2;
$start_date = '';
$end_date = '';

if (!empty($_GET)) {
    $start_date = $_SESSION['reserve']['start_year'] . $_SESSION['reserve']['start_month'] . $_SESSION['reserve']['start_date'];
    $end_date = $_SESSION['reserve']['end_year'] . $_SESSION['reserve']['end_month'] . $_SESSION['reserve']['end_date'];

    $sql = 'INSERT INTO `reservations` SET `host_id`= ?, `client_id`=?,  `date_start`=?, `date_end`=?';
    $data = array($me, $you, $start_date, $end_date);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    header('Location: thanks_reservation.html');
    exit();

}

var_dump($_SESSION);
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
    <button type="submit" name="data" class="btn btn-primary btn-mg">予約完了</button>
  </form>
</div>
</body>
</html>