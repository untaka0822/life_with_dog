
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

  } else {
    // ログインしていない場合
    header('Location: login.php');
    exit();
  }

  $sql = 'SELECT * FROM `follows` WHERE `follower_id`=?';
  $data = array($login_user['user_id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  

  $sql = 'SELECT * FROM `follows` WHERE `following_id`=?';
  $data = array($login_user['user_id']);
  $stmt2 = $dbh->prepare($sql);
  $stmt2->execute($data);

  // $sql = 'SELECT * FROM `reviews` WHERE `score`=?';
  // $data = array('score');
  // $stmt3 = $dbh->prepare($sql);
  // $stmt3->execute($data);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/favorite_history.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/mypage.css">

  <title>気になる！一覧</title>

  <!-- mypage_header.php -->
  <?php 
    require('mypage_header.php');
  ?>
  <!-- mypage_header.php end -->

  <br>
  <br>
  <br>
  
</head>
<body>
  <span style="font-family: 'EB Garamond',serif;">
  <!-- mypage_sidebar.php -->
  <?php
   require('mypage_sidebar.php');
  ?>
  <!-- mypage_sidebar.php end -->


<div class="container well">
    <div class="row">
        <div class="row">
            <div class="col-md-6 col-lg-offset-2 centered">
                <h3>あなたのことを気になった方一覧</h3>
            </div>    
        </div>
        <?php while($follower = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <?php 
            $sql = 'SELECT * FROM `users` WHERE `user_id`=?';
            $data = array($follower['following_id']);
            $re_stmt = $dbh->prepare($sql);
            $re_stmt->execute($data);
            $followers = $re_stmt->fetch(PDO::FETCH_ASSOC);
          ?>
        <div id="carousel-example-generic"  data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row well">
                        <div class="col-sm-4 col-lg-offset-3 centered">
                            <div class="col-item">
                                <div class="photo">
                                    <a href="#">
                                      <img src="../img/users_picture/<?php echo $followers['picture_path']; ?>" class="img-responsive">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="row">
                                      <div class="price col-md-6">
                                          <h5 style="font-size: 25px"><?php echo $followers['last_name']; ?> <?php echo $followers['first_name']; ?></h5>
                                      </div>
                                      <div class="rating hidden-sm col-md-6">
                                        <?php while ($review = $stmt3->fetch(PDO::FETCH_ASSOC)): ?>
                                        <?php $reviews[] = $review; ?>
                                        <?php for ($i=0; $i < 5; $i++): ?>
                                        <?php if ($reviews['score'] == 1): ?>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        <?php elseif ($reviews['score'] == 2): ?>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        <?php elseif ($reviews['score'] == 3): ?>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        <?php elseif ($reviews['score'] == 4): ?>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        <?php elseif ($reviews['score'] == 5): ?>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                        <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php endwhile; ?>
                                      </div>
                                     </div>
                                     <div class="separator clear-left">
                                        <p class="hoge2">
                                           <!--  <i class="fa fa-shopping-cart"></i> -->
                                          <input type="" name="">
                                        </p>
                                     </div>
                                   <div class="clearfix">
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <?php endwhile; ?>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="row">
      <div class="col-md-6 col-lg-offset-2 centered">
        <h3>自分が気になった方一覧</h3>
      </div>    
    </div>
    <?php while($following = $stmt2->fetch(PDO::FETCH_ASSOC)): ?>
      <?php 
        $sql = 'SELECT * FROM `users` WHERE `user_id`=?';
        $data = array($following['follower_id']);
        $re_stmt2 = $dbh->prepare($sql);
        $re_stmt2->execute($data);
        $followings = $re_stmt2->fetch(PDO::FETCH_ASSOC);
       ?>
      <div id="carousel-example-generic"  data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <div class="row">
              <div class="col-sm-4 col-lg-offset-3 centered">
                <div class="col-item">
                  <div class="photo">
                    <a href="result_search.php">
                      <img src="../img/users_picture/<?php echo $followings['picture_path']; ?>" width="350px"  height="260px" class="img-responsive">
                    </a>
                  </div>
                  <div class="info">
                    <div class="row">
                      <div class="price col-md-6">
                        <h5 style="font-size: 25px"><?php echo $followings['last_name']; ?> <?php echo $followings['first_name']; ?></h5>
                      </div>
                      <div class="rating hidden-sm col-md-6">
                        <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                        </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                        </i><i class="fa fa-star"></i>
                      </div>
                    </div>
                    <div class="separator clear-left">
                      <p class="hoge2">
                        <!--  <i class="fa fa-shopping-cart"></i> -->
                        <a href="result_search.php?user_id=<?php echo $followings['user_id']; ?>" class="btn btn-primary" class="col-sm-4 col-lg-offset-6">詳細へ！</a>
                      </p>
                    </div>
                    <div class="clearfix">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/jquery-3.1.1.js"></script>
    <script src="../assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="../assets/js/jquery-migrate.js"></script>
  </span>
</body>
</html>