<?php 
 // session_start();
 require('dbconnect.php');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../assets/css/notice.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/mypage.css">

  <title>リクエスト</title>

  <?php
    require('mypage_header.php');
  ?>

</head>

<br>
<br>
<br>
<br>

<body>

  <?php
  require('mypage_sidebar.php');
  ?>


  <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-offset-3 cnetered well">
                  <div class="page-header">
                    <h1><small class="pull-right">リクエスト数</small> リクエスト一覧</h1>
                  </div> 
                   <div class="comments-list">
                       <div class="media">
                           <p class="pull-right"><small>5日前</small></p>
                            <a class="media-left" href="#">
                              <img src="../assets/images/mypage-user.jpg" style="width: 40px; height: 40px">
                            </a>
                            <div class="media-body">
                                
                              <h4 class="media-heading user_name">例：Avicii</h4>
                            　 了解しました
                              <p><small><a href="">ユーザーの詳細へ</a></small></p>
                              <div>
                              <p class="col-md-6 col-lg-offset-4 centered">希望日時・申込日・メッセージ</p><br><br>
                              <input type="submit" value="キャンセル" class="pull-right">
                              <input type="submit" value="日時変更・やり取り" class="pull-right">
                              <input type="submit" value="完了" class="pull-right">

                              </div>
                            </div>
                        </div>
                       
                       <div class="media">
                           <p class="pull-right"><small>7日前</small></p>
                            <a class="media-left" href="#">
                              <img src="../assets/images/mypage-user.jpg" style="width: 40px; height: 40px">
                            </a>
                            <div class="media-body">
                                
                              <h4 class="media-heading user_name">例：Avicii</h4>
                            　 了解しました
                              <p><small><a href="">ユーザーの詳細へ</a></small></p>
                              <div>
                              <p class="col-md-6 col-lg-offset-4 centered">希望日時・申込日・メッセージ</p><br><br>
                              <input type="submit" value="キャンセル" class="pull-right">
                              <input type="submit" value="日時変更・やり取り" class="pull-right">
                              <input type="submit" value="完了" class="pull-right">

                              </div>
                            </div>
                        </div>

                        <div class="media">
                           <p class="pull-right"><small>18日前</small></p>
                            <a class="media-left" href="#">
                              <img src="../assets/images/mypage-user.jpg" style="width: 40px; height: 40px">
                            </a>
                            <div class="media-body">
                                
                              <h4 class="media-heading user_name">例：Avicii</h4>
                            　 了解しました
                              <p><small><a href="">ユーザーの詳細へ</a></small></p>
                              <div>
                              <p class="col-md-6 col-lg-offset-4 centered">希望日時・申込日・メッセージ</p><br><br>
                              <input type="submit" value="キャンセル" class="pull-right">
                              <input type="submit" value="日時変更・やり取り" class="pull-right">
                              <input type="submit" value="完了" class="pull-right">

                              </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>

        <script src="../assets/js/jquery.js"></script>
        <script src="../assets/js/jquery-migrate.js"></script>
        <script src="../assets/js/bootstrap.js"></script>

</body>
</html>

