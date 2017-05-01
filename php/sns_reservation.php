<?php
session_start();
require('dbconnect.php');
$_SESSION['login_member_id'] = 1;
$me = 1;
$you = 2;

// if (isset($_SESSION['login_member_id'])) {
    // ログインユーザー情報
    $sql = 'SELECT * FROM `users` WHERE `user_id` = ?';
    $data = array($_SESSION['login_member_id']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $login_user = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // var_dump($login_user);
    // echo '</pre>';
// }else{
    // ログインしていない
//     header('Location: login.php');
//     exit();
// }

if(!empty($_POST['send'])){
    if($_POST['send'] != ''){
        // DBへの登録処理
        $sql = 'INSERT INTO `messages` SET `message` = ?,
                                           `sender_id` = ?,
                                           `receiver_id` = ?,
                                           `created` = NOW()';
        $data = array($_POST['content'], $_SESSION['login_member_id'], $you);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        header('Location: sns_reservation.php');
        exit();
    }
}
// message_id message sender_id receiver_id created modified

// $sql = 'SELECT count(*) FROM `messages` WHERE `sender_id` = 1 AND `receiver_id` = 2;';
// $stmt2 = $dbh->prepare($sql);
// $stmt2->execute();
// $count = $stmt2->fetch(PDO::FETCH_ASSOC);

// echo $count;

// $message = $stmt->fetch(PDO::FETCH_ASSOC);

// var_dump($message);
// $cnt = count($messages);
// var_dump($messages);
// echo $message;
// for ($i=0; $i < $cnt ; $i++) {
//     echo $messages[$i]['message'] . '<br>';
// }

$sql = 'SELECT * FROM `messages` WHERE `sender_id` = 1 OR `sender_id` = 2 AND `receiver_id` = 1 OR `receiver_id` = 2';
$data = array();
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

$messages = array();
while ($message = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $messages[] = $message;
}
// echo '<pre>';
// var_dump($messages);
// echo '</pre>';
$cnt = count($messages);

// 自分自身
// $login_user

//チャット相手
// ログインユーザーのIDと一致しないほうのsender_idかreciver_idがチャット相手のid
if ($messages[0]['sender_id'] != $_SESSION['login_member_id']) {
    $receiver = $messages[0]['sender_id'];
}elseif ($messages[0]['receiver_id'] != $_SESSION['login_member_id']) {
    $receiver = $messages[0]['receiver_id'];
}

$sql = 'SELECT * FROM `users` WHERE `user_id` = ?';
$data = array($receiver);
$stmt2 = $dbh->prepare($sql);
$stmt2->execute($data);
$receiver = $stmt2->fetch(PDO::FETCH_ASSOC);

// var_dump($receiver);
// var_dump($tests);
// echo '<br>' . '<br>';
// var_dump($tests2);

// 日時予約
$start_date = '';
$end_date = '';

$errors = array();

if (!empty($_POST)) {
    if ($_POST['start_year'] == 0  ||  $_POST['start_month'] == 0  ||  $_POST['start_date']== 0  || $_POST['end_year'] == 0 || $_POST['end_month'] == 0 || $_POST['end_date'] == 0) {
          $errors['start_date'] = 'blank';
          $errors['end_date'] = 'blank';
    }elseif(!empty($_POST['update'])){
        $start_date = $_POST['start_year'] . $_POST['start_month'] . $_POST['start_date'];
        $end_date = $_POST['end_year'] . $_POST['end_month'] . $_POST['end_date'];
        $sql = 'UPDATE `reservations` SET `date_start`=?, `date_end`=? WHERE `reservation_id` =?';
        $data = array($start_date, $end_date, $_REQUEST['reservation_id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        header('Location: thanks_reservation.php');
        exit();
    }else {
        // var_dump($_POST);
        // $start_date = $_POST['start_year'] . $_POST['start_month'] . $_POST['start_date'];
        // $end_date = $_POST['end_year'] . $_POST['end_month'] . $_POST['end_date'];

        $_SESSION['reserve'] = $_POST;

        // $sql = 'INSERT INTO `reservations` SET `host_id`= ?, `client_id`=?,  `date_start`=?, `date_end`=?';
        // $data = array($me, $you, $start_date, $end_date);
        // $stmt->execute($data);

        header('Location: check_reservation.php');
        exit();
    }
}


// $sql = 'UPDATE * SET `reservations` SET `host_id`= ?, `client_id`=?,  `date_start`=?, `date_end`=?';
// $data = array($_SESSION['login_member_id'], $you, $start_date, $end_date);
// $stmt = $dbh->prepare($sql);
// $stmt->execute($data);


?>




<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../assets/css/sns_reservation.css">
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
  // $file_name = getFileNameFromUri();
  // if($file_name == 'index.php'):
?>

<?php // endif; ?>
  <title></title>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-7">
      <h2 class="page-header">チャット</h2>
      <div class="messages">
      <?php for ($i=0; $i < $cnt ; $i++): ?>
        <section class="comment-list">
          <!-- チャット相手からのメッセージ -->
          <?php if ($messages[$i]['sender_id'] != $_SESSION['login_member_id']) { ; ?>
            <article class="row">
              <div class="col-md-2 col-sm-2 hidden-xs">
                <figure class="thumbnail">
                  <img class="img-responsive" src="<?php echo $receiver['picture_path']; ?>" />
                </figure>
              </div>
              <div class="col-md-10 col-sm-10">
                <div class="panel panel-default arrow left">
                  <div class="panel-body">
                    <header class="text-left">
                      <div class="comment-user"><i class="fa fa-user"></i>
                        <?php echo $receiver['last_name'] . ' ' .  $receiver['first_name'];?>
                      </div>
                      <time class="comment-date" datetime="<?php echo $messages[$i]['created']; ?>"><i class="fa fa-clock-o"></i>
                        <?php echo $messages[$i]['created']; ?>
                      </time>
                    </header>
                    <div class="comment-post">
                      <p>
                        <?php echo $messages[$i]['message']; ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          <?php }elseif($messages[$i]['sender_id'] == $_SESSION['login_member_id']){; ?>
          <!-- 自分が送ったメッセージ -->
          <article class="row">
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow right">
                <div class="panel-body">
                  <header class="text-right">
                    <time class="comment-date" datetime="<?php echo $messages[$i]['created']; ?>"><i class="fa fa-clock-o"></i>
                      <?php echo $messages[$i]['created']; ?>
                    </time>
                  </header>
                  <div class="comment-post">
                    <p>
                      <?php echo $messages[$i]['message']; ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs">
              <figure class="thumbnail">
                <img class="img-responsive" src="<?php echo $login_user['picture_path']; ?>" />
              </figure>
            </div>
          </article>
          <?php }; ?>
        </section>
      <?php endfor; ?>
      </div>
        <form method="post" action="sns_reservation.php">
          <div class="panel-footer">
            <div class="input-group">
              <input id="btn-input" type="text" name='content' class="form-control input-sm chat_input" placeholder="連絡内容" />
              <span class="input-group-btn">
              <input type="submit" name="send" value="送信" class="btn btn-primary btn-sm" id="btn-chat">
              </span>
            </div>
          </div>
        </form>
    </div>

      <!-- 予約フォーム -->
        <div class="col-md-4">
        <div class="well well-sm">
          <form class="form-horizontal" action="" method="post">
          <fieldset>
            <legend class="text-center">日時予約</legend>
            <!-- Name input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="name">開始日</label>
              <div class="col-md-9">
               <SELECT class="date" name="start_month">
                  <OPTION value="0">月</OPTION>
                  <?php for ($i=1; $i < 10; $i++): ?>
                    <OPTION value="<?php echo 0 . $i; ?>"><?php echo 0 . $i; ?></OPTION>
                  <?php endfor; ?>
                  <?php for ($i=10; $i < 13; $i++): ?>
                    <OPTION value="<?php echo $i; ?>"><?php echo $i; ?></OPTION>
                  <?php endfor; ?>
                </SELECT>
                <SELECT class="date" name="start_date">
                  <OPTION value="0">日</OPTION>
                  <?php for ($i=1; $i < 10; $i++):?>
                    <OPTION value="<?php echo 0 . $i; ?>"><?php echo 0 . $i; ?></OPTION>
                  <?php endfor; ?>
                  <?php for ($i=10; $i < 32; $i++):?>
                    <OPTION value="<?php echo $i; ?>"><?php echo $i; ?></OPTION>
                  <?php endfor; ?>
                </SELECT>
                <SELECT name="start_year">
                  <OPTION value="0">年</OPTION>
                  <?php for ($i=2017; $i < 2021; $i++):?>
                    <OPTION value="<?php echo $i; ?>"><?php echo $i; ?></OPTION>
                  <?php endfor; ?>
                </SELECT>
                <?php if(isset($errors['start_date']) && $errors['start_date'] == 'blank'): ?>
                  <p style="color: red; font-size: 10px; margin-top: 2px;">日付を選択してください</p>
                <?php endif; ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">終了日</label>
              <div class="col-md-9">
                <SELECT class="date" name="end_month">
                  <OPTION value="0">月</OPTION>
                  <?php for ($i=1; $i < 10; $i++): ?>
                    <OPTION value="<?php echo 0 . $i; ?>"><?php echo 0 . $i; ?></OPTION>
                  <?php endfor; ?>
                  <?php for ($i=10; $i < 13; $i++): ?>
                    <OPTION value="<?php echo $i; ?>"><?php echo $i; ?></OPTION>
                  <?php endfor; ?>
                </SELECT>
                <SELECT class="date" name="end_date">
                  <OPTION value="0">日</OPTION>
                  <?php for ($i=1; $i < 10; $i++):?>
                    <OPTION value="<?php echo 0 . $i; ?>"><?php echo 0 . $i; ?></OPTION>
                  <?php endfor; ?>
                  <?php for ($i=10; $i < 32; $i++):?>
                    <OPTION value="<?php echo $i; ?>"><?php echo $i; ?></OPTION>
                  <?php endfor; ?>
                </SELECT>
                <SELECT name="end_year">
                  <OPTION value="0">年</OPTION>
                  <?php for ($i=2017; $i < 2021; $i++):?>
                  <OPTION value="<?php echo $i; ?>"><?php echo $i; ?></OPTION>
                  <?php endfor; ?>
                </SELECT>
                <?php if(isset($errors['end_date']) && $errors['end_date'] == 'blank'): ?>
                  <p style="color: red; font-size: 10px; margin-top: 2px;">日付を選択してください</p>
                <?php endif; ?>
              </div>
            </div>

            <!-- 確認ボタン -->
            <?php if (!empty($_REQUEST['reservation_id'])) { ; ?>
            <div class="form-group">
              <div class="col-md-12">
                <input type="submit" name="update" value="更新" id="confirm" class="btn btn-primary btn-mg">
              </div>
            </div>
            <?php } else {; ?>
            <div class="form-group">
              <div class="col-md-12">
                <input type="submit" name="date" value="確認へ" id="confirm" class="btn btn-primary btn-mg">
              </div>
            </div>
            <?php }; ?>
          </fieldset>
          </form>
        </div>
      </div>
  </div>
</body>
</html>

