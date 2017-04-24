<?php
session_start();
require('dbconnect.php');
$me = 1;
$you = 2;
$start_date = '';
$end_date = '';
// HTMLにお問い合わせホームを作成
// エラー処理($error)、エラーが無ければ確認画面へ
// insert文を準備する
$errors = array();

if (!empty($_POST)) {
    if ($_POST['start_year'] == 0  ||  $_POST['start_month'] == 0  ||  $_POST['start_date']== 0  || $_POST['end_year'] == 0 || $_POST['end_month'] == 0 || $_POST['end_date'] == 0) {
          $errors['start_date'] = 'blank';
          $errors['end_date'] = 'blank';
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

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
  <title></title>
</head>
<body>

<!-- 予約フォーム -->
  <div class="col-md-4">
        <div class="well well-sm">
          <form class="form-horizontal" action="sns_reservation.php" method="post">
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
            <div class="form-group">
              <div class="col-md-12">
                <input type="submit" name="date" value="確認へ" id="confirm" class="btn btn-primary btn-mg">
              </div>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
  </div>
</body>
</html>