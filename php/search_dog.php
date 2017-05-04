<?php
// $_SESSIONに保存されたログインユーザーのIDを使ってDBから
// ログインユーザーの情報を取得し、名前と画像を画面に出力する
session_start();
require('dbconnect.php');
// デバッグ用
// ログイン判定プログラム
// ①$_SESSION['login_member_id']が存在している
// ②最後のアクション（ページの読み込み）から1時間以内である
// セッションに保存した時間に１時間足した時間が今の時間より大きいと、１時間以上経過としてログインページへとばす
if (isset($_SESSION['login_user_id']) && $_SESSION['time'] + 3600 > time()) {
    $_SESSION['time'] = time();
    // ログインしている
    $sql  = 'SELECT * FROM `users` WHERE `user_id`=?';
    $data = array($_SESSION['login_user_id']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $login_user = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // ログインしていない
    header('Location: login.php');
    exit();
}
// ページング機能
$page = '';
// パラメータのページ番号を取得
if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
}
// パラメータが存在しない場合はページ番号を1とする
if ($page == '') {
    $page = 1;
}
// 1以下のイレギュラーな数値が入ってきた場合はページ番号を1とする
$page = max($page, 1);
// echo max(1,10,-100,600,600.001) . '<br>';
// データの件数から最大ページ数を計算する
$sql = 'SELECT COUNT(*) AS `cnt` FROM `dogs`';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$record = $stmt->fetch(PDO::FETCH_ASSOC);
$max_page = ceil($record['cnt'] / 9); // 小数点以下切り上げ
// パラメータのページ番号が最大ペーz  ジ数を超えていれば、最後のページ数とする
$page = min($page, $max_page);
// 1ページに表示する件数分だけデータを取得する
$page = ceil($page);

$start = ($page - 1) * 9;
//絞込機能($_GETがある場合)
//犬のサイズと地域、両方絞った場合
if  (!empty($_GET['checkboxes']) && !empty($_GET['area_id'])) {
      $page = '';
      if (isset($_REQUEST['page'])) {
          $page = $_REQUEST['page'];
      }
      if ($page == '') {
          $page = 1;
      }
      $page = max($page, 1);
      $str=preg_replace('/[^0-9]/', '', $_GET['area_id']);
      $sql = sprintf('SELECT COUNT(*) AS `cnt` FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE (`role`=0 OR `role`=2) AND dogs.size_id=%d AND users.area_id=%d ', $_GET['checkboxes'], $str);
      // $data = array($str);
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      $max_page = ceil($record['cnt'] / 9); // 小数点以下切り上げ
      $page = min($page, $max_page);
      $page = ceil($page);
      echo '現在のページ数 : ' . $page;
      $start = ($page - 1) * 9;
          $sql=sprintf('SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE (`role`=0 OR `role`=2) AND dogs.size_id=%d AND users.area_id=%d ORDER BY dogs.dog_id DESC LIMIT %d, 9', $_GET['checkboxes'],$str,$start);
          echo 'hoge1';
          $str=preg_replace('/[^0-9]/', '', $_GET['area_id']);
          // $data = array($_GET['checkboxes'], $str);
          $stmt= $dbh->prepare($sql);
          $stmt->execute($data);
         }elseif (!empty($_GET['checkboxes'])) {
    echo 'hoge2';
    //犬のサイズで絞った場合
    $page = '';
      if (isset($_REQUEST['page'])) {
          $page = $_REQUEST['page'];
      }
      if ($page == '') {
          $page = 1;
      }
      $page = max($page, 1);
      $str=preg_replace('/[^0-9]/', '', $_GET['area_id']);
      $sql = sprintf('SELECT COUNT(*) AS `cnt` FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE (`role`=0 OR `role`=2) AND dogs.size_id=%d ', $_GET['checkboxes']);
      // $data = array($str);
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      $max_page = ceil($record['cnt'] / 9); // 小数点以下切り上げ
      $page = min($page, $max_page);
      $page = ceil($page);
      echo '現在のページ数 : ' . $page;
      $start = ($page - 1) * 9;
          $sql=sprintf('SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE (`role`=0 OR `role`=2) AND dogs.size_id=%d ORDER BY dogs.dog_id DESC LIMIT %d, 9', $_GET['checkboxes'], $start);
          // $data = array($_GET['checkboxes']);
          $stmt= $dbh->prepare($sql);
          $stmt->execute($data);
    //地域で絞った場合
    }elseif (!empty($_GET['area_id'])) {
      echo 'hoge3';
      $page = '';
      if (isset($_REQUEST['page'])) {
          $page = $_REQUEST['page'];
      }
      if ($page == '') {
          $page = 1;
      }
      $page = max($page, 1);
      $str=preg_replace('/[^0-9]/', '', $_GET['area_id']);
      $sql = sprintf('SELECT COUNT(*) AS `cnt` FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE (`role`=0 OR `role`=2) AND users.area_id=%d ', $str);
      // $data = array($str);
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      $max_page = ceil($record['cnt'] / 9); // 小数点以下切り上げ
      $page = min($page, $max_page);
      $page = ceil($page);
      echo '現在のページ数 : ' . $page;

        $str=preg_replace('/[^0-9]/', '', $_GET['area_id']);

        $sql = sprintf('SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE (`role`=0 OR `role`=2) AND users.area_id=%d ORDER BY dogs.dog_id DESC LIMIT %d, 9', $str, $start);
        // $data = array($str);
        $stmt= $dbh->prepare($sql);
        $stmt->execute($data);
    //何も検索しなかった場合
    }else {
      $page = '';
      if (isset($_REQUEST['page'])) {
          $page = $_REQUEST['page'];
      }
      if ($page == '') {
          $page = 1;
      }
      $page = max($page, 1);
      $sql = 'SELECT COUNT(*) AS `cnt` FROM `dogs`';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      $max_page = ceil($record['cnt'] / 9); // 小数点以下切り上げ
      $page = min($page, $max_page);
      $page = ceil($page);
      $start = ($page - 1) * 9;
      $sql = sprintf('SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE `role`=0 OR `role`=2 ORDER BY dogs.dog_id DESC LIMIT %d, 9', $start);
      // $data = array(intval($start));
      // var_dump($data);
      $stmt= $dbh->prepare($sql);
      $stmt->execute($data);
    }
