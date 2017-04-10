<?php 
  require('functions.php');
// ロジック
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title></title>
  <!-- CSSの読み込み -->
	<?php require('load_css.php'); ?>
</head>
<body>
 <?php require('header.php'); ?>
 <?php require('left_side.php'); ?>
 メインコンテンツ(index用)<br> <!-- これだけ残す -->
 <?php require('footer.php'); ?>

<!-- JavaScriptの読み込み -->
 <?php require('load_js.php'); ?>
</body>
</html>