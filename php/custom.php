<?php
  session_start();
  require('dbconnect.php');
  
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

  // 更新ボタンが押されたとき
if (!empty($_POST) && $_POST['submit-type'] == 'user') {
    // UPDATE文用意
    // $sql = 'INSERT INTO `users` SET `last_name`="takeishi"';

    // エラー処理
  $errors = array();

  if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'rewrite') {
    $errors['rewrite'] = true;
  } if (!empty($_POST)) {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $postal_code = $_POST['postal_code'];
    $area_detail = $_POST['area_detail'];
    $area_detail2 = $_POST['area_detail2'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    if ($last_name == '') {
      $errors['last_name'] = 'blank';
    }

    if ($first_name == '') {
      $errors['first_name'] = 'blank';
    }

    if ($postal_code == '') {
      $errors['postal_code'] = 'blank';
    }

    if ($area_detail == '') {
      $errors['area_detail'] = 'blank';
    }

    if ($area_detail2 == '') {
      $errors['area_detail2'] = 'blank';
    }

    if ($phone_number == '') {
      $errors['phone_number'] = 'blank';
    }

    if ($email == '') {
      $errors['email'] = 'blank';
    }


    // if (empty($errors)) {
    // $file_name = $_FILES['picture_path']['name'];
    // if (!empty($file_name)) {
    //   $ext = substr($file_name, -3);
    //   $ext = strtolower($ext);
    //   if ($ext != 'jpg' && $ext != 'png' && $ext != 'gif') {
    //     $errors['picture_path'] = 'type';
    //   }
    //   }else{
    //     $errors['picture_path'] = 'blank';
    //   }
    // }
    // if (empty($errors)) {
    //   try{
    //     $sql = 'SELECT COUNT(*) AS `cnt` FROM `users` WHERE `email` = ?';
    //     $data = array($email);
    //     $stmt = $dbh->prepare($sql);
    //     $stmt->execute($data);
    //     $record = $stmt->fetch(PDO::FETCH_ASSOC);
    //     if ($record['cnt'] > 0) {
    //       $errors['email'] = 'duplicate';
    //     }
    //   }catch(PDOException $e){
    //     echo 'SQL実行時エラー : ' . $e-> message();
    //   }
    // }    
    // if (empty($errors)) {
    //   $picture_name = date('YmdHis') . $file_name;
    //   move_uploaded_file($_FILES['picture_path']['tmp_name'], '../img/users_picture/' . $picture_name);
    //   $_SESSION['join'] = $_POST;
    //   $_SESSION['join']['picture_path'] = $picture_name;
    //   header('Location: check.php');
    //   exit();
    // }

    // ページをもう一枚作る　確認ページ

  }

  // エラー処理 end

    if (empty($errors)) {

    $sql = 'UPDATE `users` SET `last_name`=?, `first_name`=?, `email`=?, `phone_number`=?, `postal_code`=?, `area_id`=?, `area_detail`=?, `area_detail2`=?, `picture_path`=?, `role`=? WHERE `user_id`=?';
    // 実行
    $data = array($_POST['last_name'], $_POST['first_name'], $_POST['email'], $_POST['phone_number'], $_POST['postal_code'], $_POST['area_id'], $_POST['area_detail'], $_POST['area_detail2'], $_POST['picture_path'], $_POST['role'], $login_user['user_id']);
    $up_stmt = $dbh->prepare($sql);
    $up_stmt->execute($data);

    header('Location: mypage.php');
    exit();
    }
}




    // 犬の更新ボタンが押された時
  if (!empty($_POST) && $_POST['submit-type'] == 'dog') {
    // UPDATE文用意
    // $sql = 'INSERT INTO `users` SET `last_name`="takeishi"';
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'rewrite') {
    $errors['rewrite'] = true;
    } if (!empty($_POST)) {
    $name = $_POST['name'];
    $character = $_POST['character'];
    
      if ($name == '') {
        $errors['name'] = 'blank';
      }
      if ($character == '') {
          $errors['character'] = 'blank';
        }  
   }
    $sql = 'UPDATE `dogs` SET `name`=?, `fleas`=?, `vaccin`=?, `spay_cast`=?, `character`=?, `dog_picture_path`=? WHERE `dog_id`=?';
    // 実行
    $data = array($_POST['name'], $_POST['fleas'], $_POST['vaccin'], $_POST['spay_cast'], $_POST['character'], $_POST['dog_picture_path'], $_POST['dog_id']);
    $re_stmt = $dbh->prepare($sql);
    $re_stmt->execute($data);

    header('Location: mypage.php');
    exit();
    }

  


  $sql = 'SELECT * FROM `users` WHERE `user_id`=?';
  $data = array($login_user['user_id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // echo '<pre>';
  // var_dump($user);
  // echo '</pre>';


  $sql = 'SELECT * FROM `dogs` WHERE `user_id`=?';
  $data = array($login_user['user_id']);
  $re_stmt = $dbh->prepare($sql);
  $re_stmt->execute($data);

  $sql = 'SELECT `area_id`, `area_name` FROM `areas`';
  $data = array();
  $area_stmt = $dbh->prepare($sql);
  $area_stmt->execute($data);
  $areas = array();
  while ($area = $area_stmt->fetch(PDO::FETCH_ASSOC)) {
        $areas[] = $area;
  }

    // 犬の数だけ繰り返し文を使用し、紹介欄の表示
    // $count = count($dog);
    // for ($i=0; $i < $count; $i++) {
    //     // 入力欄（divタグ？）
    // }
    // 入力欄に対応するを挿入
    // for ($i=0; $i < ; $i++) {
    // }

  

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

<!-- ユーザーの情報 -->
<br>
<div class="container">
 <div class="row">
  <div class="col-md-6 col-lg-offset-4 centered">
    <div class="form-area">  
        <form role="form" method="POST" action="">　<!-- 忘れるな -->
          <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;"> ~ ユーザの情報編集 ~ </h3>
                    <div class="form-group">
                      <p class="data">変更する前のユーザーの画像</p>
                      <div class="hogehoge"><img src="../img/users_picture/<?php echo $user['picture_path']; ?>" style="width: 80%; height: 80%;"></div>
                      <input type="file" name="picture_path">
                    </div>

                    <div class="form-group">
                      <p class="data">性</p>
                      <textarea type="text" class="form-control" name="last_name" style="width: 480px; height: 30px; font-size: 15px"><?php echo $user['last_name']; ?></textarea>
                      <?php if(isset($errors['last_name']) && $errors['last_name'] == 'blank'): ?>
                        <p style="color: red; font-size: 10px; margin-top: 2px;">姓を入力してください</p>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <p class="data">名</p>
                      <textarea type="text" class="form-control" name="first_name" style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['first_name']; ?></textarea>
                      <?php if(isset($errors['first_name']) && $errors['first_name'] == 'blank'): ?>
                        <p style="color: red; font-size: 10px; margin-top: 2px;">名を入力してください</p>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <p class="data">郵便番号</p>
                      <textarea type="text" class="form-control" name="postal_code" style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['postal_code']; ?></textarea>
                      <?php if(isset($errors['postal_code']) && $errors['postal_code'] == 'blank'): ?>
                        <p style="color: red; font-size: 10px; margin-top: 2px;">郵便番号を入力してください</p>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <p class="data">都道府県</p>
                      <select class="form-control" name="area_id">
                      <?php for ($i=0; $i < 47; $i++): ?>
                        <?php if ($areas[$i]['area_id'] == $user['area_id']): ?> 
                        <option value="<?php echo $areas[$i]['area_id']; ?>"><?php echo $areas[$i]['area_name']; ?></option>
                        <?php endif; ?>
                      <?php endfor; ?>
                        <?php for ($i=0; $i < 47; $i++): ?>
                          <option value="<?php echo $areas[$i]['area_id']; ?>"><?php echo $areas[$i]['area_name']; ?></option>
                        <?php endfor; ?>
                      </select> <!-- optionが全都道府県分入れる area_id selected -->
                    </div>

                    <div class="form-group">
                      <p class="data">市区町村</p>
                      <textarea type="text" class="form-control" name="area_detail" style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['area_detail']; ?></textarea>
                      <?php if(isset($errors['area_detail']) && $errors['area_detail'] == 'blank'): ?>
                        <p style="color: red; font-size: 10px; margin-top: 2px;">市区町村を入力してください</p>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <p class="data">番地・マンション名</p>
                      <textarea type="text" class="form-control" name="area_detail2" style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['area_detail2']; ?></textarea>
                      <?php if(isset($errors['area_detail2']) && $errors['area_detail2'] == 'blank'): ?>
                        <p style="color: red; font-size: 10px; margin-top: 2px;">番地・マンション名を入力してください</p>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <p class="data">電話番号</p>  
                      <textarea type="text" class="form-control" name="phone_number" style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['phone_number']; ?></textarea>
                      <?php if(isset($errors['phone_number']) && $errors['phone_number'] == 'blank'): ?>
                        <p style="color: red; font-size: 10px; margin-top: 2px;">電話番号を入力してください</p>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <p class="data">メールアドレス</p>
                      <textarea type="text" class="form-control" name="email" style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['email']; ?></textarea>
                      <?php if(isset($errors['email']) && $errors['email'] == 'blank'): ?>
                        <p style="color: red; font-size: 10px; margin-top: 2px;">メールアドレスを入力してください</p>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <p class="data">あなたの希望を選んでください</p>
                      <select type="text" name="role" class="form-control">
                        <?php if ($user['role'] == 0): ?>
                          <option value="0" selected>両方したい</option>
                          <option value="1">体験だけしたい</option>
                          <option value="2">預かるだけしたい</option>
                        <?php elseif ($user['role'] == 1): ?>
                          <option value="0">両方したい</option>
                          <option value="1" selected>体験だけしたい</option>
                          <option value="2">預かるだけしたい</option>
                        <?php elseif ($user['role'] == 2): ?>
                          <option value="0">両方したい</option>
                          <option value="1">体験だけしたい</option>
                          <option value="2" selected>預かるだけしたい</option>
                        <?php endif; ?>
                      </select>
                    </div>

                      <span class="help-block"><p id="characterLeft" class="help-block">上記の確認を再度お願いします</p></span>
                      <input type="hidden" name="submit-type" value="user">                    
          <button type="submit" name="update" class="btn btn-primary pull-right">更新する</button> <!-- 忘れるな submit -->
        </form>
    </div>
  </div>
</div>

<!-- 犬の情報 -->

<?php while ($dog = $re_stmt->fetch(PDO::FETCH_ASSOC)): ?>

<div class="row">
  <div class="col-md-6 col-lg-offset-4 centered">
    <div class="form-area">
      <form role="form" method="POST" action="">
        <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;"> ~ 愛犬の情報編集 ~ </h3>
                    <div class="form-group">
                      <p class="data">変更する愛犬の画像</p>
                      <div class="fugafuga"><img src="../img/dogs_picture/<?php echo $dog['dog_picture_path']; ?>" style="width: 80%; height: 80%"></div>
                      <input type="file" name="dog_picture_path">
                    </div>
                    <div class="form-group">
                      <p class="data">愛犬の名前</p>
                      <textarea type="text" name="name" class="form-control" style="width: 480px; height: 30px; font-size: 15px"><?php echo $dog['name']; ?></textarea>
                      <?php if(isset($errors['name']) && $errors['name'] == 'blank'): ?>
                        <p style="color: red; font-size: 10px; margin-top: 2px;">名前を入力してください</p>
                      <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <p class="data">ノミ・ダニ予防をしていますか？</p>
                      <select id="selectbasic" name="fleas" class="form-control">
                        <?php if ($dog['fleas'] == 1): ?>
                        <option value="1" selected>はい</option>
                        <option value="2">いいえ</option>
                        <?php elseif ($dog['fleas'] == 2): ?>
                        <option value="1">はい</option>
                        <option value="2" selected>いいえ</option>
                        <?php endif; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <p class="data">混合ワクチンをしていますか？</p>
                      <select id="selectbasic" name="vaccin" class="form-control">
                        <?php if ($dog['vaccin'] == 1): ?>
                        <option value="1" selected>はい</option>
                        <option value="2">いいえ</option>
                        <?php elseif ($dog['vaccin'] == 2): ?>
                        <option value="1">はい</option>
                        <option value="2" selected>いいえ</option>
                        <?php endif; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <p class="data">避妊去勢をしていますか？</p>
                      <select id="selectbasic" name="spay_cast" class="form-control">
                        <?php if ($dog['spay_cast'] == 1): ?>
                        <option value="1" selected>はい</option>
                        <option value="2">いいえ</option>
                        <?php elseif ($dog['spay_cast'] == 2): ?>
                        <option value="1">はい</option>
                        <option value="2" selected>いいえ</option>
                        <?php endif; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <p class="data">性格や特徴について</p>
                      <textarea class="form-control" type="textarea" name="character" maxlength="140" rows="7"><?php echo $dog['character']; ?></textarea>
                      <?php if(isset($errors['name']) && $errors['name'] == 'blank'): ?>
                        <p style="color: red; font-size: 10px; margin-top: 2px;">名前を入力してください</p>
                      <?php endif; ?>
                        <span class="help-block"><p id="characterLeft" class="help-block ">上記の確認を再度お願いします</p></span>
                    </div>
                  <input type="hidden" name="submit-type" value="dog"> <!-- 重要 -->
                  <input type="hidden" name="dog_id" value="<?php echo $dog['dog_id']; ?>">
        <button type="submit" name="update" class="btn btn-primary pull-right">更新する</button>
      </form>
    </div>  
  </div>
</div>


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
            img.setAttribute('width', '500px', 'height', '375px');
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
    $.querySelector('input.dog_picture').addEventListener('change', function(e) {
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
            img.setAttribute('width', '500px', 'height', '375px');
            img.setAttribute('title',  file.name);
            // imgタグを$previeの中に追加
            $preview.appendChild(img);
          }; 
        })(file);

        reader.readAsDataURL(file);
    }); 
});
    </script>
  </span>
</body>
</html>