$users = array();
// var_dump($users);
while($user=$stmt->fetch(PDO::FETCH_ASSOC)){
        $sql ='SELECT * FROM `dogs_size`  WHERE `size_id`=?';
        $data1 = array($user['size_id']);
        $stmt1= $dbh->prepare($sql);
        $stmt1->execute($data1);
        $dogs_size=$stmt1->fetch(PDO::FETCH_ASSOC);
        $users[]=array('user_id'=>$user['user_id'],'name'=> $user['name'], 'dog_id'=>$user['dog_id'],'size_name' => $dogs_size['size_name'], 'area_name' =>$user['area_name'],'dog_picture_path' => $user['dog_picture_path']); //'score'=> $reservation['score']);
}


  //スコアの表示 
    $sql='SELECT * FROM `reservations` LEFT JOIN `reviews`ON reservations.reservation_id=reviews.reservation_id WHERE `host_id`=1';
    $data = array();
    $stmt= $dbh->prepare($sql);
    $stmt->execute($data);
    $reservations = array();
    while($reservation=$stmt->fetch(PDO::FETCH_ASSOC)){
      $reservations[]=$reservation;
    }
    //  echo '<pre>';
    // var_dump($reservations);
    // echo '</ pre>';
     $total_score=0;
     foreach ($reservations as $reservation) {
     $score=$reservation['score'];
     $total_score=$total_score+$score; 
    }
    $head_count= count($reservations);
    $average=round($total_score/ $head_count);
   $average;
//エリアの表記
$sql = 'SELECT * FROM `areas`';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(); 
        $areas = array();
        while ($area = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $areas[] = array('area_id' => $area['area_id'], 'area_name' => $area['area_name']);
        }
        $c = count($areas);
        
