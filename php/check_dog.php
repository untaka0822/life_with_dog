<?php 
session_start();
require('dbconnect.php');

if (!isset($_SESSION['join'])) {
	header('Location: index_dog.php');
	exit();
}
if (!empty($_POST)) {
	$name = $_SESSION['join']['name'];
	$age = $_SESSION['join']['age'];
	$gender = $_SESSION['join']['gender'];
	$type = $_SESSION['join']['type'];
	$size_id = $_SESSION['join']['size_id'];
	$fleas = $_SESSION['join']['fleas'];
	$vaccin = $_SESSION['join']['vaccin'];
	$spay_cast = $_SESSION['join']['spay_cast'];
	$character = $_SESSION['join']['character'];
	try{
		$sql = 'INSERT INTO `dogs` SET `name` = ?, `age` = ?, `gender` = ?, `type` = ?, `size-id` = ?, `fleas` = ?, `vaccin` = ?, `spay_cast` = ?, `character` = ?, `picture_path` = ?, `created` = NOW()' ;
		$data = array($name, $age, $gender, $type, $size_id, $fleas, $vaccin, $spay_cast, $character, $picture_path);
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
	<title>愛犬登録確認</title>
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
		<h1>新規愛犬登録確認</h1>
        <div id="bc1" class="btn-group btn-breadcrumb">
            <a href="#" class="btn btn-default">
             <div>　    　新規愛犬登録　    　</div>
            </a>
            <a href="#" class="btn btn-default">
             <div style="color: red; font-weight: bold">　　    登録内容確認　    　</div>
            </a>
            <a href="#" class="btn btn-default">
             <div>　    　愛犬登録完了　    　</div>
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
  <label class="col-md-4 control-label" for="textinput">愛犬名</label>  
  <div class="col-md-4">
  	<?php echo $_SESSION['join']['name']; ?>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">生年月日</label>  
  <div class="col-md-4">
  	<?php echo $_SESSION['join']['age']; ?> 
  </div>
</div>



<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">性別</label>
  <div class="col-md-4">
  	<?php echo $_SESSION['join']['gender']; ?> 
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">サイズ</label>
  <div class="col-md-4">
  	<?php echo $_SESSION['join']['size_id']; ?> 
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">犬種</label>  
  <div class="col-md-4">
  <?php echo $_SESSION['join']['type']; ?> 
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">確認事項</label> 
  <div class="col-md-4 control-label" style="text-align : left">
    <p class="data">ノミ・ダニ予防をしていますか？</p>
    	<?php echo $_SESSION['join']['fleas']; ?> 
  </div>
  <br>
  <div class="col-md-4 control-label col-xs-offset-4" style="text-align : left">
    <p class="data">混合ワクチンの予防をしていますか？</p>
    	<?php echo $_SESSION['join']['vaccin']; ?> 
  </div>
  <div class="col-md-4 control-label col-xs-offset-4" style="text-align : left">
    <p class="data">避妊去勢をしていますか？</p>
    	<?php echo $_SESSION['join']['spay_cast']; ?> 
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">性格・特徴について</label>  
  <div class="col-md-4">
  <?php echo $_SESSION['join']['character']; ?> 
 </div>
</div>


<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">プロフィール写真</label>
  <div class="col-md-4">
  	<img src="../dog_picture/<?php echo $_SESSION['join']['name']; ?>" width="200">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-5 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">書き直す</button>
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">完了</button>
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