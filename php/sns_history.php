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


  // 自分がsenderの時のデータ
  $sql = 'SELECT * FROM `messages` WHERE `sender_id` = ?';
  $data = array($login_user['user_id']);
  $sender_stmt = $dbh->prepare($sql);
  $sender_stmt->execute($data);

  // 自分がreceiverの時のデータ
  $sql = 'SELECT * FROM `messages` WHERE `receiver_id` = ?';
  $data = array($login_user['user_id']);
  $receiver_stmt = $dbh->prepare($sql);
  $receiver_stmt->execute($data);


 ?>

 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../assets/css/notice.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/mypage.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
  <link href="../assets/css/search_5star.css" rel="stylesheet">
  <title>あなたのやりとり履歴</title>

  <!-- header.php -->
  <?php
    require('mypage_header.php');
  ?>
  <br>
  <br>
  <br>
  <br>
</head>
<body>                              
<!-- サイドバー -->
<?php
require('mypage_sidebar.php');
?>
<!-- サイドバー end -->
<div class="container">
  <div class="row">
    <div class="col-md-8 col-lg-offset-3 cnetered well" style="padding-left: 30px;">
      <div class="page-header">
        <h1>やりとりしたことがある犬の飼い主一覧</h1>
      </div> 
      <div class="comments-list">
        <?php while ($sender = $sender_stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <div class="media">
            <?php $sql = 'SELECT * FROM `users` WHERE `user_id` = ?';
                  $data = array($sender['receiver_id']);
                  $stmt2 = $dbh->prepare($sql);
                  $stmt2->execute($data);
                  $senders = $stmt2->fetch(PDO::FETCH_ASSOC);?>
            <a class="media-left" href="#">
              <img src="../img/users_picture/<?php echo $senders['picture_path']; ?>" style="width: 200px; height: 200px">
            </a>
            <div class="media-body">
              <h4 class="media-heading user_name"><?php echo $senders['last_name']; ?><?php echo $senders['first_name']; ?></h4>
            <br>
            </div>
            <div class="separator clear-left">
              <p class="hoge2" style="margin-left: 385px;">
               <a class="btn btn-primary" href="sns.php?user_id=<?php echo $senders['user_id']; ?>">コンタクトを取る</a>
              </p>
             </div>
          </div> 
        <?php endwhile; ?>
        <br>
        <br>
        <br>
        <h1>やりとりを受けたことがある人一覧</h1>
        <br>
      </div> 

      <div class="comments-list">
        <?php while ($receiver = $receiver_stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <div class="media">
              <?php $sql = 'SELECT * FROM `users` WHERE `user_id`=?';
                    $data = array($receiver['sender_id']);
                    $re_stmt2 = $dbh->prepare($sql);
                    $re_stmt2->execute($data);
                    $receivers = $re_stmt2->fetch(PDO::FETCH_ASSOC); ?>
            <a class="media-left" href="#">
              <img src="../img/users_picture/<?php echo $receivers['picture_path']; ?>" style="width: 200px; height: 200px">
            </a>
            <div class="media-body">
              <h4 class="media-heading user_name"><?php echo $receivers['last_name']; ?> <?php echo $receivers['first_name']; ?></h4>
              <br>
            </div>
            <div class="separator clear-left">
              <p class="hoge3" style="margin-left: 385px;">
               <a class="btn btn-primary" href="sns.php?user_id=<?php echo $receivers['user_id']; ?>">コンタクトを取る</a>
              </p>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/jquery-3.1.1.js"></script>
<script src="../assets/js/jquery-migrate-1.4.1.js"></script>
<script src="../assets/js/jquery-migrate.js"></script>
</body>
</html>