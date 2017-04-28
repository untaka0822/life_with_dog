<?php
session_start();
require('dbconnect.php');

$_SESSION['user_id'] = 4;

$sql = 'SELECT * FROM `reservations` WHERE `client_id` = ?';
$data = array($_SESSION['user_id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

$sql = 'SELECT * FROM `reservations` WHERE `host_id` = ?';
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

  <!-- header.php -->
  <?php
      require('mypage_header.php');
  ?>

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
            <div class="col-md-6 col-lg-offset-2 centered">
                <h3>体験した人一覧</h3>
            </div>    
        </div>
        <div id="carousel-example-generic"  data-ride="carousel">
            <!-- Wrapper for slides -->
          <?php while ($client = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <?php $sql = 'SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id=dogs.user_id WHERE users.user_id = ?';
                $data = array($client['host_id']);
                $stmt2 = $dbh->prepare($sql);
                $stmt2->execute($data);
                $clients = $stmt2->fetch(PDO::FETCH_ASSOC);?>

            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-sm-4 col-lg-offset-3 centered">
                            <div class="col-item">
                                <div class="photo">
                                    <a href="#">
                                      <img src="../img/dog_picture/<?php echo clients['dog_picture_path']; ?>"  width="350px"  height="260px" class="img-responsive" alt="a" />
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-4">
                                            <h3><?php echo $clients['last_name']; ?> <?php echo $clients['first_name']; ?></h3>
                                            <h3 class="price-text-color"><?php echo $clients['name'] ?></h3>
                                        </div>
                                        <form method="POST" action="">
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
                                              <p class="hoge2">
                                                 <a href="result_search.php?user_id=<?php echo $clients['user_id']; ?>" class="col-sm-4 col-lg-offset-8">詳細へ！</a>
                                                 <input type="submit" value="評価する" name="review" id="hoge1"  class="btn btn-primary hoge1">
                                              </p>
                                          </div>
                                        </form>
                                </div>
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
                                        <div class="price col-md-4">
                                          
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="hoge2">
                                          <a href="result_search.php?user_id=<?php echo $clients['user_id']; ?>" class="col-sm-4 col-lg-offset-8">詳細へ！</a>
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
          <?php endwhile; ?>
        </div>
    </div>
    </div>


</body>
</html>