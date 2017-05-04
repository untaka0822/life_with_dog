<?php 
session_start();
require('dbconnect.php');
  // if (!isset($_SESSION['join'])){
  //   header('Location: login.php');
  //   exit();
  // }
    
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="../assets/css/bootstrap.css" rel="stylesheet">
<link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet"> 
<link href="../assets/css/login.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../assets/css/header.css"> 
<title>愛犬登録完了</title>
<header>
  <nav>
    <ul>
      <li class="title">
        <a href="top.html" style="font-size: 45px; font-family: 'Times New Roman',italic;">
          Life <span style="font-size:30px;">with</span> Dog
        </a>
      </li>
    </ul>
  </nav>
</header>
</head>
<body>
<div class="container">
  <div class="row">
		<h1>愛犬登録完了</h1>
    <div id="bc1" class="btn-group btn-breadcrumb">
        <a href="#" class="btn btn-default">
         <div>　    　新規愛犬登録　    　</div>
        </a>
        <a href="#" class="btn btn-default">
         <div>　　    登録内容確認　    　</div>
        </a>
        <a href="#" class="btn btn-default">
         <div style="color: red; font-weight: bold">　    　愛犬登録完了　    　</div>
        </a>
    </div>
	</div>
</div>
<br>
<br>
<br>
<div class="row">
  <div class="col-xs-6 col-xs-offset-4">
    <h1>登録ありがとうございます！！</h1>
  </div>
</div>
<br>
<br>
<br>

<div class="form-group">
  <label class="col-md-5 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <input type="button" value="トップ画面へ" class="btn btn-primary" onclick="location.href='top.php'">
  </div>
</div>

</body>
</html>