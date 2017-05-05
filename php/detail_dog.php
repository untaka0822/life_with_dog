<?php

session_start();
require('dbconnect.php');

// if (!isset($_REQUEST['dog_id'])) {
//     header('Location: search_dog.php');
//     exit();
// }

// var_dump($_REQUEST);
// echo '<br>';
// echo $_REQUEST['dog_id'];

// 投稿一件取得
// 選択したリスト一件取得
$sql = 'SELECT *
                FROM `dogs` AS d LEFT JOIN `users` AS u
                ON d.user_id=u.user_id LEFT JOIN `dogs_size` ON d.size_id=dogs_size.size_id
                WHERE `dog_id`=?';
$data = array($_REQUEST['dog_id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);
$dog = $stmt->fetch(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump ($dog);
// echo '</pre>';

// var_dump($dog);
// echo $dog['dog_picture_path'];

$sql ='SELECT * FROM `dogs_size`  WHERE `size_id`=?';
        $data1 = array($dog['size_id']);
        $stmt1= $dbh->prepare($sql);
        $stmt1->execute($data1);
        $dogs_size=$stmt1->fetch(PDO::FETCH_ASSOC);

// $sql ='SELECT * FROM `users`  LEFT JOIN `areas` ON users.area_id=areas.area_id WHERE `area_id`=?';
//         $data2 = array($user['area_id']);
//         $stmt2= $dbh->prepare($sql);
//         $stmt2->execute($data2);
//         $area_=$stmt2->fetch(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($dog);
// echo '</pre>';

$sql='SELECT * FROM `areas`';
        $stmt2= $dbh->prepare($sql);
        $stmt2->execute();

while ($area=$stmt2->fetch(PDO::FETCH_ASSOC)) {
  if ($dog['area_id']==$area['area_id']) {
    // echo $area['area_name'];
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/result_search.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/background.css">
  <title>詳細結果</title>

  <?php
    require('mypage_header.php');
  ?>

</head>
<body>
<!-- <img class="bg" src="../assets/images/grass_wallpaper.JPG"> -->

  <br>
  <br>
  <br>
  <br>
  <br>

  <!-- <div class="container">
   <div class="row">

    <div class=""><h2>ユーザー詳細ページ</h2></div> -->

    <div class="col-md-6 col-lg-offset-3 centered">
    <div class="panel panel-default">
    <div class="panel-heading"><h4>ユーザープロフィール</h4></div>
    <div class="panel-body">
    <div class="box box-info">
    <div class="box-body">
    <div class="col-sm-6 col-lg-offset-4 centered">
        <div>
          <img src="../img/users_picture/<?php echo $dog['picture_path']; ?>" style="width: 130px; height: 130px">
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
          <div class="col-sm-5 col-xs-6 tital">姓</div><div class="col-xs-1" >:</div><div class="col-sm-2 col-xs-6 tital" style="text-align: left;"><?php echo $dog['last_name']; ?></div>
          <div class="clearfix"></div>
          <div class="bot-border"></div>

          <div class="col-sm-5 col-xs-6 tital">名</div><div class="col-xs-1">:</div><div class="col-sm-2 col-xs-6 tital" style="text-align: left;"><?php echo $dog['first_name']; ?></div>
          <div class="clearfix"></div>
          <div class="bot-border"></div>

          <div class="col-sm-5 col-xs-6 tital">性別</div><div class="col-xs-1">:</div>
          <div class="col-sm-2 col-xs-6 tital" style="text-align: left">
          <?php
                $gender= $dog['gender'];
                if ($gender == 1) {
                echo "男性";
                } elseif($gender == 2) {
                echo "女性";
                }else{
                  echo"不明";
                }
          ?>
          </div>

          <div class="clearfix"></div>
          <div class="bot-border"></div>

          <div class="col-sm-5 col-xs-6 tital">都道府県</div><div class="col-xs-1">:</div><div class="col-sm-2 col-xs-6 tital" style="text-align: left;">
            <?php  $sql='SELECT * FROM `areas`';
                        $stmt2= $dbh->prepare($sql);
                        $stmt2->execute();
                        while ($area=$stmt2->fetch(PDO::FETCH_ASSOC)) {
                          if ($dog['area_id']==$area['area_id']) {
                            echo $area['area_name'];
                          }
                        }
                        ?>
          </div>
          <div class="clearfix"></div>
          <div class="bot-border"></div>

          <div class="col-sm-5 col-xs-6 tital">市区町村</div><div class="col-xs-1">:</div><div class="col-sm-2 col-xs-6 tital" style="text-align: left;">
            <?php echo $dog['area_detail']; ?>
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

<!--   <div class="container">
    <div class="row">

      <h2>愛犬詳細ページ</h2> -->

      <br>
      <br>

    <div class="col-md-6 col-lg-offset-3 centered">
    <div class="panel panel-default">
    <div class="panel-heading"><h4>愛犬プロフィール</h4></div>
    <div class="panel-body">
    <div class="box box-info">
    <div class="box-body">
    <div class="col-sm-6 col-lg-offset-4 centered">
    <div>
      <img src="../img/dogs_picture/<?php echo $dog['dog_picture_path']; ?>" style="width: 130px; height: 130px">
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

              <div class="col-sm-5 col-xs-6 tital">愛犬の名前</div><div class="col-xs-1">:</div><div class="col-xs-6 tital" style="text-align: left;"><?php echo $dog['name']; ?></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">生年月日</div><div class="col-xs-1">:</div><div class="col-sm-5 col-xs-8 tital" style="text-align: left;">
              <?php echo $dog['birth']; ?></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">性別</div><div class="col-xs-1">:</div><div class="col-sm-2 col-xs-6 tital" style="text-align: left;">
              <?php
                $dog_gender= $dog['dog_gender'];
                if ($dog_gender == 1) {
                echo "オス";
                } elseif($dog_gender == 2) {
                echo "メス";
                }else{
                  echo"不明";
                }
                ?>
              </div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">サイズ</div><div class="col-xs-1">:</div><div class="col-sm-2 col-xs-6 tital" style="text-align: left;">
              <?php echo $dogs_size['size_name']; ?></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">犬種</div><div class="col-xs-1">:</div><div class="col-sm-2 col-xs-6 tital" style="text-align: left;">
              <?php echo $dog['type']; ?></div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">避妊・去勢をしている</div><div class="col-xs-1">:</div><div class="col-sm-2 col-xs-6 tital" style="text-align: left;">
               <?php
                $spay_cast= $dog['spay_cast'];
                if ($spay_cast == 1) {
                echo "はい";
                } elseif($spay_cast == 2) {
                echo "いいえ";
                }else{
                  echo"不明";
                }
                ?>
              </div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">混合ワクチンをしている</div><div class="col-xs-1">:</div><div class="col-sm-2 col-xs-6 tital" style="text-align: left;">
              <?php
                $vaccin = $dog['vaccin'];
                if ($vaccin == 1) {
                echo "はい";
                } elseif($vaccin == 2) {
                echo "いいえ";
                }else{
                  echo"不明";
                }?>
                </div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">ノミ・ダニ予防をしている</div><div class="col-xs-1">:</div><div class="col-sm-2 col-xs-6 tital" style="text-align: left;">
                <?php
                $fleas= $dog['fleas'];
                if ($fleas == 1) {
                echo "はい";
                } elseif ($fleas == 2) {
                echo "いいえ";
                }else{
                  echo"不明";
                }?>
              </div>
              <div class="clearfix"></div>
              <div class="bot-border"></div>

              <div class="col-sm-5 col-xs-6 tital">性格・特徴について</div><div class="col-xs-1">:</div><div class="col-xs-6 tital" style="text-align: left;"><?php echo $dog['character']; ?></div>

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

    <div class="col-sm-6 col-lg-offset-5 centered">
      <a class="btn btn-primary" href="search_dog.php">戻る</a>
       <a class="btn btn-primary" href="sns_reservation.php?user_id=<?php echo $dog['user_id']; ?>">コンタクトを取る</a>
    </div>

    <br>
    <br>

    <!-- <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/jquery-migrate.js"></script>
    <script src="../assets/js/jquery.js"></script> -->
  </body>
</html>