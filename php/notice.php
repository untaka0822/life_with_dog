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

if (isset($login_user['user_id'])) {
  $sql = 'SELECT * FROM `reservations` WHERE `host_id`=? AND `flag`= 0';
  $data = array($login_user['user_id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  if (!empty($_POST['reservation_id'])) {
      $sql = 'UPDATE `reservations` SET `flag`=1 WHERE `reservation_id`=?';
      $data = array($_POST['reservation_id']);
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
      header('Location: notice.php');
      exit();
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../assets/css/notice.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/mypage.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
  <title>リクエスト</title>
  <!-- mypage_header.php -->
  <?php
     require('mypage_header.php');
   ?>
   <!-- mypage_header.php end -->
</head>
<br>
<br>
<br>
<br>
<body data-spy="scroll" data-offset="0" data-target="#theMenu">
<span style="font-family: 'EB Garamond',serif;">
<!-- mypage_sidebar.php -->
<?php
require('mypage_sidebar.php');
?>
<!-- mypage_sidebar.php end -->
<div class="container">
  <div class="row">
    <div class="col-md-8 col-lg-offset-3 cnetered well">
      <div class="page-header">
        <h1>リクエスト一覧</h1>
      </div> 
      <div class="comments-list">
        <?php while ($reserved = $stmt->fetch(PDO::FETCH_ASSOC)):?>
          <?php if($reserved['flag'] == 0): ?>
            <div class="media">
              <a class="media-left" href="#">
                <?php $sql = 'SELECT * FROM `users` WHERE `user_id`=?';
                      $data = array($reserved['client_id']);
                      $re_stmt = $dbh->prepare($sql);
                      $re_stmt->execute($data);
                      $user = $re_stmt->fetch(PDO::FETCH_ASSOC);
                       ?>
                <img src="../img/users_picture/<?php echo $user['picture_path']; ?>" style="width: 200px;">
              </a>
              <div class="media-body">
                <h4 class="media-heading user_name"><?php echo $user['last_name']; ?> <?php echo $user['first_name']; ?></h4>
                <p><small><a href="result_search.php?user_id=<?php echo $user['user_id']; ?>">ユーザーの詳細へ</a></small></p>
                <div>
                  <p class="col-md-8 col-lg-offset-4 centered">希望日時</p><br><br>
                  <p class="col-md-8 col-lg-offset-4 centered"><?php echo $reserved['date_start']; ?> 〜 <?php echo $reserved['date_end']; ?></p>
                  <p class="col-md-8 col-lg-offset-4 centered">申込日</p><br><br>
                  <p class="col-md-8 col-lg-offset-4 centered"><?php echo $reserved['created']; ?></p>
                  <form method="POST" action="" style="text-align: right;">
                    <input class="btn btn-primary" type="submit" name="flag" style="width: 150px; height: 30px" value="   承諾   " >
                    <input type="hidden" name="reservation_id" value="<?php echo $reserved['reservation_id']; ?>">
                    <br>
                    <a href="sns_reservation.php?reservation_id=<?php echo $reserved['reservation_id']; ?>&user_id=<?php echo $user['user_id']; ?>" class="btn btn-primary" style="width: 150px; height: 30px" >日時変更・やり取り</a>
                    <br>
                    <a href="delete.php?reservation_id=<?php echo $reserved['reservation_id']; ?>" class="btn btn-primary" style="width: 150px; height: 30px" > キャンセル </a>
                    <br>
                  </form> 
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/jquery-migrate.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</body>
</html>
