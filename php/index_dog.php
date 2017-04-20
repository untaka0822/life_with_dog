<?php 
session_start();
require('dbconnect.php');

$name = '';
$age = '';
$gender = '';
$type = '';
$size_id = '';
$fleas = '';
$vaccin = '';
$spay_cast = '';
$character = '';
$picture_path = '';

$errors = array();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'rewrite') {
	$_POST = $_SESSION['join'];
	$errors['rewrite'] = true;
}

if (!empty($_POST)) {
	$name = $_POST['name'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$type = $_POST['type'];
	$size_id = $_POST['size_id'];
	$fleas = $_POST['fleas'];
	$vaccin = $_POST['vaccin'];
	$spay_cast = $_POST['spay_cast'];
	$character = $_POST['character'];
	if ($name == '') {
		$errors['name'] = 'blank';
	}
	if ($age == '') {
		$errors['age'] = 'blank';
	}
	if ($gender == '') {
		$errors['gender'] = 'blank';
	}
	if ($size_id == '') {
		$errors['size_id'] = 'blank';
	}
	if ($fleas == '') {
		$errors['fleas'] = 'blank';
	}
	if ($vaccin == '') {
		$errors['vaccin'] = 'blank';
	}
	if ($spay_cast == '') {
		$errors['spay_cast'] = 'blank';
	}
	if ($character == '') {
		$errors['character'] = 'blank';
	}
	if (empty($errors)) {
		$file_name = $_FILES['picture_path']['name'];
		if (!empty($file_name)) {
			$ext = substr($file_name, -3);
			$ext = strtolower($ext);
			if ($ext != 'jpg' && $ext != 'png' && $ext != 'gif') {
				$errors['picture_path'] = 'type';
			}else{
				$errors['picture_path'] = 'blank';
			}
		}
	}	
	if (empty($errors)) {
		$picture_name = date('YmdHis') . $file_name;
		move_uploaded_file($_FILES['picture_path']['tmp_name'], '../user_picture/' . $picture_name);
		$_SESSION['join'] = $_POST;
		$_SESSION['join']['picture_path'] = $picture_name;
		header('Location: check_dog.php');
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
	<title>新規愛犬登録</title>
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
		<h1>新規愛犬登録</h1>
        <div id="bc1" class="btn-group btn-breadcrumb">
            <a href="#" class="btn btn-default">
             <div style="color: red; font-weight: bold">　    　新規愛犬登録　    　</div>
            </a>
            <a href="#" class="btn btn-default">
             <div>　　    登録内容確認　    　</div>
            </a>
            <a href="#" class="btn btn-default">
             <div>　    　愛犬登録完了　    　</div>
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
  <label class="col-md-4 control-label" for="textinput">愛犬名</label>  
  <div class="col-md-4">
  <input id="textinput" name="name" type="text" placeholder="例：life dog" class="form-control input-md">
	  <?php if(isset($errors['name']) && $errors['name'] == 'blank'): ?>
	  	<p style="color: red; font-size: 10px; margin-top: 2px;">愛犬名を入力してください</p>
	  <?php endif; ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">生年月日</label>  
  <div class="col-md-4">
  <input id="textinput" name="age" type="text" placeholder="例：2016/4/1" class="form-control input-md">
  	<?php if(isset($errors['age']) && $errors['age'] == 'blank'): ?>
	  	<p style="color: red; font-size: 10px; margin-top: 2px;">生年月日を入力してください</p>
	  <?php endif; ?>
  </div>
</div>



<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">性別</label>
  <div class="col-md-4">
    <select id="selectbasic" name="gender" class="form-control">
      <option value="1">オス</option>
      <option value="2">メス</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">サイズ</label>
  <div class="col-md-4">
    <select id="selectbasic" name="size_id" class="form-control">
      <option value="1">小型(~10kg)</option>
      <option value="2">中型(10~20kg)</option>
      <option value="3">大型(20~30kg)</option>
      <option value="4">特大型(30kg~)</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">犬種</label>  
  <div class="col-md-4">
  <input id="textinput" name="type" type="textinput" placeholder="" class="form-control input-md">
  	<?php if(isset($errors['type']) && $errors['type'] == 'blank'): ?>
	  	<p style="color: red; font-size: 10px; margin-top: 2px;">犬種名を入力してください</p>
	  <?php endif; ?>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">確認事項</label> 
  <div class="col-md-4 control-label" style="text-align : left">
    <p class="data">ノミ・ダニ予防をしていますか？</p>
    <input type="checkbox" id="health" name="fleas" value="1"> はい
    <input type="checkbox" id="health" name="fleas" value="2"> いいえ
  </div>
  <br>
  <div class="col-md-4 control-label col-xs-offset-4" style="text-align : left">
    <p class="data">混合ワクチンの予防をしていますか？</p>
    <input type="checkbox" id="health" name="vaccin" value="1"> はい
    <input type="checkbox" id="health" name="vaccin" value="2"> いいえ
  </div>
  <div class="col-md-4 control-label col-xs-offset-4" style="text-align : left">
    <p class="data">避妊去勢をしていますか？</p>
    <input type="checkbox" id="health" name="spay_cast" value="1"> はい
    <input type="checkbox" id="health" name="spay_cast" value="2"> いいえ
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">性格・特徴について</label>  
  <div class="col-md-4">
  <textarea name="character" placeholder="例：だれにでも優しい人懐っこい性格をしています" class="form-control input-md"></textarea>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">プロフィール写真</label>
  <div class="col-md-4">
    <input id="filebutton" name="picture_path" class="input-file" type="file">
	    <?php if(isset($errors['picture_path']) && $errors['picture_path'] == 'blank'): ?>
	      <p style="color: red; font-size: 10px; margin-top: 2px;">プロフィール写真を選択してください</p>
	    <?php endif; ?>
	    <?php if(isset($errors['picture_path']) && $errors['picture_path'] == 'type'): ?>
	      <p style="color: red; font-size: 10px; margin-top: 2px;">プロフィール写真は「.gif」「.jpg」「.png」の画像を指定してください</p>
	    <?php endif; ?>
	    <?php if(!empty($errors)): ?>
	      <p style="color: red; font-size: 10px; margin-top: 2px;">再度プロフィール写真を選択してください</p>
	    <?php endif; ?>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-5 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <input type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary" value="戻る">
    <input type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary" value="確認">
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
