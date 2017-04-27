<?php
  session_start();
  require('dbconnect.php');
  $_SESSION['id'] = 1; // けいすけさんのページから取得するため本来必要ない

  // 更新ボタンが押されたとき
  if (!empty($_POST)) {
    // UPDATE文用意
    // $sql = 'INSERT INTO `users` SET `last_name`="takeishi"';
    $sql = 'UPDATE `users` SET `last_name`=?, `first_name`=?, `postal_code`=?, `area_id`=?, `area_detail`=?, `area_detail2`=?, `phone_number`=?, `email`=?, `picture_path`=? WHERE `user_id`=?';
    // 実行
    $data = array($_POST['last_name'], $_POST['first_name'], $_POST['postal_code'], $_POST['area_id'], $_POST['area_detail'], $_POST['area_detail2'], $_POST['phone_number'], $_POST['email'], $_POST['picture_path'], $_SESSION['id']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
  }

  $sql = 'SELECT * FROM `users` WHERE `user_id`=?';
  $data = array($_SESSION['id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  $sql = 'SELECT * FROM `dogs` WHERE `user_id`=?';
  $data = array($_SESSION['id']);
  $re_stmt = $dbh->prepare($sql);
  $re_stmt->execute($data);
  

  echo '<pre>';
  var_dump($user);
  echo '</pre>';
?>

<!DOCTYPE html>
<html lang="ja">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/mypage.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
    <!-- http://bootsnipp.com/snippets/featured/flipkart-like-navbar -->
    <title>ユーザー情報編集</title>

<!-- mypage_header.php -->
<?php
  require('mypage_header.php');
?>

<br>
<br>
<br>

</head>
<body>

<!-- mypage_sidebar.php -->
<?php
  require('mypage_sidebar.php');
?>

<!-- ユーザーの情報 -->
<br>
<div class="container">
 <div class="row">
  <div class="col-md-6 col-lg-offset-4 centered">
    <div class="form-area">  
        <form role="form" method="POST" action="">　<!-- 忘れるな -->
          <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;"> ~ ユーザ情報編集 ~ </h3>
                    <div class="form-group">
                      <p class="data">変更するユーザーの画像</p>
                      <div class="hogehoge"><img src="../user_picture/<?php echo $_SESSION['id']['picture_path']; ?>"></div>
                      <input type="file" name="file" class="user_picture">
                    </div>
                    <div class="form-group">
                      <p class="data">性</p>
                      <textarea type="text" class="form-control" name="last_name" required style="width: 480px; height: 30px; font-size: 15px"><?php echo $user['last_name']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">名</p>
                      <textarea type="text" class="form-control" name="first_name" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['first_name']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">郵便番号</p>
                      <textarea type="text" class="form-control" name="postal_code" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['postal_code']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">都道府県</p>
                      <textarea type="text" class="form-control" name="area_id" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['area_id']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">市区町村</p>
                      <textarea type="text" class="form-control" name="area_detail" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['area_detail']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">番地・マンション</p>
                      <textarea type="text" class="form-control" name="area_detail2" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['area_detail2']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">電話番号</p>  
                      <textarea type="text" class="form-control" name="phone_number" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['phone_number']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">メールアドレス</p>
                      <textarea type="text" class="form-control" name="email" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['email']; ?></textarea>
                    </div>
                      <span class="help-block"><p id="characterLeft" class="help-block">上記の確認を再度お願いします</p></span>                    
          <button type="submit" name="update" class="btn btn-primary pull-right">更新する</button> <!-- 忘れるな submit -->
        </form>
    </div>
  </div>
</div>

<!-- 犬の情報 -->
<?php while($dog = $re_stmt->fetch(PDO::FETCH_ASSOC)): ?>

<div class="row">
  <div class="col-md-6 col-lg-offset-4 centered">
    <div class="form-area">
      <form role="form" method="POST" action="">
        <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;"> ~ 愛犬の情報編集 ~ </h3>
                    <div class="form-group">
                      <p class="data">変更する愛犬の画像</p>
                      <div class="fugafuga"></div>
                      <input type="file" name="file" class="dog_picture1">                  
                    </div>
                    <div class="form-group">
                      <p class="data">愛犬の名前</p>
                      <textarea type="text" class="form-control" style="width: 480px; height: 30px; font-size: 15px"><?php echo $dog['name']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">ノミ・ダニ予防をしていますか？</p>
                      <!-- if文？ -->
                      <select id="selectbasic" name="selectbasic" class="form-control">
                        <option value="1">はい</option>
                        <option value="2">いいえ</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <p class="data">混合ワクチンをしているか？</p>
                      <select id="selectbasic" name="selectbasic" class="form-control">
                        <option value="1">はい</option>
                        <option value="2">いいえ</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <p class="data">避妊去勢をしているか？</p>
                      <select id="selectbasic" name="selectbasic" class="form-control">
                        <option value="1">はい</option>
                        <option value="2">いいえ</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <p class="data">性格や特徴について</p>
                      <textarea class="form-control" type="textarea" id="introduce" maxlength="140" rows="7"><?php echo $dog['character']; ?></textarea>
                        <span class="help-block"><p id="characterLeft" class="help-block ">上記の確認を再度お願いします</p></span>
                    </div>
            
        <button type="submit" name="update" class="btn btn-primary pull-right">更新する</button>
      </form>
    </div>  
  </div>
</div>

<?php
echo '<pre>';
var_dump($dog);
echo '</pre>';
?>
<?php endwhile; ?>


    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/jquery-migrate.js"></script>
    <script src="../asstes/js/bootstrap.js"></script>
    <script>
// documentと毎回書くのがだるいので$に置き換え
var $ = document; 
var $form = $.querySelector('form');// jQueryの $("form")相当

//jQueryの$(function() { 相当(ただし厳密には違う)
$.addEventListener('DOMContentLoaded', function() {
    //画像ファイルプレビュー表示
    //  jQueryの $('input[type="file"]')相当
    // addEventListenerは on("change", function(e){}) 相当
    $.querySelector('input.user_picture').addEventListener('change', function(e) {
        var file = e.target.files[0],
               reader = new FileReader(),
               $preview =  $.querySelector(".hogehoge"), // jQueryの $(".preview")相当
               t = this;

        // 画像ファイル以外の場合は何もしない
        if(file.type.indexOf("image") < 0){
          return false;
        }

        reader.onload = (function(file) {
          return function(e) {
             //jQueryの$preview.empty(); 相当
             while ($preview.firstChild) $preview.removeChild($preview.firstChild);

            // imgタグを作成
            var img = document.createElement( 'img' );
            img.setAttribute('src',  e.target.result);
            img.setAttribute('width', '150px');
            img.setAttribute('title',  file.name);
            // imgタグを$previeの中に追加
            $preview.appendChild(img);
          }; 
        })(file);

        reader.readAsDataURL(file);
    }); 
});
    </script>

    <script>
// documentと毎回書くのがだるいので$に置き換え
var $ = document; 
var $form = $.querySelector('form');// jQueryの $("form")相当

//jQueryの$(function() { 相当(ただし厳密には違う)
$.addEventListener('DOMContentLoaded', function() {
    //画像ファイルプレビュー表示
    //  jQueryの $('input[type="file"]')相当
    // addEventListenerは on("change", function(e){}) 相当
    $.querySelector('input.dog_picture1').addEventListener('change', function(e) {
        var file = e.target.files[0],
               reader = new FileReader(),
               $preview =  $.querySelector(".fugafuga"), // jQueryの $(".preview")相当
               t = this;

        // 画像ファイル以外の場合は何もしない
        if(file.type.indexOf("image") < 0){
          return false;
        }

        reader.onload = (function(file) {
          return function(e) {
             //jQueryの$preview.empty(); 相当
             while ($preview.firstChild) $preview.removeChild($preview.firstChild);

            // imgタグを作成
            var img = document.createElement( 'img' );
            img.setAttribute('src',  e.target.result);
            img.setAttribute('width', '150px');
            img.setAttribute('title',  file.name);
            // imgタグを$previeの中に追加
            $preview.appendChild(img);
          }; 
        })(file);

        reader.readAsDataURL(file);
    }); 
});
    </script>
</body>
</html>