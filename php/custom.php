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

  $sql = 'UPDATE'
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
        <form role="form">
          <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;"> ~ ユーザ情報編集 ~ </h3>
                    <div class="form-group">
                      <p class="data">ユーザーの画像</p>
                      <div class="preview"></div>
                      <input type="file" name="file">                  
                    </div>
                    <div class="form-group">
                      <p class="data">性</p>
                      <textarea type="text" class="form-control" id="Adress" name="Adress" required style="width: 480px; height: 30px; font-size: 15px"><?php echo $user['last_name']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">名</p>
                      <textarea type="text" class="form-control" id="Adress" name="Adress" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['first_name']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">郵便番号</p>
                      <textarea type="text" class="form-control" id="Adress" name="Adress" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['postal_code']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">都道府県</p>
                      <textarea type="text" class="form-control" id="Adress" name="Adress" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['area_id']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">市区町村</p>
                      <textarea type="text" class="form-control" id="Adress" name="Adress" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['area_detail']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">番地・マンション</p>
                      <textarea type="text" class="form-control" id="Adress" name="Adress" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['area_detail2']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">電話番号</p>
                      <textarea type="text" class="form-control" id="Adress" name="Adress" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['phone_number']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">メールアドレス</p>
                      <textarea type="text" class="form-control" id="Adress" name="Adress" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['email']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">パスワード</p>
                      <textarea type="text" class="form-control" id="Adress" name="Adress" required style="width: 480px; height: 30px; font-size: 15px;"><?php echo $user['password']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">パスワード確認</p>
                      <textarea type="text" class="form-control" id="Adress" name="Adress" placeholder="再度パスワードを入力してください" required style="width: 480px; height: 30px; font-size: 15px;"></textarea>
                    </div>
                        <span class="help-block"><p id="characterLeft" class="help-block">上記の確認を再度お願いします</p></span>                    
          <button type="button" id="submit" name="submit" class="btn btn-primary pull-right">更新する</button>
        </form>
    </div>  
  </div>
</div>

<!-- 犬の情報1 -->
<div class="row">
  <div class="col-md-6 col-lg-offset-4 centered">
    <div class="form-area">  
      <form role="form">
        <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;"> ~ 愛犬の情報編集1 ~ </h3>
                    <div class="form-group">
                      <p class="data">愛犬の画像</p>
                      <div class="preview"></div>
                      <input type="file" name="file">                    
                    </div>
                    <div class="form-group">
                      <p class="data">愛犬の名前</p>
                      <textarea type="text" class="form-control" id="Adress" name="Adress" required style="width: 480px; height: 30px; font-size: 15px"><?php echo $dog['name']; ?></textarea>
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
            
        <button type="button" id="submit" name="submit" class="btn btn-primary pull-right">更新する</button>
      </form>
    </div>  
  </div>
</div>

<!-- 犬の情報2 -->
<div class="row">
  <div class="col-md-6 col-lg-offset-4 centered">
    <div class="form-area">  
      <form role="form">
        <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;"> ~ 愛犬の情報編集2 ~ </h3>
                    <div class="preview">
                      <p class="data">アイコンの画像</p>
                      <img src="../assets/php/custom.php" style="width: 250px">
                      <input type="file" name="file">                    
                    </div>
                    <div class="form-group">
                      <p class="data">愛犬の名前</p>
                      <textarea type="text" class="form-control" id="Adress" name="Adress" required style="width: 480px; height: 30px; font-size: 15px"><?php echo $dog['name']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <p class="data">ノミ・ダニ予防をしていますか？</p>
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
            
        <iuput type="submit" id="submit" name="submit" class="btn btn-primary pull-right">更新する</button>
      </form>
    </div>  
  </div>
</div>


    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/jquery-migrate.js"></script>
    <script src="../asstes/js/bootstrap.js"></script>
    <script src="../assets/js/custom_preview.js"></script>

</body>
</html>