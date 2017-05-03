<?php 
session_start();
require('dbconnect.php');

$last_name = '';
$first_name = '';
$email = '';
$phone_number = '';
$postal_code = '';
$area_id = '';
$area_detail = '';
$area_detail2 = '';
$role = '';

$errors = array();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'rewrite') {
	$_POST = $_SESSION['join'];
	$errors['rewrite'] = true;
}if (!empty($_POST)) {
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
  $repassword = $_POST['repassword'];
  $gender = $_POST['gender'];
	$phone_number = $_POST['phone_number'];
	$postal_code = $_POST['postal_code'];
  $area_id = $_POST['area_id'];
	$area_detail = $_POST['area_detail'];
	$area_detail2 = $_POST['area_detail2'];
  $role = $_POST['role'];

	if ($last_name == '') {
		$errors['last_name'] = 'blank';
	}
	if ($first_name == '') {
		$errors['first_name'] = 'blank';
	}
	if ($email == '') {
		$errors['email'] = 'blank';
	}
	if ($password == '') {
		$errors['password'] = 'blank';
	}elseif (strlen($password) < 6) {
		$errors['password'] = 'length';
	}
  if ($repassword == '') {
    $errors['repassword'] = 'blank';
  }
	if ($phone_number == '') {
		$errors['phone_number'] = 'blank';
	}
	if ($postal_code == '') {
		$errors['postal_code'] = 'blank';
	}
	if ($area_detail == '') {
		$errors['area_detail'] = 'blank';
	}
	if ($area_detail2 == '') {
		$errors['area_detail2'] = 'blank';
	}
  if ($role == '') {
    $errors['role'] = 'blank';
  }
	if (empty($errors)) {
		$file_name = $_FILES['picture_path']['name'];
		if (!empty($file_name)) {
			$ext = substr($file_name, -3);
			$ext = strtolower($ext);
			if ($ext != 'jpg' && $ext != 'png' && $ext != 'gif') {
				$errors['picture_path'] = 'type';
			}
			}else{
				$errors['picture_path'] = 'blank';
			}
		}
		if (empty($errors)) {
			try{
				$sql = 'SELECT COUNT(*) AS `cnt` FROM `users` WHERE `email` = ?';
				$data = array($email);
				$stmt = $dbh->prepare($sql);
				$stmt->execute($data);
				$record = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($record['cnt'] > 0) {
					$errors['email'] = 'duplicate';
				}
			}catch(PDOException $e){
				echo 'SQL実行時エラー : ' . $e-> message();
			}
		}    
		if (empty($errors)) {
			$picture_name = date('YmdHis') . $file_name;
			move_uploaded_file($_FILES['picture_path']['tmp_name'], '../img/users_picture/' . $picture_name);
			$_SESSION['join'] = $_POST;
			$_SESSION['join']['picture_path'] = $picture_name;
			header('Location: check.php');
			exit();
		}
	}

  $sql = 'SELECT * FROM `areas`';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(); 
        $areas = array();
        while ($area = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $areas[] = array('area_id' => $area['area_id'], 'area_name' => $area['area_name']);
        }
        $c = count($areas);
        
 ?>


 <!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<link href="../assets/css/bootstrap.css" rel="stylesheet">
  <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet"> 
  <link href="../assets/css/login.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
