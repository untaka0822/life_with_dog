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