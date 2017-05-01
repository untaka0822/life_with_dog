<?php
// $_SESSIONに保存されたログインユーザーのIDを使ってDBから
// ログインユーザーの情報を取得し、名前と画像を画面に出力する
session_start();
require('dbconnect.php');

//絞込機能($_GETがある場合)
//犬のサイズと地域、両方絞った場合
if  (!empty($_GET['checkboxes']) && !empty($_GET['area_id'])) {
  $sql='SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE (`role`=0 OR `role`=2) AND dogs.size_id=? AND users.area_id=?';
  echo 'hoge1';
  $str=preg_replace('/[^0-9]/', '', $_GET['area_id']);
  $data = array($_GET['checkboxes'], $str);
  $stmt= $dbh->prepare($sql);
  $stmt->execute($data);
 }elseif (!empty($_GET['checkboxes'])) {
  echo 'hoge2';
  //犬のサイズで絞った場合
    $sql='SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE (`role`=0 OR `role`=2) AND dogs.size_id=?';
    $data = array($_GET['checkboxes']);
    $stmt= $dbh->prepare($sql);
    $stmt->execute($data);
  //地域で絞った場合
  }elseif (!empty($_GET['area_id'])) {
    echo 'hoge3';
      $str=preg_replace('/[^0-9]/', '', $_GET['area_id']);
      echo $str;
      $sql = 'SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE (`role`=0 OR `role`=2) AND users.area_id=?';
      $data = array($str);
      $stmt= $dbh->prepare($sql);
      $stmt->execute($data);
  //何も検索しなかった場合
  }else {
      echo'hoge4';
      $sql ='SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE `role`=0 OR `role`=2';
      $stmt= $dbh->prepare($sql);
      $stmt->execute();
    }

$users = array();
// var_dump($users);
while($user=$stmt->fetch(PDO::FETCH_ASSOC)){
        $sql ='SELECT * FROM `dogs_size`  WHERE `size_id`=?';
        $data1 = array($user['size_id']);
        $stmt1= $dbh->prepare($sql);
        $stmt1->execute($data1);
        $dogs_size=$stmt1->fetch(PDO::FETCH_ASSOC);

        // $sql='SELECT * FROM `reservations` LEFT JOIN `reviews`ON reservations.reservation_id=reviews.reservation_id WHERE `host_id`=1';
        // $data2 = array($user['size_id']);
        // $stmt2= $dbh->prepare($sql);
        // $stmt2->execute($data2);
        // while ($reservation=$stmt2->fetch(PDO::FETCH_ASSOC)) {
        // $reservations[]=$reservation;
        
        // }
        // $total_score=0;

        // $score=$reservation['score'];
        // $total_score=$total_score+$score;
        // $head_count= count($reservations);
        // $average=round($total_score/ $head_count);

        // $user=$stmt->fetch(PDO::FETCH_ASSOC);
        // $dogs_size=$stmt1->fetch(PDO::FETCH_ASSOC);

        $users[]=array('user_id'=>$user['user_id'],'name'=> $user['name'], 'dog_id'=>$user['dog_id'],'size_name' => $dogs_size['size_name'], 'area_name' =>$user['area_name'],'dog_picture_path' => $user['dog_picture_path']); //'score'=> $reservation['score']);
}
// echo "<pre>";
// var_dump($users);
// echo "</pre>";