// いいね！機能のロジック実装
if (!empty($_POST)) {
    if ($_POST['follow'] == 'follow') {
        // いいね！されたときの処理
        $sql = 'INSERT INTO `follows` SET `following_id`=?, `follower_id`=?, `created`=NOW()';
        $data3 = array($_SESSION['login_user_id'], $_POST['follow_dog_id']);
        $follow_stmt = $dbh->prepare($sql);
        $follow_stmt->execute($data3);
        echo 'いいね！されたときの処理';
        header('Location: search_dog.php');
        exit();
    } else {
        // いいね！取り消しされたときの処理
        $sql = 'DELETE FROM `follows` WHERE `following_id`=? AND `follower_id`=?';
        $data3 = array($_SESSION['login_user_id'], $_POST['follow_dog_id']);
        $follow_stmt = $dbh->prepare($sql);
        $follow_stmt->execute($data3);
        echo 'いいね！取り消しされたときの処理';
        header('Location: search_dog.php');
        exit();
    }
}
// if (!empty($_POST)) {
//     if ($_POST['like'] == 'like') {
//         // いいね！されたときの処理
//         $sql = 'INSERT INTO `likes` SET `member_id`=?, `tweet_id`=?';
//         $data = array($_SESSION['login_member_id'], $_POST['like_tweet_id']);
//         $like_stmt = $dbh->prepare($sql);
//         $like_stmt->execute($data);
//         header('Location: top.php');
//         exit();
//     } else {
//         // いいね！取り消しされたときの処理
//         $sql = 'DELETE FROM `likes` WHERE `member_id`=? AND `tweet_id`=?';
//         $data = array($_SESSION['login_member_id'], $_POST['like_tweet_id']);
//         $like_stmt = $dbh->prepare($sql);
//         $like_stmt->execute($data);
//         header('Location: top.php');
//         exit();
//     }
// }
?>

 <!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/css/header.css" rel="stylesheet">

    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/form.css" rel="stylesheet">
    <link href="../assets/css/timeline.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="../assets/css/search_5star.css" rel="stylesheet">
  <title></title>
<header class="navbar-fixed-top">
  <!-- <nav>
    <ul>
      <li class="title">
        <a href="top.php" style="font-size: 45px; font-family: 'Times New Roman',italic; position: relative;">
          Life <span style="font-size:30px;">with</span> Dog
        </a>
      </li>
      <li class="nav_list" style="font-family: 'EB Garamond', serif;">
        <a href="search_dog.php">
          体験したい人
        </a>
      </li>
      <li class="nav_list" style="font-family: 'EB Garamond', serif;">
        <a href="search.php">
          預けたい人
        </a>
      </li>
      <li class="nav_list" style="font-family: 'EB Garamond', serif;">
        <a href="index_dog.php">
          愛犬登録
        </a>
      </li>
      <li class="nav_list" style="font-family: 'EB Garamond', serif;">
        <div onclick="obj=document.getElementById('open').style; obj.display=(obj.display=='none')?'block':'none';">
              <a style="cursor:pointer;">マイページ</a>
            </div>

            <div id="open" style="display:none;clear:both; z-index: 1;">

              <div class="navbar navbar-default navbar-static-bottom" style="position: fixed; z-index: 1">
                    <p class="navbar-text pull-left" style=": center;">
                        <a href="mypage.php" target="_blank"> マイページ
                    </p>
                    <p class="navbar-text pull-left" style=": center;">
                        <a href="custom.php" target="_blank"> 自分の情報を編集する
                    </p>
                    <p class="navbar-text pull-left" style=": center;">
                        <a href="user_history.php" target="_blank"> 自分の利用履歴を見る
                    </p>
                    <p class="navbar-text pull-left" style=": center;">
                        <a href="favorite_history.php" target="_blank"> 自分の気になる！履歴を見る
                    </p>
                    <p class="navbar-text pull-left" style=": center;">
                        <a href="notice.php" target="_blank"> リクエスト一覧を見る
                    </p>
              </div>

            </div>
      </li>
      <li class="li-logout" style="font-family: 'EB Garamond', serif;">
        <a href="#">
          <div class="hd-logout">
            <a href="logout.php" style="color: white;">ログアウト</a>
          </div>
        </a>
      </li>
    </ul>
  </nav> -->
