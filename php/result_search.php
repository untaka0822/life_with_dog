<?php

session_start();
require('dbconnect.php');
require('../functions.php');

// $sql = 'SELECT * FROM `users` WHERE 1';
// $data = array();
// $stmt = $dbh->prepare($sql);
// $stmt->execute($data);
// $users = array();
// while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
//    $users[] = $user;
//  }

// echo '<pre>';
// var_dump($users);
// echo '</pre>';

// echo $user['last_name']   . '<br>';
// echo $user['first_name']  . '<br>';
// echo $user['gender']      . '<br>';
// echo $user['area_detail'] . '<br>';
// echo $user['area_detail2'];


// <img src="../assets/images/<?php echo $user['picture_path'];


// $sql = 'SELECT * FROM `dogs` WHERE 1';
// $data = array();
// $stmt = $dbh->prepare($sql);
// $stmt->execute($data);
// $dogs = array();
// while ($dog = $stmt->fetch(PDO::FETCH_ASSOC)) {
//    $dogs[] = $dog;
//  }

// echo '<pre>';
// var_dump($dogs);
// echo '</pre>';



// $sql = 'SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id=dogs.user_id';
// $data = array();
// $stmt = $dbh->prepare($sql);
// $stmt->execute($data);
// $users = array();
// while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
//    $users[] = $user;
//  }

// echo '<pre>';
// var_dump($users);
// echo '</pre>';


$sql = 'SELECT * FROM `users` WHERE `user_id`=?';
$data = array($_REQUEST['user_id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($user['user_id']);
// echo '</pre>';


$sql = 'SELECT * FROM `dogs` WHERE `user_id`=?';
$data = array($user['user_id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

$dogs = array();
while ($dog = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $dogs[] = $dog;
 }

// echo '<pre>';
// var_dump($dogs[0]);
// echo '</pre>';



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
// var_dump($user[$_REQUEST['user_id']]['name']);
// var_dump($user);
// var_dump($_REQUEST);

?>
<!-- <php if (条件式): ?>
  処理（HTML）
<php endif; ?>
 -->

<br>
<br>
<br>
<br>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/result_search.css">
  <title>詳細結果</title>

</head>
<body>
  <?php
    //require('../header.php');
  ?>
  <div class="container">
   <div class="row">

    <div class=""><h2>ユーザー詳細ページ</h2></div>

    <div class="col-md-6 col-lg-offset-3 centered">
    <div class="panel panel-default">
    <div class="panel-heading"><h4>ユーザープロフィール</h4></div>
    <div class="panel-body">
    <div class="box box-info">
    <div class="box-body">
    <div class="col-sm-6 col-lg-offset-4 centered">
        <div>
          <img src="<?php $users[$_REQUEST['user_id']]['picture_path']; ?>" style="width: 130px; height: 130px">
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
          <div class="col-sm-5 col-xs-6 tital">姓</div><div class="col-xs-1" >:</div><div class="col-xs-1"><?php echo $user['last_name']; ?></div>
          <div class="clearfix"></div>
          <div class="bot-border"></div>

          <div class="col-sm-5 col-xs-6 tital">名</div><div class="col-xs-1">:</div><div class="col-xs-1"><?php echo $user['first_name']; ?></div>
          <div class="clearfix"></div>
          <div class="bot-border"></div>

          <div class="col-sm-5 col-xs-6 tital">性別</div><div class="col-xs-1">:</div><div class="col-xs-1"><?php echo $user['gender']; ?></div>

          <div class="clearfix"></div>
          <div class="bot-border"></div>

          <div class="col-sm-5 col-xs-6 tital">都道府県</div><div class="col-xs-1">:</div><div class="col-xs-1"><?php echo $user['area_detail']; ?></div>

          <div class="clearfix"></div>
          <div class="bot-border"></div>

          <div class="col-sm-5 col-xs-6 tital">市区町村</div><div class="col-xs-1">:</div><div class="col-xs-1"><?php echo $user['area_detail2']; ?></div>
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

      <h2>愛犬詳細ページ</h2>

        <div class="col-md-6 col-lg-offset-3 centered">

    <div class="panel panel-default">
    <div class="panel-heading"><h4>愛犬プロフィール</h4></div>
    <div class="panel-body">
    <div class="box box-info">
    <div class="box-body">
    <div class="col-sm-6 col-lg-offset-4 centered">
        <div>
            <img src="<?php $dogs[0]['dog_picture_path']; ?> style="width: 130px; height: 130px">
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

              <div class="col-sm-5 col-xs-6 tital">愛犬の名前</div><div class="col-xs-1">:</div><div class="col-xs-1"><?php echo $dogs[0]['name']; ?></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">生年月日</div><div class="col-xs-1">:</div><div class="col-xs-3"><?php echo $dogs[0]['birth']; ?></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">性別</div><div class="col-xs-1">:</div><div class="col-xs-1"><?php echo $dogs[0]['gender']; ?></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">サイズ</div><div class="col-xs-1">:</div><div class="col-xs-1"><?php echo $dogs[0]['size_id']; ?></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">犬種</div><div class="col-xs-1">:</div><div class="col-xs-1"><?php echo $dogs[0]['type']; ?></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">避妊・去勢をしている</div><div class="col-xs-1">:</div><div class="col-xs-1"><?php echo $dogs[0]['spay_cast']; ?></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">混合ワクチンをしている</div><div class="col-xs-1">:</div><div class="col-xs-1"><?php echo $dogs[0]['vaccin']; ?></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">ノミ・ダニ予防をしている</div><div class="col-xs-1">:</div><div class="col-xs-1"><?php echo $dogs[0]['fleas']; ?></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">性格・特徴について</div><div class="col-xs-1">:</div><div class="col-xs-1"><?php echo $dogs[0]['character']; ?></div>

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

    <!-- <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/jquery-migrate.js"></script>
    <script src="../assets/js/jquery.js"></script> -->
  </body>
</html>