foreach($users as $user){
      $user['name'] . "<br>";
      $user['size_name'] . "<br>";
      $user['area_name'] . "<br>";
      $user['dog_picture_path'] . "<br>";
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
        $c = count($areas)

    
//     // 通常の処理
//     $sql = sprintf('SELECT t.*, m.nick_name, m.picture_path FROM `tweets` AS t LEFT JOIN `members` AS m ON t.member_id=m.member_id ORDER BY t.created DESC LIMIT %d, 5', $start);
// }
// // $sql = 'SELECT t.*, m.nick_name, m.picture_path FROM `tweets` t, `members` m WHERE t.member_id=m.member_id';
// // $data = array($start);
// $stmt = $dbh->prepare($sql);
// $stmt->execute();

// <?PHP

// $dog_size = array();
// foreach($_POST['dog_size'] as $dog_size){ 
// $arr1[] = " category = '$cate' ";
// }
// $arr2 = array();
// foreach($_GET['age'] as $age){ 
// $arr2[] = " age = '$age' ";
// }

// $a = implode(" OR ",$arr1);
// $b = implode(" OR ",$arr2);
// $sql = "select * from member where ($a) AND ($b) order by date desc";

// print $sql;

//犬のサイズ絞込
// $search='';
// if (isset($_GET['checkboxes-0'])){
//   $search= $_GET['checkboxes-0'];
//   $sql = sprintf('SELECT t.*, m.nick_name, m.picture_path FROM `tweets` AS t LEFT JOIN `members` AS m ON t.member_id=m.member_id WHERE t.tweet LIKE "%%%s%%" ORDER BY t.created DESC LIMIT %d, 5', $_GET['search_word'], $start);
// } else {
//   $sql = sprintf('SELECT t.*, m.nick_name, m.picture_path FROM `tweets` AS t LEFT JOIN `members` AS m ON t.member_id=m.member_id ORDER BY t.created DESC LIMIT %d, 5', $start);
// }

          # code...
    


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
  <nav>
    <ul>
      <li class="title">
        <a href="top.html" style="font-size: 45px; font-family: 'Times New Roman',italic;">
          Life <span style="font-size:30px;">with</span> Dog
        </a>
      </li>
      <li class="nav_list">
        <a href="#">
          預けたい人
        </a>
      </li>
      <li class="nav_list">
        <a href="#">
          体験したい人
        </a>
      </li>
      <li class="nav_list">
        <a href="mypage.html">
          マイページ
        </a>
      </li>
      <li class="li-logout">
        <a href="#">
          <div class="hd-logout">
            Logout
          </div>
        </a>
      </li>
    </ul>
  </nav>
</header>
<div class=“clear”></div>
</head>
<body>
     <div class ="filter">
  <!-- 検索結果の項目 -->
    <form method="GET" action="" class="form-horizontal">
    <fieldset>

    <!-- Form Name -->
     <div class="page-header  row">
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
                      <div class="col-sm-4 margin_bottom">
                          <div class="col-item">
                              <a href="functions2.php?dog_id=<?php echo $user['dog_id']; ?>">
                              <div class="photo">
                                  <!-- <img src="http://placehold.it/350x260" class="img-responsive" alt="a" /> -->
                                  <img src="../img/dogs_picture/<?php echo $user['dog_picture_path']; ?>" class="img-responsive" alt="" />
                              </div>
                              </a>
                              <div class="info">
                                  <div class="row">
                                      <a href="functions2.php?dog_id=<?php echo $user['dog_id']; ?>">
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
                                            <?php  if ($average==1): ?>
                                              <i class="price-text-color fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                            <?php endif;  ?>
                                            <?php  if ($average==2): ?>
                                              <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                            <?php endif;  ?> 
                                            <?php  if ($average==3): ?>
                                              <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                            <?php endif;  ?> 
                                            <?php  if ($average==4): ?>
                                              <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            <?php endif;  ?>
                                            <?php  if ($average==5): ?>
                                              <i class="price-text-color fa fa-star"></i>
                                              <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
                                               <i class="price-text-color fa fa-star"></i>
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
                                  <div class="separator clear-left container-center" style="text-align: center">
                                      <button type="submit"  id="hoge1"  class="btn btn-danger btn-xs hoge1">気になる！</button> 
                                  </div>
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
                     

<div class="container" style="text-align: center">
      <ul class="pagination" >
              <li class="disabled"><a href="">«</a></li>
              <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">»</a></li>
       </ul>
</div>

    <script src="../assets/js/jquery-3.1.1.js"></script>
     <script src="../assets/js/jquery-migrate-1.4.1.js"></script>
     <script src="../assets/js/bootstrap.js"></script>
</body>
</html>