<!-- 郵便番号自動検索機能用 -->
<!--   <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
 -->
	<title>会員登録</title>
  <header>
    <nav>
      <ul>
        <li class="title">
          <a href="top.php" style="font-size: 45px; font-family: 'Times New Roman',italic;">
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
		<h1>新規会員登録</h1>
        <div id="bc1" class="btn-group btn-breadcrumb">
            <a href="#" class="btn btn-default">
             <div style="color: red; font-weight: bold">　    　新規登録　    　</div>
            </a>
            <a href="#" class="btn btn-default">
             <div>　　    登録内容確認　    　</div>
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
  <input id="textinput" name="last_name" type="text" placeholder="例：life dog" class="form-control input-md">
  <?php if(isset($errors['last_name']) && $errors['last_name'] == 'blank'): ?>
  	<p style="color: red; font-size: 10px; margin-top: 2px;">姓を入力してください</p>
  <?php endif; ?>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">名</label>  
  <div class="col-md-4">
  <input id="textinput" name="first_name" type="text" placeholder="例：life dog" class="form-control input-md">
    <?php if(isset($errors['first_name']) && $errors['first_name'] == 'blank'): ?>
  		<p style="color: red; font-size: 10px; margin-top: 2px;">名を入力してください</p>
  	<?php endif; ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">メールアドレス</label>  
  <div class="col-md-4">
  <input id="textinput" name="email" type="text" placeholder="例：life@with.dog" class="form-control input-md">
    <?php if(isset($errors['email']) && $errors['email'] == 'blank'): ?>
  		<p style="color: red; font-size: 10px; margin-top: 2px;">メールアドレスを入力してください</p>
  	<?php endif; ?>
  	<?php if(isset($errors['email']) && $errors['email'] == 'duplicate'): ?>
  		<p style="color: red; font-size: 10px; margin-top: 2px;">指定したメールアドレスは既に登録されています</p>
  	<?php endif; ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">パスワード</label>  
  <div class="col-md-4">
  <input id="textinput" name="password" type="password" placeholder="パスワードは6文字以上入力してください" class="form-control input-md">
    <?php if(isset($errors['password']) && $errors['password'] == 'blank'): ?>
  		<p style="color: red; font-size: 10px; margin-top: 2px;">パスワードを入力してください</p>
  	<?php endif; ?>
  	<?php if(isset($errors['password']) && $errors['password'] == 'length'): ?>
  		<p style="color: red; font-size: 10px; margin-top: 2px;">パスワードは6文字以上入力してください</p>
  	<?php endif; ?> 
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">パスワード再入力</label>  
  <div class="col-md-4">
  <input id="textinput" name="repassword" type="password" placeholder="再度パスワード入力" class="form-control input-md">
    <?php if(isset($errors['repassword']) && $errors['repassword'] == 'blank'): ?>
      <p style="color: red; font-size: 10px; margin-top: 2px;">パスワードを入力してください</p>
    <?php endif; ?>
    <?php if($password != $repassword): ?>
      <p style="color: red; font-size: 10px; margin-top: 2px;">パスワードが一致しません</p>
    <?php endif; ?>

  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">性別</label>
  <div class="col-md-4">
    <select id="selectbasic" name="gender" class="form-control">
      <option value="1">男性</option>
      <option value="2">女性</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">郵便番号</label>  
  <div class="col-md-4">
  <input name="postal_code" type="text" placeholder="例：000-0000" class="form-control input-md" id="zip">
  <!-- <input type="text" name="zip01" size="10" maxlength="8" placeholder="例：000-0000" class="form-control input-md" onKeyUp="AjaxZip3.zip2addr(this,'','pref01','addr01'); "> -->
  	<?php if(isset($errors['postal_code']) && $errors['postal_code'] == 'blank'): ?>
  		<p style="color: red; font-size: 10px; margin-top: 2px;">郵便番号を入力してください</p>
  	<?php endif; ?>
    <?php if(!preg_match("/^[0-9]+$/", $postal_code)): ?>
      <p style="color: red; font-size: 10px; margin-top: 2px;">数字のみ入力してください</p>
    <?php endif; ?>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">都道府県</label>
  <div class="col-md-4">
    <select name="area_id" class="form-control" id="pref">
    <!-- <input type="text" name="pref01" size="20" class="form-control"> -->
      <?php for ($i=0; $i < $c; $i++): ?>
        <option value="<?php echo $areas[$i]['area_id']; ?>"><?php echo $areas[$i]['area_name']; ?></option>
      <?php endfor; ?>
    </select>

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">市区町村</label>  
  <div class="col-md-4">
  <input name="area_detail" type="text" placeholder="例：足立区・・・" class="form-control input-md" id="city">
  <!-- <input type="text" name="addr01" size="60" placeholder="例：足立区・・・" class="form-control input-md" id="city"> -->
  	<?php if(isset($errors['area_detail']) && $errors['area_detail'] == 'blank'): ?>
  		<p style="color: red; font-size: 10px; margin-top: 2px;">市区町村を入力してください</p>
  	<?php endif; ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">番地・マンション名</label>  
  <div class="col-md-4">
  <input name="area_detail2" type="text" placeholder="例：3-1-23 サンライズ220" class="form-control input-md">
  	<?php if(isset($errors['area_detail2']) && $errors['area_detail2'] == 'blank'): ?>
  		<p style="color: red; font-size: 10px; margin-top: 2px;">番地・マンション名を入力してください</p>
  	<?php endif; ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">電話番号</label>
  <div class="col-md-4">
  <input id="textinput" name="phone_number" type="text" placeholder="例：090000000" class="form-control input-md">
    <?php if(isset($errors['phone_number']) && $errors['phone_number'] == 'blank'): ?>
  		<p style="color: red; font-size: 10px; margin-top: 2px;">電話番号を入力してください</p>
  	<?php endif; ?>
    <?php if(!preg_match("/^[0-9]+$/", $phone_number)): ?>
      <p style="color: red; font-size: 10px; margin-top: 2px;">数字のみ入力してください</p>
    <?php endif; ?>
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

<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">あなたの希望は？</label>
  <div class="col-md-4">
    <select id="selectbasic" name="role" class="form-control">
      <option value="1">体験だけしたい</option>
      <option value="2">預るだけしたい</option>
      <option value="0">両方したい</option>
    </select>

  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-5 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <input type="button" id="singlebutton" value="戻る" class="btn btn-primary" onclick="location.href='login.php'">
    <input type="submit" id="singlebutton" value="確認画面へ" class="btn btn-primary">
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