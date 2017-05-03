<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../assets/css/thanks_reservation.css">
<link rel="stylesheet" type="text/css" href="../assets/css/header.css">
<header>
<?php
    require('mypage_header.php');
  ?>
</header>
<div class="clear"></div>
<?php
  // $file_name = getFileNameFromUri();
  // ($file_name == 'index.php'):
?>

<?php // endif; ?>
  <title></title>
</head>
<body>
<br>
<br>
<br>
<br>
<h1>予約完了いたしました。</h1>
<br>
<div class="buttons">
  <div class="button">
    <a href="user_history.php" type="submit" class="btn btn-primary btn-mg">利用履歴へ</a>
  </div>
    <a href="sns.php" type="submit" class="btn btn-primary btn-mg">やりとりへ</a>
</div>
</body>
</html>