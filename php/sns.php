<?php
session_start();
require('dbconnect.php');

if (empty($_REQUEST['user_id'])) {
    header('Location: top.php');
    exit();
}
// var_dump($_POST['content']);
// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';

// if (isset($_SESSION['login_user_id'])) {
    // ログインユーザー情報
    $sql = 'SELECT * FROM `users` WHERE `user_id` = ?';
    $data = array($_SESSION['login_user_id']);
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

$sql = 'SELECT * FROM `reservations` WHERE `host_id` = ? OR `host_id` = ? AND `client_id` = ? OR `client_id` = ?';
$data = array($_SESSION['login_user_id'], $_SESSION['receiver_id'], $_SESSION['login_user_id'], $_SESSION['receiver_id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);
$reserver = $stmt->fetch(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($reserver);
// echo '</pre>';

if(!empty($_POST['send'])){
    if($_POST['content'] != ''){
        // DBへの登録処理
        $sql = 'INSERT INTO `messages` SET `message` = ?,
                                           `sender_id` = ?,
                                           `receiver_id` = ?,
                                           `created` = NOW()';

        $data = array($_POST['content'], $_SESSION['login_user_id'], $_SESSION['receiver_id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        header('Location: sns.php?user_id=' . $_REQUEST['user_id']);
        exit();
    }
}

$sql = 'SELECT * FROM `messages` WHERE `sender_id` = ? AND `receiver_id` = ? OR `sender_id` = ?  AND `receiver_id` = ?';
$data = array($_SESSION['login_user_id'], $_SESSION['receiver_id'], $_SESSION['receiver_id'], $_SESSION['login_user_id']);
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
// echo '<pre>';
// var_dump($messages);
// echo '</pre>';

// 自分自身
// $login_user

//チャット相手
// ログインユーザーのIDと一致しないほうのsender_idかreciver_idがチャット相手のid
if ($messages[0]['sender_id'] != $_SESSION['login_user_id']) {
    $receiver = $messages[0]['sender_id'];
}elseif ($messages[0]['receiver_id'] != $_SESSION['login_user_id']) {
    $receiver = $messages[0]['receiver_id'];
}

$sql = 'SELECT * FROM `users` WHERE `user_id` = ?';
$data = array($_SESSION['receiver_id']);
$stmt2 = $dbh->prepare($sql);
$stmt2->execute($data);
$receiver = $stmt2->fetch(PDO::FETCH_ASSOC);

// var_dump($receiver);
// var_dump($tests);
// echo '<br>' . '<br>';
// var_dump($tests2);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../assets/css/header.css">
<link rel="stylesheet" type="text/css" href="../assets/css/sns.css">
<header>
  <nav>

  <?php
    require('mypage_header.php');
  ?>
</header>
<div class="clear"></div>
  <title></title>
</head>
<body>
<span style="font-family: 'EB Garamond',serif;">
<div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <h2 class="page-header">チャット</h2>
      <div id="messages" style="overflow-y: auto; width: 100%; height: 500px;">
      <?php for ($i=0; $i < $cnt ; $i++): ?>
        <section class="comment-list">
          <!-- チャット相手からのメッセージ -->
          <?php if ($messages[$i]['sender_id'] != $_SESSION['login_user_id']) { ; ?>
            <article class="row">
              <div class="col-md-2 col-sm-2 hidden-xs">
                <figure class="thumbnail">
                  <img class="img-responsive" src="../img/users_picture/<?php echo $receiver['picture_path']; ?>" />
                </figure>
              </div>
              <div class="col-md-10 col-sm-10">
                <div class="panel panel-default arrow left">
                  <div class="panel-body">
                    <header class="text-left" style="background-color: white;font-stretch: ">
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
          <?php }elseif($messages[$i]['sender_id'] == $_SESSION['login_user_id']){; ?>
          <!-- 自分が送ったメッセージ -->
          <article class="row">
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow right">
                <div class="panel-body">
                  <header class="text-right" style="background-color: white;">
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
                <img class="img-responsive" src="../img/users_picture/<?php echo $login_user['picture_path']; ?>" />
              </figure>
            </div>
          </article>
          <?php }; ?>
        </section>
      <?php endfor; ?>
      </div>
        <form method="post" action="">
        <!-- <form method="post" action="sns_reservation.php"> -->
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
    <div class="col-md-2"></div>
  </span>
</body>
</html>