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


//地域で絞った場合
    if (!empty($_GET['area_id'])) {
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
      $sql = sprintf('SELECT COUNT(*) AS `cnt` FROM `users` WHERE  (`role`=0 OR `role`=1) AND area_id=%d ', $str);
      // $data = array($str);
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      $max_page = ceil($record['cnt'] / 9); // 小数点以下切り上げ
      $max_page = max($max_page, 1);
      $page = min($page, $max_page);
      $page = ceil($page);
      $start = ($page - 1) * 9;
        $str=preg_replace('/[^0-9]/', '', $_GET['area_id']);
        echo $str;
        $sql = sprintf('SELECT * FROM `users` LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE  (`role`=0 OR `role`=1)  AND users.area_id=%d ORDER BY users.user_id DESC LIMIT %d, 9', $str, $start);
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
      $sql = 'SELECT COUNT(*) AS `cnt` FROM `users` WHERE  `role`=0 OR `role`=1';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      $max_page = ceil($record['cnt'] / 9); // 小数点以下切り上げ
      $max_page = max($max_page, 1);
      $page = min($page, $max_page);
      $page = ceil($page);
      $start = ($page - 1) * 9;
          $sql = sprintf('SELECT * FROM `users` LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE  (`role`=0 OR `role`=1)  ORDER BY users.user_id DESC LIMIT %d, 9', $start);
          // $data = array(intval($start));
          // var_dump($data);
          $stmt= $dbh->prepare($sql);
          $stmt->execute($data);
    }


$users = array();
// var_dump($users);
while($user=$stmt->fetch(PDO::FETCH_ASSOC)){
        // $sql ='SELECT * FROM `dogs_size`  WHERE `size_id`=?';
        // $data1 = array($user['size_id']);
        // $stmt1= $dbh->prepare($sql);
        // $stmt1->execute($data1);
        // $dogs_size=$stmt1->fetch(PDO::FETCH_ASSOC);

        $users[]=array('user_id'=>$user['user_id'],'last_name'=> $user['last_name'], 'first_name'=>$user['first_name'], 'area_name' =>$user['area_name'],'picture_path' => $user['picture_path']); //'score'=> $reservation['score']);
}

foreach($users as $user){
      $user['last_name'] ."<br>";
      $user['first_name'] . "<br>";
      $user['area_name'] . "<br>";
      $user['picture_path'] . "<br>";
      // echo $user['score']."<br>";
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
        $data3 = array($_SESSION['login_user_id'], $_POST['follow_user_id']);
        $follow_stmt = $dbh->prepare($sql);
        $follow_stmt->execute($data3);
        echo 'いいね！されたときの処理';
        header('Location: search.php');
        exit();
    } else {
        // いいね！取り消しされたときの処理
        $sql = 'DELETE FROM `follows` WHERE `following_id`=? AND `follower_id`=?';
        $data3 = array($_SESSION['login_user_id'], $_POST['follow_user_id']);
        $follow_stmt = $dbh->prepare($sql);
        $follow_stmt->execute($data3);
        echo 'いいね！取り消しされたときの処理';
        header('Location: search.php');
        exit();
    }
}


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
  <header>
    <?php 
      require('mypage_header.php');
    ?>
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
     <h2 class="col-md-offset-1 col-md-6">預けたい人</h2>
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
     <!-- <div class="container">
        <div class="row">
           <div class="col-md-4 col-md-offset-4">
            <div class="form-group">
              <!-- Multiple Checkboxes -->
                
                <!-- </div>
              </div>
            </div>
        </div>
    </div> --> 

    <!-- Button -->
    <div class="container">
        <div class="row">
           <div class="col-md-4 col-md-offset-4">
              <div class="form-group">
                <label class="col-md-5 control-label" for="singlebutton"></label>
                <button type="submit" class="btn btn-primary" id="singlebutton">検索</button>
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
                    預けられる人   一覧</h3>
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
                        $data = array($_SESSION['login_user_id'], $user['user_id']);
                        $is_follow_stmt = $dbh->prepare($sql);
                        $is_follow_stmt->execute($data);
                    ?>
                      <div class="col-sm-4 margin_bottom">
                          <div class="col-item">
                              <a href="detail_user.php?user_id=<?php echo $user['user_id']; ?>">
                              <div class="photo">
                                  <!-- <img src="http://placehold.it/350x260" class="img-responsive" alt="a" /> -->
                                  <img src="../img/users_picture/<?php echo $user['picture_path']; ?>" class="img-responsive" alt="" />
                              </div>
                              </a>
                              <div class="info">
                                  <div class="row">
                                      <a href="detail_user.php?user_id=<?php echo $user['user_id']; ?>">
                                      <div class="price col-md-6">
                                          <h5>
                                              <?php echo $user['last_name']. "<br>" . $user['first_name']. "<br>"; ?>
                                          </h5>
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

                                  <!-- いいねボタン機能 -->
                                   <form method="POST" action="">
                                    <div class="separator clear-left container-center" style="text-align: center">
                                      <?php if($is_follow = $is_follow_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                        <!-- いいね！データが存在する（削除ボタン表示） -->
                                        <input type="hidden" name="follow" value="unfollow">
                                        <input type="hidden" name="follow_user_id" value=" <?php echo $user['user_id']; ?>">
                                        <input type="submit"  value="気になる！取り消し"  class="btn btn-primary btn-xs">
                                        <!-- input type="submit" value="気になる！取り消し" class="btn btn-danger btn-xs"> -->
                                        <?php else: ?>
                                        <!-- いいね！データが存在しない（いいねボタン表示） -->
                                        <input type="hidden" name="follow" value="follow">
                                        <input type="hidden" name="follow_user_id" value=" <?php echo $user['user_id']; ?>">
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
                <li><a href="search.php?page=<?php echo $page - 1; ?>" class="btn btn-default">前</a></li>
            <?php else: ?>
              <li>
                前
              </li>
            <?php endif; ?>

            &nbsp;&nbsp;|&nbsp;&nbsp;
            <?php if($page < $max_page): ?>
                <li><a href="search.php?page=<?php echo $page + 1; ?>" class="btn btn-default">次</a></li>
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

