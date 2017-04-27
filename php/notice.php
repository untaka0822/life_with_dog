<?php 
  session_start();
  require('dbconnect.php');
  
  $sql = 'SELECT * FROM `users`';
  $data = array();
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  $sql = 'SELECT * FROM `reservations`';
  $data = array();
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $reserve = $stmt->fetch(PDO::FETCH_ASSOC);

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

<body>

<!-- mypage_sidebar.php -->
  <?php
  require('mypage_sidebar.php');
  ?>
<!-- mypage_sidebar.php end -->

  <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-offset-3 cnetered well">
                  <div class="page-header">
                    <h1><small class="pull-right">リクエスト数</small> リクエスト一覧</h1>
                  </div> 
                   <div class="comments-list">
                       <div class="media">
                            <a class="media-left" href="#">
                              <img src="../assets/images/<?php echo $user['picture_path']; ?>" style="width: 40px; height: 40px">
                            </a>
                            <div class="media-body">
                              <h4 class="media-heading user_name"><?php echo $user['last_name']; ?> <?php echo $user['first_name']; ?></h4>
                              <p><small><a href="result_search.php">ユーザーの詳細へ</a></small></p>
                              <div>
                              <p class="col-md-6 col-lg-offset-4 centered">希望日時</p><br><br>
                              <p class="col-md-6 col-lg-offset-4 centered"><?php echo $reserve['date_start']; ?> 〜 <?php echo $reserve['date_end']; ?></p>
                              <p class="col-md-6 col-lg-offset-4 centered">申込日</p><br><br>
                              <p class="col-md-6 col-lg-offset-4 centered"><?php echo $reserve['created']; ?></p>
                                <input class="col-sm-4 col-lg-offset-8" type="submit" value="完了">
                                <input class="col-sm-4 col-lg-offset-8" type="submit" value="日時変更・やり取り">
                                <input class="col-sm-4 col-lg-offset-8" type="submit" value="キャンセル">
                              </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
  </div>

        <script src="../assets/js/jquery.js"></script>
        <script src="../assets/js/jquery-migrate.js"></script>
        <script src="../assets/js/bootstrap.js"></script>

</body>
</html>

