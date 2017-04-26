<?php
// $_SESSIONに保存されたログインユーザーのIDを使ってDBから
// ログインユーザーの情報を取得し、名前と画像を画面に出力する
session_start();
require('dbconnect.php');

//usersのテーブルから犬を預けたい人を選択し、犬の情報を提示
// $sql ='SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE `role`=0 OR `role`=2';
// $stmt= $dbh->prepare($sql);
// $stmt->execute();

// $users = array();
// while($user=$stmt->fetch(PDO::FETCH_ASSOC)){
//   $users[]=$user;
// }
// // echo '<pre>';
// // var_dump($users);
// // echo '</ pre>';

// //  foreach($users as $user){
// //   echo $user['name']."<br>";
// //   echo $user['area_name']."<br>";
// //     $sql ='SELECT * FROM `dogs_size`  WHERE `size_id`=?';
// //     $data = array($user['size_id']);
// //     $stmt= $dbh->prepare($sql);
// //     $stmt->execute($data);
// //     $dogs_size=$stmt->fetch(PDO::FETCH_ASSOC);
// //   echo $dogs_size['size_name']."<br>";
// // }
// echo "<pre>";
// var_dump($users);
// echo "</pre>";
// $c = count($users);


// for ($i=0; $i < $c; $i++) { 
// echo '----------------' . "<br>";

// echo $users[$i]['last_name'] . "<br>";
// echo $user[$i]['area_detail'] . "<br>";

// // $sql ='SELECT * FROM `dogs_size`  WHERE `size_id`=?';
// // $data = array($user[$i]['size_id']);
// // $stmt= $dbh->prepare($sql);
// // $stmt->execute($data);
// // $dogs_size=$stmt->fetch(PDO::FETCH_ASSOC);
// // var_dump($dogs_size);
// // echo $dogs_size['size_name']."<br>";
// // echo $dogs_size['size_id'] . "<br>";

// }

// $sql ='SELECT * FROM `dogs_size`  WHERE `size_id`=?';
// $data1 = array($user['size_id']);
// $stmt1= $dbh->prepare($sql);
// $stmt1->execute($data1);
// $dogs_size=$stmt1->fetch(PDO::FETCH_ASSOC);
// var_dump($dogs_size);
// echo $dogs_size['size_name']."<br>";
// echo $dogs_size['size_id'] . "<br>";


// echo '----------------' . "<br>";
// var_dump($dogs_size);


$sql ='SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id = dogs.user_id LEFT JOIN `areas` ON users.area_id = areas.area_id  WHERE `role`=0 OR `role`=2';
$stmt= $dbh->prepare($sql);
$stmt->execute();

$users = array();
var_dump($users);
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

        $users[]=array('user_id'=>$user['user_id'],'name'=> $user['name'], 'size_name' => $dogs_size['size_name'], 'area_name' =>$user['area_name'],'dog_picture_path' => $user['dog_picture_path']); //'score'=> $reservation['score']);
}
echo "<pre>";
var_dump($users);
echo "</pre>";

foreach($users as $user){
      echo $user['name'] . "<br>";
      echo $user['size_name'] . "<br>";
      echo $user['area_name'] . "<br>";
      echo $user['dog_picture_path'] . "<br>";
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
    echo $average;

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
    <form class="form-horizontal">
    <fieldset>

    <!-- Form Name -->
     <div class="page-header  row">
     <h2 class="col-md-offset-1 col-md-6">体験したい人</h2>
     </div>

    <!-- Select Area -->
    <div class="container">
        <div class="row">
           <div class="col-md-4 col-md-offset-4">
             <div class="form-group">
                <label class="control-label" for="selectbasic">地域</label>
                   <select name="selectbasic" class="form-control" id="selectbasic">
                     <option value="" selected>都道府県を選択</option>
                      <option value="6">山形県</option>
                      <option value="7">福島県</option>
                      <option value="8">茨城県</option>
                      <option value="9">栃木県</option>
                      <option value="10">群馬県</option>
                      <option value="11">埼玉県</option>
                      <option value="12">千葉県</option>
                      <option value="13">東京都</option>
                      <option value="14">神奈川県</option>
                      <option value="15">新潟県</option>
                      <option value="16">富山県</option>
                      <option value="17">石川県</option>
                      <option value="18">福井県</option>
                      <option value="19">山梨県</option>
                      <option value="20">長野県</option>
                      <option value="21">岐阜県</option>
                      <option value="22">静岡県</option>
                      <option value="23">愛知県</option>
                      <option value="24">三重県</option>
                      <option value="25">滋賀県</option>
                      <option value="26">京都府</option>
                      <option value="27">大阪府</option>
                      <option value="28">兵庫県</option>
                      <option value="29">奈良県</option>
                      <option value="30">和歌山県</option>
                      <option value="31">鳥取県</option>
                      <option value="32">島根県</option>
                      <option value="33">岡山県</option>
                      <option value="34">広島県</option>
                      <option value="35">山口県</option>
                      <option value="36">徳島県</option>
                      <option value="37">香川県</option>
                      <option value="38">愛媛県</option>
                      <option value="39">高知県</option>
                      <option value="40">福岡県</option>
                      <option value="41">佐賀県</option>
                      <option value="42">長崎県</option>
                      <option value="43">熊本県</option>
                      <option value="44">大分県</option>
                      <option value="45">宮崎県</option>
                      <option value="46">鹿児島県</option>
                      <option value="47">沖縄県</option>
                    </select>
                </div>
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
                    <input name="checkboxes" id="checkboxes-0" type="checkbox" value="">
                    小型犬
                  </label>
                  </div>
                <div class="checkbox">
                  <label for="checkboxes-1">
                    <input name="checkboxes" id="checkboxes-1" type="checkbox" value="">
                    中型犬
                  </label>
                </div>
                <div class="checkbox">
                  <label for="checkboxes-2">
                    <input name="checkboxes" id="checkboxes-2" type="checkbox" value="">
                    大型犬
                  </label>
                </div>
                <div class="checkbox">
                  <label for="checkboxes-3">
                    <input name="checkboxes" id="checkboxes-3" type="checkbox" value="">
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
                              <a href="../design/result_search.html">
                              <div class="photo">
                                  <!-- <img src="http://placehold.it/350x260" class="img-responsive" alt="a" /> -->
                                  <img src="../img/dogs_picture/<?php echo $user['dog_picture_path']; ?>" class="img-responsive" alt="" />
                              </div>
                              </a>
                              <div class="info">
                                  <div class="row">
                                      <a href="../design/result_search.html">
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

