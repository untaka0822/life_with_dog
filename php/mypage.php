<?php
  session_start();
  require('dbconnect.php');
  
  // ログイン判定プログラム
if (isset($_SESSION['login_user_id']) && $_SESSION['time']+ 3600 > time()) {
  $_SESSION['time'] = time();
  $sql = 'SELECT * FROM `users` WHERE `user_id`=?';
  $data = array($_SESSION['login_user_id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $login_user = $stmt->fetch(PDO::FETCH_ASSOC);

}else{
    // ログインしていない場合
    header('Location: login.php');
    exit();
}

  $sql = 'SELECT * FROM `users` WHERE `user_id`=?';
  $data = array($login_user['user_id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  $sql = 'SELECT * FROM `dogs` WHERE `user_id`=?';
  $data = array($login_user['user_id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $sql = 'SELECT `area_id`, `area_name` FROM `areas`';
  $data = array();
  $area_stmt = $dbh->prepare($sql);
  $area_stmt->execute($data);
  $areas = array();
  while ($area = $area_stmt->fetch(PDO::FETCH_ASSOC)) {
        $areas[] = $area;
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../assets/css/mypage.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
    <!-- http://bootsnipp.com/snippets/featured/flipkart-like-navbar -->
    <title>マイページ</title>
  <!-- mypage_header.php -->
    <?php 
       require('mypage_header.php');
    ?>
  <!-- mypage_header.php end -->

</head>
<body>

<br>
<br>
<br>

  <span style="font-family: 'EB Garamond',serif;">
    <!-- mypage_sidebar.php -->
    <?php
      require('mypage_sidebar.php');
    ?>
    <!-- mypage_sidebar.php -->
    
    <div id="wrapper">
        <!-- Page content -->
        <div id="page-content-wrapper">
            <div class="page-content inset" data-spy="scroll" data-target="#spy">
                <div class="row">
                    <div class="col-md-12 well">
                        <legend>
                        <h3 style="font-size: 40px"><?php echo $user['last_name']; ?> <?php echo $user['first_name']; ?></h3>
                        </legend>
                        <img src="../img/users_picture/<?php echo $user['picture_path']; ?>" style="width: 40%; height: 40%">
                        <div class="col-md-6 col-lg-offset-6 centered navbar-text">
                          <?php for ($i=0; $i < 47; $i++): ?>
                          <?php if ($areas[$i]['area_id'] == $user['area_id']): ?>
                          <p style="font-size: 30px" value="<?php echo $areas[$i]['area_id']; ?>">都道府県 : <?php echo $areas[$i]['area_name']; ?></p>
                          <?php endif; ?>
                          <?php endfor; ?>
                          <p style="font-size: 30px">市区町村 : <?php echo $user['area_detail']; ?></p>
                          <p style="font-size: 30px">郵便番号 : <?php echo $user['postal_code']; ?></p>
                          <p style="font-size: 30px">電話番号 : <?php echo $user['phone_number']; ?></p>
                          <p style="font-size: 30px">メールアドレス : <?php echo $user['email']; ?></p>
                          <p><a class="btn btn-info" href="custom.php">編集する</a> <a class="btn btn-info" href="index_dog.php">犬を登録する</a></p>
                        </div>
                    </div>
                </div>
    
        <?php while ($dog = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
          
                <div class="row">
                    <div class="col-md-12 well">
                        <legend id="anch1" style="font-size: 30px;"> ・ <?php echo $dog['name']; ?></legend>
                        <img src="../img/dogs_picture/<?php echo $dog['dog_picture_path']; ?>" style="width: 60%; height: 60% ">
                        <div class="col-md-6 col-lg-offset-5 centered navbar-text">
                        <p style="font-size: 20px">性別 : 
                        <?php if ($dog['dog_gender'] == 1): ?>
                        <p style="font-size: 20px" value="1">オス</p>
                        <?php elseif ($dog['dog_gender'] == 2): ?>
                        <p style="font-size: 20px" value="2">メス</p>
                        <?php endif; ?>
                        </p>
                        <p style="font-size: 20px">誕生日 : <?php echo $dog['birth']; ?></p>
                        <p style="font-size: 20px">犬種 : <?php echo $dog['type']; ?></p>
                        <p style="font-size: 20px">サイズ : 
                        <?php if ($dog['size_id'] == 1): ?>
                        <p style="font-size: 20px" value="1">小型犬</p>
                        <?php elseif ($dog['size_id'] == 2): ?>
                        <p style="font-size: 20px" value="2">中型犬</p>
                        <?php elseif ($dog['size_id'] == 3): ?>
                        <p style="font-size: 20px" value="3">大型犬</p>
                        <?php elseif ($dog['size_id'] == 4): ?>
                        <p style="font-size: 20px" value="4">特大犬</p>
                        <?php endif; ?>
                        </p>
                        <p style="font-size: 20px">ノミ・ダニ予防していますか？
                        <?php if ($dog['fleas'] == 1): ?>
                        <p style="font-size: 20px" value="1">はい</p>
                        <?php elseif ($dog['fleas'] == 2): ?>
                        <p style="font-size: 20px" value="2">いいえ</p>
                        <?php endif; ?>
                        </p>
                        <p style="font-size: 20px">混合ワクチンをしていますか？
                        <?php if ($dog['vaccin'] == 1): ?>
                        <p style="font-size: 20px" value="1">はい</p>
                        <?php elseif ($dog['vaccin'] == 2): ?>
                        <p style="font-size: 20px" value="2">いいえ</p>
                        <?php endif; ?>
                        </p>
                        <p style="font-size: 20px">避妊去勢をしていますか？
                        <?php if ($dog['spay_cast'] == 1): ?>
                        <p style="font-size: 20px" value="1">はい</p>
                        <?php elseif ($dog['spay_cast'] == 2): ?>
                        <p style="font-size: 20px" value="2">いいえ</p>
                        <?php endif; ?>
                        </p>
                        <p style="font-size: 20px">性格・特徴 : <?php echo $dog['character']; ?></p>
                        <a class="btn btn-info" href="custom.php">編集する</a>
                        </div>
                    </div>
                </div>
        <?php endwhile; ?>
            </div>
        </div>
    </div>
  </span>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery-migrate.js"></script>
    <script src="../asstes/js/bootstrap.js"></script>
</body>
</html>