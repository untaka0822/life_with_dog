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

  // 自分がclientの時のデータ
  $sql = 'SELECT * FROM `reservations` WHERE `flag` = 1 AND `client_id` = ?';
  $data = array($login_user['user_id']);
  $client_stmt = $dbh->prepare($sql);
  $client_stmt->execute($data);

  // 自分がhostの時のデータ
  $sql = 'SELECT * FROM `reservations` AS `r1` LEFT JOIN `reviews` AS `r2` ON r1.reservation_id=r2.reservation_id  WHERE `flag` = 1 AND `host_id` = ?';
  $data = array($login_user['user_id']);
  $host_stmt = $dbh->prepare($sql);
  $host_stmt->execute($data);

  // reviewの投稿文
if (!empty($_POST['review'])) {
  $reservation_id = $_POST['reservation_id'];
  $comment = $_POST['comment'];
  $score = $_POST['score'];

  $sql = 'INSERT INTO `reviews` SET `reservation_id` = ?, `comment` = ?, `score` = ?, `created`= NOW()';
  $data = array($reservation_id, $comment, $score);
  $in_stmt = $dbh->prepare($sql);
  $in_stmt->execute($data);                                                      
}

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
  <title>あなたの利用履歴</title>

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
<span style="font-family: 'EB Garamond',serif;">
<!-- サイドバー -->
<?php
require('mypage_sidebar.php');
?>
<!-- サイドバー end -->
<div class="container">
  <div class="row">
    <div class="col-md-8 col-lg-offset-3 cnetered well" style="padding-left: 30px;">
      <div class="page-header">
        <h1>体験したことがある犬の飼い主一覧</h1>
      </div> 
      <div class="comments-list">
        <?php while ($client = $client_stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <div class="media">
            <?php $sql = 'SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id=dogs.user_id WHERE users.user_id = ?';
                  $data = array($client['host_id']);
                  $stmt2 = $dbh->prepare($sql);
                  $stmt2->execute($data);
                  $clients = $stmt2->fetch(PDO::FETCH_ASSOC);?>
            <a class="media-left" href="#">
              <img src="../img/users_picture/<?php echo $clients['picture_path']; ?>" style="width: 200px; height: 200px">
            </a>
            <div class="media-body">
              <h4 class="media-heading user_name"><?php echo $clients['last_name']; ?><?php echo $clients['first_name']; ?></h4>
              <?php echo $clients['name'] ?>
              <br>
              <form method="POST" action="" class="col-sm-10 col-lg-offset-2">
                <div class="price col-md-6">
                  <select id="selectbasic" name="score" class="form-control">
                    <option value="5">とても良かった</option>
                    <option value="4">良かった</option>
                    <option value="3">どちらとも言えない</option>
                    <option value="2">良くなかった</option>
                    <option value="1">とても良くなかった</option>
                  </select>
                  <textarea name="comment" style="width: 300px; height: 100px" placeholder="評価記入欄"></textarea>
                  <input type="hidden" name="reservation_id" value="<?php echo $client['reservation_id']; ?>">
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="separator clear-left">
                  <p class="hoge2" style="margin-left: 20px;">
                   <a href="result_search.php?user_id=<?php echo $clients['user_id']; ?>" class="btn btn-primary" class="col-sm-4">詳細へ！</a>
                   <input type="submit" value="評価する" name="review" id="hoge1" class="btn btn-primary">
                  </p>
                </div>
              </form>
            </div>
          </div> 
        <?php endwhile; ?>
        <br>
        <br>
        <br>
        <h1>自分の犬を預けたことがある人一覧</h1>
        <br>
      </div> 

      <div class="comments-list">
        <?php while ($host = $host_stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <div class="media">
            <a class="media-left" href="#">
              <?php $sql = 'SELECT * FROM `users` WHERE `user_id`=?';
                    $data = array($host['client_id']);
                    $re_stmt2 = $dbh->prepare($sql);
                    $re_stmt2->execute($data);
                    $hosts = $re_stmt2->fetch(PDO::FETCH_ASSOC); ?>
              <img src="../img/users_picture/<?php echo $hosts['picture_path']; ?>" style="width: 200px; height: 200px">
            </a>
            <div class="media-body">
              <h4 class="media-heading user_name"><?php echo $hosts['last_name']; ?> <?php echo $hosts['first_name']; ?></h4>
              <br>
              <?php if($host['score'] == 1): ?>
                <div class="price col-md-4 col-lg-offset-1">
                  <i class="price-text-color fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
              <?php endif; ?>
              <?php if($host['score'] == 2): ?>
                <div class="price col-md-4 col-lg-offset-1">
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
              <?php endif; ?>
              <?php if($host['score'] == 3): ?>
                <div class="price col-md-4 col-lg-offset-1">
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
              <?php endif; ?>
              <?php if($host['score'] == 4): ?>
                <div class="price col-md-4 col-lg-offset-1">
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
              <?php endif; ?>
              <?php if($host['score'] == 5): ?>
                <div class="price col-md-4 col-lg-offset-1">
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                </div>
              <?php endif; ?>
              <div>
                <br>
                <br>
                <h4 class="media-heading user_name" class="col-md-4 col-lg-offset-2"><?php echo $host['comment']; ?></h4>
              </div>
            </div>
            <div class="separator clear-left">
              <p class="hoge3" style="margin-left: 385px;">
               <a href="result_search.php?user_id=<?php echo $clients['user_id']; ?>" class="btn btn-primary" class="col-sm-4 col-lg-offset-6">詳細へ！</a>
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
</span>
</body>
</html>