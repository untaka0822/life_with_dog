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

if (!empty($_POST)) {
	$name = $_SESSION['join']['name'];
	$birth = $_SESSION['join']['birth'];
	$dog_gender = $_SESSION['join']['dog_gender'];
	$type = $_SESSION['join']['type'];
	$size_id = $_SESSION['join']['size_id'];
	$fleas = $_SESSION['join']['fleas'];
	$vaccin = $_SESSION['join']['vaccin'];
	$spay_cast = $_SESSION['join']['spay_cast'];
	$character = $_SESSION['join']['character'];
  $dog_picture_path = $_SESSION['join']['dog_picture_path'];
  try{
    	$sql = 'INSERT INTO `dogs` SET `user_id` = ?, `name` = ?, `birth` = ?, `dog_gender` = ?, `type` = ?, `size_id` = ?, `fleas` = ?, `vaccin` = ?, `spay_cast` = ?, `character` = ?, `dog_picture_path` = ?, `created` = NOW()' ;
    	$data = array($login_user['user_id'], $name, $birth, $dog_gender, $type, $size_id, $fleas, $vaccin, $spay_cast, $character, $dog_picture_path);
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);

    	unset($_SESSION['join']);

      header('Location: thanks_dog.php');
      exit();
      }catch(PDOException $e){
              // 例外が発生した場合の処理
          echo 'SQL文実行時のエラー: ' . $e->getMessage();
          exit();
      }
}

  $sql = 'SELECT * FROM `dogs_size` WHERE 1';
  $data = array();
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $sizes = array();
  while ($size = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $sizes[] = $size;
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
<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
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
  	<?php echo $_SESSION['join']['birth']; ?> 
  </div>
</div>



<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">性別</label>
  <div class="col-md-4">
  	<?php if($_SESSION['join']['dog_gender'] == 1): ?>
      <p>オス</p>
    <?php endif; ?>
    <?php if($_SESSION['join']['dog_gender'] == 2): ?> 
      <p>メス</p>
    <?php endif; ?>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">サイズ</label>
  <div class="col-md-4">
    <?php foreach ($sizes as $size):?>
      <?php if($size['size_id'] == $_SESSION['join']['size_id']): ?>
        <?php echo $size['size_name']; ?>
      <?php endif; ?>
    <?php endforeach; ?>
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
    <?php if($_SESSION['join']['fleas'] == 1): ?>
      <p>はい</p>
    <?php endif; ?>
    <?php if($_SESSION['join']['fleas'] == 2): ?> 
      <p>いいえ</p>
    <?php endif; ?> 
  </div>
  <br>
  <div class="col-md-4 control-label col-xs-offset-4" style="text-align : left">
    <p class="data">混合ワクチンの予防をしていますか？</p>
    <?php if($_SESSION['join']['vaccin'] == 1): ?>
      <p>はい</p>
    <?php endif; ?>
    <?php if($_SESSION['join']['vaccin'] == 2): ?> 
      <p>いいえ</p>
    <?php endif; ?> 
  </div>
  <div class="col-md-4 control-label col-xs-offset-4" style="text-align : left">
    <p class="data">避妊去勢をしていますか？</p>
    <?php if($_SESSION['join']['spay_cast'] == 1): ?>
      <p>はい</p>
    <?php endif; ?>
    <?php if($_SESSION['join']['spay_cast'] == 2): ?> 
      <p>いいえ</p>
    <?php endif; ?>  
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
  	<img src="../img/dogs_picture/<?php echo $_SESSION['join']['dog_picture_path']; ?>" width="200">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-5 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <input type="button" value="戻る" id="singlebutton" name="singlebutton" class="btn btn-primary" onclick="location.href='index_dog.php'">
    <input type="submit" value="愛犬登録" id="singlebutton" name="singlebutton" class="btn btn-primary">
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