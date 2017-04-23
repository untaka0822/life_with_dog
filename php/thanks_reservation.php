<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../assets/css/thanks_reservation.css">
<link rel="stylesheet" type="text/css" href="../assets/css/header.css">
<header>
  <nav>
    <ul>
      <li class="title">
        <a href="top.html" style="font-size: 45px; font-family: 'Times New Roman',italic;">
          Life <span style="font-size:30px;">with</span> Dog
        </a>
      </li>
      <li class="nav_list">
        <a href="search.html">
          預けたい人
        </a>
      </li>
      <li class="nav_list">
        <a href="search_dog.html">
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
<div class="clear"></div>
<?php
  $file_name = getFileNameFromUri();
  if($file_name == 'index.php'):
?>

<?php endif; ?>
  <title></title>
</head>
<body>
<br>
<h1>予約完了いたしました。</h1>
<br>
<div class="buttons">
  <div class="button">
    <form action="user_history.html">
      <button type="submit" class="btn btn-primary btn-mg">利用履歴へ</button>
    </form>
  </div>
    <form action="sns.html">
      <button type="submit" class="btn btn-primary btn-mg">やりとりへ</button>
    </form>
</div>
</body>
</html>