</header>
<div class=“clear”></div>
</head>
<body>
  <span style="font-family: 'EB Garamond',serif;">
     <div class ="filter">
  <!-- 検索結果の項目 -->
    <form method="GET" action="" class="form-horizontal">
    <fieldset>

    <!-- Form Name -->
     <div class="page-header  row">
     <br>
      <br>
     <h2 class="col-md-offset-1 col-md-6">体験したい人</h2>
     </div>

    <!-- Select Area -->
    <div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">都道府県</label>
  <div class="col-md-4">
    <select name="area_id" class="form-control" id="pref">
    <option value="" selected>都道府県を選択</option>
    <!-- <input type="text" name="pref01" size="20" class="form-control"> -->
      <?php for ($i=0; $i < $c; $i++): ?>
        <option value="<?php echo $areas[$i]['area_id']; ?>"><?php echo $areas[$i]['area_name']; ?></option>
      <?php endfor; ?>
    </select>
  </div>
</div>
    </div>
     <div class="container">
        <div class="row">
           <div class="col-md-4 col-md-offset-4">
            <div class="form-group">
              <!-- Multiple Checkboxes -->
                <label class="col-md-4" for="checkboxes">犬のサイズ</label>
                <div class="col-md-4">
                <div class="checkbox">
                  <label for="checkboxes-0">
                    <input name="checkboxes" id="checkboxes-0" type="checkbox" value="1">
                    小型犬
                  </label>
                  </div>
                <div class="checkbox">
                  <label for="checkboxes-1">
                    <input name="checkboxes" id="checkboxes-1" type="checkbox" value="2">
                    中型犬
                  </label>
                </div>
                <div class="checkbox">
                  <label for="checkboxes-2">
                    <input name="checkboxes" id="checkboxes-2" type="checkbox" value="3">
                    大型犬
                  </label>
                </div>
                <div class="checkbox">
                  <label for="checkboxes-3">
                    <input name="checkboxes" id="checkboxes-3" type="checkbox" value="4">
                    特大犬
                  </label>
                   </div>
                </div>
              </div>
            </div>
        </div>
    </div>

    <!-- Button -->
    <div class="container">
        <div class="row">
           <div class="col-md-4 col-md-offset-4">
              <div class="form-group">
                <label class="col-md-5 control-label" for="singlebutton"></label>
                <button name="singlebutton" class="btn btn-primary" id="singlebutton">検索</button>
              </div>
            </div>
        </div>
    </div>

    </fieldset>
    </form>
      </div>
      </div>
      </div>
</div>

<div class= "result">
  <!-- 検索結果の表示 -->
      <div class "">
      <!-- 検索結果数の表示 -->
        
      </div>
      <div class = "view">
          <div class =  "oneview">
          <!-- 一つの検索項目 -->
            
          </div>
      </div>
</div>

