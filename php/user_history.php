<?php
  session_start();
  require('dbconnect.php');
  $_SESSION['user_id'] = 2;

  $sql = 'SELECT * FROM `reservations` WHERE `flag`=1 AND `host_id` = ?';
  $data = array($_SESSION['user_id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

$_SESSION['user_id'] = 1;

$sql = 'SELECT * FROM `reservations` WHERE `client_id` = ? AND `flag`= 1';
$data = array($_SESSION['user_id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

$sql = 'SELECT * FROM `reservations` LEFT JOIN `reviews` ON reservations.reservation_id=reviews.reservation_id WHERE reservations.host_id = ? ';
$data = array($_SESSION['user_id']);
$re_stmt = $dbh->prepare($sql);
$re_stmt->execute($data);

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

    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/user_history.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/mypage.css">
  <title>あなたの利用履歴</title>

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
<!-- サイドバー -->
<?php
   require('mypage_sidebar.php');
?>
<!-- サイドバー end -->
<div class="container">
  <div class="row">
    <div class="col-md-8 col-lg-offset-3 cnetered well" style="padding-left: 30px;">
      <div class="page-header">
        <h1>体験した人一覧</h1>
      </div> 
      <div class="comments-list">
        <?php while ($client = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <?php if($client['flag'] == 1): ?>
          <div class="media">
            <?php $sql = 'SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id=dogs.user_id WHERE users.user_id = ?';
                  $data = array($client['host_id']);
                  $stmt2 = $dbh->prepare($sql);
                  $stmt2->execute($data);
                  $clients = $stmt2->fetch(PDO::FETCH_ASSOC);?>
            <a class="media-left" href="#">
              <img src="../img/user_picture/<?php echo $clients['picture_path']; ?>" style="width: 200px; height: 200px">
            </a>
            <div class="media-body">
              <h4 class="media-heading user_name"><?php echo $clients['last_name']; ?><?php echo $clients['first_name']; ?></h4>
              <?php echo $clients['name'] ?>
              <br>
              <form method="POST" action="" class="col-sm-10 col-lg-offset-2">
                <div class="price col-md-4">
                  <select id="selectbasic" name="score" class="form-control">
                    <option value="5">とても良かった</option>
                    <option value="4">良かった</option>
                    <option value="3">どちらとも言えない</option>
                    <option value="2">良くなかった</option>
                    <option value="1">とても良くなかった</option>
                  </select>
                  <textarea name="comment" style="width: 200px; height: 100px" placeholder="評価記入欄"></textarea>
                  <input type="hidden" name="reservation_id" value="<?php echo $client['reservation_id']; ?>">
                </div>
                <div class="separator clear-left">
                  <p class="hoge2" style="margin-left: 20px;">
                   <a href="result_search.php?user_id=<?php echo $clients['user_id']; ?>" class="btn btn-primary" class="col-sm-4">詳細へ！</a>
                   <input type="submit" value="評価する" name="review" id="hoge1" class="btn btn-primary">
                  </p>
                </div>
              </form>
            </div>
<<<<<<< HEAD
          </div> 
          <?php endif; ?>
        <?php endwhile; ?>
        <br>
        <br>
        <br>
        <h1>預けた人一覧</h1>
        <br>
      </div> 
      <div class="comments-list">
        <?php while ($host = $re_stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <?php if($client['flag'] == 1): ?> 
          <div class="media">
            <a class="media-left" href="#">
              <?php $sql = 'SELECT * FROM `users` WHERE `user_id`=?';
                    $data = array($host['client_id']);
                    $re_stmt2 = $dbh->prepare($sql);
                    $re_stmt2->execute($data);
                    $hosts = $re_stmt2->fetch(PDO::FETCH_ASSOC); ?>
              <img src="../img/user_picture/<?php echo $hosts['picture_path']; ?>" style="width: 200px; height: 200px">
            </a>
            <div class="media-body">
              <h4 class="media-heading user_name"><?php echo $hosts['last_name']; ?> <?php echo $hosts['first_name']; ?></h4>
              <br>
              <?php if($host['score'] == 1): ?>
                <div class="price col-md-4 col-lg-offset-6">
                  <i class="price-text-color fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
              <?php endif; ?>
              <?php if($host['score'] == 2): ?>
                <div class="price col-md-4 col-lg-offset-6">
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
              <?php endif; ?>
              <?php if($host['score'] == 3): ?>
                <div class="price col-md-4 col-lg-offset-6">
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
              <?php endif; ?>
              <?php if($host['score'] == 4): ?>
                <div class="price col-md-4 col-lg-offset-6">
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
              <?php endif; ?>
              <?php if($host['score'] == 5): ?>
                <div class="price col-md-4 col-lg-offset-6">
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                  <i class="price-text-color fa fa-star"></i>
                </div>
              <?php endif; ?>
                </div>
                <div class="separator clear-left">
                  <p class="hoge3" style="margin-left: 385px;">
                   <a href="result_search.php?user_id=<?php echo $clients['user_id']; ?>" class="btn btn-primary" class="col-sm-4 col-lg-offset-6">詳細へ！</a>
                  </p>
                </div>
            </div>
            <?php endif; ?>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</div>
=======
           </div>
          <?php endwhile; ?>
         </div>

    <div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-6 col-lg-offset-2 centered">
                <h3>
                    預けた人一覧</h3>
            </div>    
        </div>
        <div id="carousel-example-generic"  data-ride="carousel">
          <?php while ($host = $re_stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <?php $sql = 'SELECT * FROM `users` WHERE `user_id`=?';
                $data = array($host['client_id']);
                $re_stmt2 = $dbh->prepare($sql);
                $re_stmt2->execute($data);
                $hosts = $re_stmt2->fetch(PDO::FETCH_ASSOC); ?>
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-sm-4 col-lg-offset-3 centered">
                            <div class="col-item">
                                <div class="photo">
                                    <a href="#">
                                      <img src="../img/user_picture/<?php echo $hosts['picture_path']; ?>"  width="350px"  height="260px" class="img-responsive" alt="a" />
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-4">
                                            <h3><?php echo $hosts['last_name']; ?> <?php echo $hosts['first_name']; ?></h3>
                                        </div>
                                        <?php if($host['score'] == 1): ?>
                                          <div class="price col-md-4">
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                          </div>
                                        <?php endif; ?>
                                        <?php if($host['score'] == 2): ?>
                                          <div class="price col-md-4">
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                          </div>
                                        <?php endif; ?>
                                        <?php if($host['score'] == 3): ?>
                                          <div class="price col-md-4">
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                          </div>
                                        <?php endif; ?>
                                        <?php if($host['score'] == 4): ?>
                                          <div class="price col-md-4">
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                          </div>
                                        <?php endif; ?>
                                        <?php if($host['score'] == 5): ?>
                                          <div class="price col-md-4">
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                          </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="hoge2">

                                          <a href="result_search.php?user_id=<?php echo $clients['user_id']; ?>" class="col-sm-4 col-lg-offset-8">詳細へ！</a>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              <?php endwhile; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
>>>>>>> 9d7db9347baf6bd93d9d226c505d7e5b72249e4a

      <script src="../assets/js/bootstrap.js"></script>
      <script src="../assets/js/jquery-3.1.1.js"></script>
      <script src="../assets/js/jquery-migrate-1.4.1.js"></script>
      <script src="../assets/js/jquery-migrate.js"></script>

</body>
</html>