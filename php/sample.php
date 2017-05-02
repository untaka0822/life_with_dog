<?php
session_start();
require('dbconnect.php');
$_SESSION['user_id'] = 4;

$sql = 'SELECT * FROM `reservations` WHERE `client_id` = ?';
$data = array($_SESSION['user_id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

$sql = 'SELECT * FROM `reservations` WHERE `host_id` = ?';
$data = array($_SESSION['user_id']);
$re_stmt = $dbh->prepare($sql);
$re_stmt->execute($data);

// 回転補正
// orientationFixedImageの中でimagejpeg()が呼ばれているので、回転補正後の画像は書き出されている。
// その後、サムネールを作れるように、回転後のオブジェクトを戻すようにしてある。
$image = orientationFixedImage($targetFile, $targetFile);

if ($create_thumbnail) {
  // サムネール作成
  list($width, $height) = getimagesize($targetFile);
  $width_s = $width >= $height ? $thumbnail_pixels_max : $width * $thumbnail_pixels_max / $height;
  $height_s = $width >= $height ? $height * $thumbnail_pixels_max / $width : $thumbnail_pixels_max;
  $thumb = imagecreatetruecolor($width_s, $height_s);
  imagecopyresized($thumb, $image, 0, 0, 0, 0, $width_s, $height_s, $width, $height);
  imagejpeg($thumb, $thumbnailFile);
}

ini_set("display_errors", 0);
error_reporting(E_ALL ^ E_NOTICE);
umask(0);

$create_thumbnail = 1;
$thumbnail_pixels_max = 200;

$tempFile = $_FILES["photo"]["tmp_name"];
$targetFile = "/path/to/target.jpg";
$thumbnailFile= "/path/to/thumbnail.jpg";
move_uploaded_file($tempFile, $targetFile);

// 画像の方向を正す
function orientationFixedImage($output,$input){
  $image = ImageCreateFromJPEG($input);
  $exif_datas = @exif_read_data($input);
  if(isset($exif_datas['Orientation'])){
    $orientation = $exif_datas['Orientation'];
    if($image) {
      // 未定義
      if($orientation == 0) {

      // 通常
      }else if($orientation == 1) {

      // 左右反転
      }else if($orientation == 2) {
        $image = image_flop($image);
      // 180°回転
      }else if($orientation == 3) {
        $image = image_rotate($image, 180, 0);
      // 上下反転
      }else if($orientation == 4) {
        $image = image_flip($image);
      // 反時計回りに90°回転 上下反転
      }else if($orientation == 5) {
        $image = image_rotate($image, 90, 0);
        $image = image_flip($image);
      // 反時計回りに270°回転
      }else if($orientation == 6) {
        $image = image_rotate($image, 270, 0);
      // 反時計回りに270°回転 上下反転
      }else if($orientation == 7) {
        $image = image_rotate($image, 270, 0);
        $image = image_flip($image);
      // 反時計回りに90°回転
      }else if($orientation == 8) {
        $image = image_rotate($image, 90, 0);
      }
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

<?php while ($client = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
<?php $sql = 'SELECT * FROM `users` LEFT JOIN `dogs` ON users.user_id=dogs.user_id WHERE users.user_id = ?';
      $data = array($client['host_id']);
      $stmt2 = $dbh->prepare($sql);
      $stmt2->execute($data);
      $clients = $stmt2->fetch(PDO::FETCH_ASSOC); ?>
<?php echo '<pre>'; ?>
<?php var_dump($clients); ?>
<?php echo '</pre>'; ?>
<?php echo $clients['user_id']; ?>
<?php endwhile; ?>

<?php while ($host = $re_stmt->fetch(PDO::FETCH_ASSOC)): ?>
  <?php $sql = 'SELECT * FROM `users` WHERE `user_id`=?';
        $data = array($host['client_id']);
        $re_stmt2 = $dbh->prepare($sql);
        $re_stmt2->execute($data);
        $hosts = $re_stmt2->fetch(PDO::FETCH_ASSOC); ?>
<?php echo '<pre>'; ?>
<?php var_dump($hosts); ?>
<?php echo '</pre>'; ?>
<?php echo $hosts['user_id']; ?>
<?php endwhile; ?>



</body>
</html>