<div class="container">
  <div class="row">
    <div class="row">
      <div class="col-md-9">
                <h3>
                    体験できる犬   一覧</h3>
      </div>
    </div>
      <div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel">
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
              <div class="">
                  <div class="row">
                  <?php foreach($users as $user):?>
                    <?php
                        // お気に入り！済みかどうかの判定処理
                        $sql = 'SELECT * FROM `follows` WHERE `following_id`=? AND `follower_id`=?';
                        $data = array($_SESSION['login_user_id'], $user['dog_id']);
                        $is_follow_stmt = $dbh->prepare($sql);
                        $is_follow_stmt->execute($data);
                    ?>
                      <div class="col-sm-4 margin_bottom">
                          <div class="col-item">
                              <a href="detail_dog.php?dog_id=<?php echo $user['dog_id']; ?>">
                              <div class="photo">
                                  <!-- <img src="http://placehold.it/350x260" class="img-responsive" alt="a" /> -->
                                  <img src="../img/dogs_picture/<?php echo $user['dog_picture_path']; ?>" class="img-responsive" alt="" />
                              </div>
                              </a>
                              <div class="info">
                                  <div class="row">
                                      <a href="detail_dog.php?dog_id=<?php echo $user['dog_id']; ?>">
                                      <div class="price col-md-6">
                                          <h5>
                                              <?php echo $user['name']. "<br>"; ?>
                                               <?php echo  $user['size_name'] . "<br>";?></h5>
                                          <h5 class="price-text-color">
                                                地域: <?php echo $user['area_name']; ?></h5>
                                      </div>
                                      </a>
                                      <div class="rating hidden-sm col-md-6">
                                       <!-- 星評価の表示 -->
                                       <?php  
                                         $sql='SELECT * FROM `reservations` LEFT JOIN `reviews`ON reservations.reservation_id=reviews.reservation_id WHERE `host_id`=?';
                                          $data = array($user['user_id']);
                                          $stmt= $dbh->prepare($sql);
                                          $stmt->execute($data);
                                          $reservations = array();
                                          while($reservation=$stmt->fetch(PDO::FETCH_ASSOC)){
                                            $reservations[]=$reservation;
                                          }
                                         $total_score=0;
                                         // var_dump($reservations);
                                         ?>
                                         
                                         <?php if(!empty($reservations)): ?>
                                             <?php
                                             foreach ($reservations as $reservation) {
                                             $score=$reservation['score'];
                                             $total_score=$total_score+$score; 
                                            }
                                            $head_count= count($reservations);
                                            $average=round($total_score/ $head_count);
                                            ?>
                                            <?php  if ($average== 1): ?>
                                              <i class="price-text-color fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                            <?php // endif;  ?>
                                            <?php  elseif ($average==2): ?>
                                              <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                            <?php // endif;  ?> 
                                            <?php  elseif ($average==3): ?>
                                              <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                            <?php //endif;  ?> 
                                            <?php  elseif ($average==4): ?>
                                              <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            <?php //endif;  ?>
                                            <?php  elseif ($average==5): ?>
                                              <i class="price-text-color fa fa-star"></i>
                                              <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                               <?php else:  ?>
                                                  <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <?php endif;  ?>

                                        <?php else:  ?>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                        <?php endif;  ?>
                                    </div>
                                  </div>
                                 <!--  <form method="POST" action="">
                                  <div class="separator clear-left container-center" style="text-align: center">
                                    <button type="submit"  id="hoge1"  class="btn btn-danger btn-xs hoge1">気になる！</button> 
                                  </div>
                                  </form> -->
                                   <form method="POST" action="">
                                    <div class="separator clear-left container-center" style="text-align: center">
                                      <?php if($is_follow = $is_follow_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                        <!-- いいね！データが存在する（削除ボタン表示） -->
                                        <input type="hidden" name="follow" value="unfollow">
                                        <input type="hidden" name="follow_dog_id" value=" <?php echo $user['dog_id']; ?>">
                                        <input type="submit"  value="気になる！取り消し"  class="btn btn-primary btn-xs">
                                        <!-- input type="submit" value="気になる！取り消し" class="btn btn-danger btn-xs"> -->
                                        <?php else: ?>
                                        <!-- いいね！データが存在しない（いいねボタン表示） -->
                                        <input type="hidden" name="follow" value="follow">
                                        <input type="hidden" name="follow_dog_id" value=" <?php echo $user['dog_id']; ?>">
                                        <input type="submit"  value="気になる！"   class="btn btn-danger btn-xs">
                                       <!--  <input type="submit" value="気になる！" class="btn btn-primary btn-xs"> -->
                                      <?php endif; ?>
                                       </div>
                                   </form>
                                  <div class="clearfix">
                                  </div>
                               </div>
                           </div>
                      </div>
                    <?php endforeach;?>
                 </div>
             </div>
         </div>
    </div>
                     


<!-- <div class="container" style="text-align: center">
      <ul class="paging" > -->
 <div class="container" style="text-align: center">
      <ul class="paging" >
             <!-- <li class="disabled"></li> -->
              <!-- <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li> -->
              <!-- <li><a href="#">»</a></li> -->
             &nbsp;&nbsp;&nbsp;&nbsp;
              <?php if($page > 1): ?>
                <li><a href="search_dog.php?page=<?php echo $page - 1; ?>" class="btn btn-default">前</a></li>
            <?php else: ?>
              <li>
                前
              </li>
            <?php endif; ?>

            &nbsp;&nbsp;|&nbsp;&nbsp;
            <?php if($page < $max_page): ?>
                <li><a href="search_dog.php?page=<?php echo $page + 1; ?>" class="btn btn-default">次</a></li>
            <?php else: ?>
              <li>
                次
              </li>
            <?php endif; ?>
       </ul>
</div>

    <script src="../assets/js/jquery-3.1.1.js"></script>
    <script src="../assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
  </span>
</body>
</html>
