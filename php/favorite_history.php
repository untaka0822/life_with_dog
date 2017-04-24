<?php 
  session_start();
  require('dbconnect.php');

  $sql = 'SELECT * FROM `users`';
  $data = array();
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  $sql = 'SELECT * FROM `dogs`';
  $data = array();
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $dog = $stmt->fetch(PDO::FETCH_ASSOC);
  
?>


<!DOCTYPE html>
<html>

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

  <!-- mypage_sidebar.php -->
  <?php
    require('mypage_sidebar.php');
  ?>
  <!-- mypage_sidebar.php end -->

<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-6 col-lg-offset-2 centered">
                <h3>あなたが気になった人 (犬) 一覧</h3>
            </div>    
        </div>
        <div id="carousel-example-generic"  data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-sm-4 col-lg-offset-3 centered">
                            <div class="col-item">
                                <div class="photo">
                                    <a href="#">
                                      <img src="../assets/images/<?php echo $user['picture_path']; ?>"  width="350px"  height="260px" class="img-responsive">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5 style="font-size: 15px"><?php echo $user['last_name']; ?></h5>
                                            <h5 style="font-size: 15px"><?php echo $user['first_name']; ?></h5>
                                            <h5 style="font-size: 15px" class="price-text-color"><?php echo $dog['name']; ?></h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="hoge2">
                                           <!--  <i class="fa fa-shopping-cart"></i> -->
                                          <input type="submit" value="詳細へ！" id="hoge1"  class="btn btn-primary btn-xs hoge1">
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>
</div>


<div class="container">
  <div class="row">
    <div class="row">
      <div class="col-md-6 col-lg-offset-2 centered">
        <h3>あなたのことを気になった人一覧</h3>
      </div>    
    </div>
    <div id="carousel-example-generic"  data-ride="carousel">
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <div class="row">
            <div class="col-sm-4 col-lg-offset-3 centered">
              <div class="col-item">
                <div class="photo">
                  <a href="#">
                    <img src="../assets/images/<?php echo $user['picture_path']; ?>"  width="350px"  height="260px" class="img-responsive">
                  </a>
                </div>
                <div class="info">
                  <div class="row">
                    <div class="price col-md-6">
                      <h5><?php echo $user['last_name']; ?></h5>
                      <h5><?php echo $user['first_name']; ?></h5>
                      <h5 class="price-text-color"><?php echo $dog['name']; ?></h5>
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
                      <input type="submit" value="詳細へ！" id="hoge1"  class="btn btn-primary btn-xs hoge1">
                    </p>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
