<?php

session_start();
require('dbconnect.php');

$sql = 'SELECT * FROM `users` WHERE 1';
$data = array();
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

$user = $stmt->fetch(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($user);
// echo '</pre>';

// echo $user['last_name']   . '<br>';
// echo $user['first_name']  . '<br>';
// echo $user['gender']      . '<br>';
// echo $user['area_detail'] . '<br>';
// echo $user['area_detail2'];


// <img src="../assets/images/<?php echo $user['picture_path'];


$sql = 'SELECT * FROM `dogs` WHERE 1';
$data = array();
$stmt = $dbh->prepare($sql);
$stmt->execute();

$dog = $stmt->fetch(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($dog);
// echo '</pre>';

// echo $dog['name']         . '<br>';
// echo $dog['age']          . '<br>';
// echo $dog['gender']       . '<br>';
// echo $dog['type']         . '<br>';
// echo $dog['size_id']      . '<br>';
// echo $dog['fleas']        . '<br>';
// echo $dog['vaccin']       . '<br>';
// echo $dog['spay_cast']    . '<br>';
// echo $dog['character']    . '<br>';


// <img src="../assets/images/<?php echo $dog['picture_path'];

// $last_name = 'last_name';
// $first_name = 'first_name';
// $gender = 'gender';
// $area_detail = 'area_detail';
// $picture_path = 'picture_path';

// $profile = array('last_name','first_name','gender','area_detail','picture_path');

// echo $profile[0] . '<br>';
// echo $profile[1] . '<br>';
// echo $profile[2] . '<br>';
// echo $profile[3] . '<br>';
// echo $profile[4] . '<br>';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
	<header class="navbar-fixed-top">
  <nav>
    <ul>
      <li class="title">
        <a href="#" style="font-size: 45px; font-family: 'Times New Roman',italic;">
          Life <span style="font-size:30px;">with</span> Dog
        </a>
      </li>
      <li class="nav_list">
        <a href="#">
          体験したい人
        </a>
      </li>
      <li class="nav_list">
        <a href="#">
          体験する人
        </a>
      </li>
      <li class="nav_list">
        <a href="#">
          マイページ
        </a>
      </li>
      <li class="li-logout">
        <a href="#">
          <div class="hd-logout">
            Logout
          </div>
        </a>
      </li>
    </ul>
  </nav>
</header>
 <div class="clear"></div>
 	<link rel="stylesheet" type="text/css" href="../assets/css/header.css">
 	<link rel="stylesheet" type="text/css" href="../assets/css/result_search.css">
 	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<title></title>
</head>

<br>
<br>
<br>
<br>

<body>
	<div class="container">
	 <div class="row">

		<h2>ユーザー詳細ページ</h2>

      <div class="col-md-6 col-lg-offset-3 centered">
      <div class="panel panel-default">
      <div class="panel-heading"><h4>ユーザープロフィール</h4></div>
      <div class="panel-body">
      <div class="box box-info">
      <div class="box-body">
      <div class="col-sm-6 col-lg-offset-4 centered">
        <div>
          <img src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" style="width: 130px; height 130px">
          <input id="profile-image-upload" class="hidden" type="file">
              <!--Upload Image Js And Css-->
        </div>
        <br>
              <!-- /input-group -->
        </div>
        <div class="clearfix"></div>
          <hr style="margin:5px 0 5px 0;">
          <br>

          <div class="info">
          <div class="col-sm-5 col-xs-6 tital">姓:<?php echo $user['last_name']; ?></div><div class="col-sm-7 col-xs-6 "></div>
          <div class="clearfix"></div>
          <div class="bot-border"></div>

          <div class="col-sm-5 col-xs-6 tital">名:<?php echo $user['first_name']; ?></div><div class="col-sm-7"></div>
          <div class="clearfix"></div>
          <div class="bot-border"></div>

          <div class="col-sm-5 col-xs-6 tital">性別:<?php echo $user['gender']; ?></div><div class="col-sm-7"></div>

          <div class="clearfix"></div>
          <div class="bot-border"></div>

          <div class="col-sm-5 col-xs-6 tital">都道府県:<?php echo $user['area_detail']; ?></div><div class="col-sm-7"></div>

          <div class="clearfix"></div>
          <div class="bot-border"></div>

          <div class="col-sm-5 col-xs-6 tital">市区町村:<?php echo $user['area_detail2']; ?></div><div class="col-sm-7"></div>
                  <!-- /.box-body -->
        </div>
              <!-- /.box -->
      </div>
    </div>
  </div>
</div>
  
  <script>
  $(function() {
    $('#profile-image1').on('click', function() {
        $('#profile-image-upload').click();
    });
});
  </script>
  </div>
  </div>
  </div>

  <div class="container">
    <div class="row">
    <div class="">

		  <h2>愛犬詳細ページ</h2>

      <div class="col-md-6 col-lg-offset-3 centered">

      <div class="panel panel-default">
      <div class="panel-heading"><h4>愛犬プロフィール</h4></div>
      <div class="panel-body">
      <div class="box box-info">
      <div class="box-body">
      <div class="col-sm-6 col-lg-offset-4 centered">
        <div>
          <img src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" style="width: 130px; height: 130px">
          <input id="profile-image-upload" class="hidden" type="file">
                <!--Upload Image Js And Css-->
        </div>
        <br>
             		<!-- /input-group -->
      </div>
      </div>
        <div id="contents"></div>
          <div class="clearfix"></div>
            <hr style="margin:5px 0 5px 0;">
              <div class="info">

              <div class="col-sm-5 col-xs-6 tital">愛犬の名前:<?php echo $dog['name']; ?></div><div class="col-sm-7"></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">生年月日:<?php echo $dog['age']; ?></div><div class="col-sm-7"></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">性別:<?php echo $dog['gender']; ?></div><div class="col-sm-7"></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">サイズ:<?php echo $dog['size_id']; ?></div><div class="col-sm-7"></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">犬種:<?php echo $dog['type']; ?></div><div class="col-sm-7"></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">避妊・去勢をしている:<?php echo $dog['spay_cast']; ?></div><div class="col-sm-7"></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">混合ワクチンをしている:<?php echo $dog['vaccin']; ?></div><div class="col-sm-7"></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">ノミ・ダニ予防をしている:<?php echo $dog['fleas'] ?></div><div class="col-sm-7"></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">性格・特徴について:<?php echo $dog['character']; ?></div><div class="col-sm-7"></div>

              <!-- /.box-body -->
              </div>
              <!-- /.box -->
              </div>
            </div>
          </div>
        </div>
      </div>
    <script>
    $(function() {
    $('#profile-image1').on('click', function() {
        $('#profile-image-upload').click();
    });
    });
    </script>
   		</div>
		</div>
    <form>
      <a href="search.html" class="btn btn-primary btn-mg" id="return">戻る</a>
    </form><br>
	</body>
</html>