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
    $gender = $_SESSION['join']['gender'];
    $phone_number = $_SESSION['join']['phone_number'];
    $postal_code = $_SESSION['join']['postal_code'];
    $area_id = $_SESSION['join']['area_id'];
    $area_detail = $_SESSION['join']['area_detail'];
    $area_detail2 = $_SESSION['join']['area_detail2'];
    $picture_path = $_SESSION['join']['picture_path'];
    $role = $_SESSION['join']['role'];

    $sql = 'INSERT INTO `users` SET `last_name` = ?, `first_name` = ?, `email` = ?, `password` = ?, `gender` = ?, `phone_number` = ?, `postal_code` = ?, `area_id` = ?, `area_detail` = ?, `area_detail2` = ?, `picture_path` = ?, `role` = ?, `created` = NOW()';
    $data = array($last_name, $first_name, $email, $password, $gender, $phone_number, $postal_code, $area_id, $area_detail, $area_detail2, $picture_path, $role);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    unset($_SESSION['join']);

    header('Location: thanks.php');
    exit();

}

  $sql = 'SELECT * FROM `areas` WHERE 1';
  $data = array();
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $areas = array();
  while ($area = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $areas[] = $area;
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
<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
<fieldset>

<br>
<br>
<br>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">姓</label>  
  <div class="col-md-4">
  	<?php echo $_SESSION['join']['last_name']; ?>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">名</label>  
  <div class="col-md-4">
  	<?php echo $_SESSION['join']['first_name']; ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">メールアドレス</label>  
  <div class="col-md-4">
    <?php echo $_SESSION['join']['email']; ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">パスワード</label>  
  <div class="col-md-4">
    <?php echo $_SESSION['join']['password']; ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">再入力</label>  
  <div class="col-md-4">
  	<?php echo $_SESSION['join']['password']; ?>	
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">性別</label>
  <div class="col-md-4">
    <?php if($_SESSION['join']['gender'] == 1): ?>
      <p>男性</p>
    <?php endif; ?>
    <?php if($_SESSION['join']['gender'] == 2): ?> 
      <p>女性</p>
    <?php endif; ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">郵便番号</label>  
  <div class="col-md-4">
  	<?php echo $_SESSION['join']['postal_code']; ?>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">都道府県</label>
  <div class="col-md-4">
    <?php foreach($areas as $area): ?>
      <?php if($area['area_id'] == $_SESSION['join']['area_id']): ?>
        <?php echo $area['area_name']; ?>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">市区町村</label>  
  <div class="col-md-4">
  	<?php echo $_SESSION['join']['area_detail']; ?>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">番地・マンション名</label>  
  <div class="col-md-4">
  	<?php echo $_SESSION['join']['area_detail2']; ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">電話番号</label>  
  <div class="col-md-4">
    <?php echo $_SESSION['join']['phone_number']; ?>    
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">プロフィール写真</label>
  <div class="col-md-4">
  	<img src="../user_picture/<?php echo $_SESSION['join']['picture_path']; ?>" width="200">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">あなたの希望は？</label>
  <div class="col-md-4">
    <?php if($_SESSION['join']['role'] == 0): ?>
      <p>両方したい</p>
    <?php endif; ?>
    <?php if($_SESSION['join']['role'] == 1): ?>
      <p>体験だけしたい</p>
    <?php endif; ?>
    <?php if($_SESSION['join']['role'] == 2): ?>
      <p>預るだけしたい</p>
    <?php endif; ?>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-5 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <a href="index.php?action=rewrite">書き直す</a>
    <input type="submit" value="会員登録" id="singlebutton" name="singlebutton" class="btn btn-primary">
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