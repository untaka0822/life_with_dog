<?php 
session_start();
require('dbconnect.php');

if (!isset($_SESSION['join'])) {
	header('Location: index.php');
	exit();
}
if (!empty($_POST)) {
	$last_name = $_SESSION['join']['last_name'];
	$first_name = $_SESSION['join']['first_name'];
	$email = $_SESSION['join']['email'];
	$password = $_SESSION['join']['password'];
	$password = sha1($password);
	$phone_number = $_SESSION['join']['phone_number'];
	$postal_code = $_SESSION['join']['postal_code'];
	$area_detail = $_SESSION['join']['area_detail'];
	$area_detail2 = $_SESSION['join']['area_detail2'];
	try{
		$sql = 'INSERT INTO `users` SET `last_name` = ?, `first_name` = ?, `email` = ?, `password` = ?, `phone_number` = ?, `postal_code` = ?, `area_detail` = ?, `area_detail2` = ?, `picture_path` = ?, `created` = NOW()';
		$data = array($last_name, $first_name, $email, $password, $phone_number, $postal_code, $area_detail, $area_detail2);
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);

		unset($_SESSION['join']);
		exit();
	}catch(PDOException $e){
		echo 'SQL文実行時のエラー: ' . $e->getMessage();
			exit();
	}
}
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<link href="../assets/css/bootstrap.css" rel="stylesheet">
  <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet"> 
  <link href="../assets/css/login.css" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
	<title>会員登録確認</title>
  <header>
    <nav>
      <ul>
        <li class="title">
          <a href="top.html" style="font-size: 45px; font-family: 'Times New Roman',italic;">
            Life <span style="font-size:30px;">with</span> Dog
          </a>
        </li>
      </ul>
    </nav>
  </header>
</head>
<body>
<div class="container">
    <div class="row">
		<h1>新規会員登録確認</h1>
        <div id="bc1" class="btn-group btn-breadcrumb">
            <a href="#" class="btn btn-default">
             <div>　    　新規登録　    　</div>
            </a>
            <a href="#" class="btn btn-default">
             <div style="color: red; font-weight: bold">　　    登録内容確認　    　</div>
            </a>
            <a href="#" class="btn btn-default">
             <div>　    　登録完了　    　</div>
            </a>
        </div>
	</div>
</div>

<div class="container">
<form class="form-horizontal">
<fieldset>

<br>
<br>
<br>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">姓</label>  
  <div class="col-md-4">
  life with dog
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">名</label>  
  <div class="col-md-4">
  life with dog
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">メールアドレス</label>  
  <div class="col-md-4">
    nex@seed.com
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">パスワード</label>  
  <div class="col-md-4">
    ※※※※※※
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">再入力</label>  
  <div class="col-md-4">
  ※※※※※※※
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">性別</label>
  <div class="col-md-4">
      男性
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">郵便番号</label>  
  <div class="col-md-4">
  999-9999
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">都道府県</label>
  <div class="col-md-4">
  大阪
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">市区町村</label>  
  <div class="col-md-4">
  大阪市・・・・・・・
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">番地・マンション名</label>  
  <div class="col-md-4">
  大阪市・・・・・・・
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">電話番号</label>  
  <div class="col-md-4">
    ０９０−１２２３−４５６６    
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">プロフィール写真</label>
  <div class="col-md-4">

  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-5 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">完了</button>
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">書き直す</button>
  </div>
</div>

</fieldset>
</form>

</div>
	<script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>