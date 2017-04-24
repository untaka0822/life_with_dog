<?php
//session_start();
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
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../assets/css/mypage.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
    <!-- http://bootsnipp.com/snippets/featured/flipkart-like-navbar -->
    <title>マイページ</title>
  <!-- mypage_header.php -->
    <?php  
      require('mypage_header.php');
    ?>
  <!-- mypage_header.php end -->
</head>
<body>

<br>
<br>
<br>

    <div id="wrapper">
    <!-- mypage_sidebar.php -->
        <?php
          require('mypage_sidebar.php');
        ?>
    <!-- mypage_sidebar.php -->
        <!-- Page content -->
        <div id="page-content-wrapper">
            <div class="page-content inset" data-spy="scroll" data-target="#spy">
                <div class="row">
  
                    <div class="col-md-12 well">
                        <legend>
                        <h3><?php echo $user['last_name']; ?> <?php echo $user['first_name']; ?></h3>
                        </legend>
                        <img src="../assets/images/<?php echo $user['picture_path']; ?>" style="width: 400px;">
                        <div class="col-md-6 col-lg-offset-6 centered navbar-text">
                            <p><?php echo $user['gender']; ?></p>
                            <p><?php echo $user['area_id']; ?></p>
                            <p><?php echo $user['area_detail']; ?></p>
                            <p><?php echo $user['postal_code']; ?></p>
                            <p><?php echo $user['phone_number']; ?></p>
                            <p><?php echo $user['email']; ?></p>
                            <p><a class="btn btn-info" href="custom.php">編集する</a></p>
                        </div>
                    </div>
    
                </div>
                <div class="row">
                    <div class="col-md-12 well">
                        <legend id="anch1"><?php echo $dog['name']; ?></legend>
                        <img src="../assets/images/<?php echo $dog['picture_path']; ?>" style="width: 400px">
                        <div class="col-md-6 col-lg-offset-5 centered navbar-text">
                        <p><?php echo $dog['gender']; ?></p>
                        <p><?php echo $dog['age']; ?></p>
                        <p><?php echo $dog['type']; ?></p>
                        <p><?php echo $dog['size_id']; ?></p>
                        <p><?php echo $dog['fleas']; ?></p>
                        <p><?php echo $dog['vaccin']; ?></p>
                        <p><?php echo $dog['spay_cast']; ?></p>
                        <p><?php echo $dog['character']; ?></p>
                        </div>
                    </div>
                    
                    <div class="col-md-12 well">
                        <legend id="anch1"><?php echo $dog['name']; ?></legend>
                        <img src="../assets/images/<?php echo $dog['picture_path']; ?>" style="width: 400px">
                        <div class="col-md-6 col-lg-offset-5 centered navbar-text">
                        <p><?php echo $dog['gender']; ?></p>
                        <p><?php echo $dog['age']; ?></p>
                        <p><?php echo $dog['type']; ?></p>
                        <p><?php echo $dog['size_id']; ?></p>
                        <p><?php echo $dog['fleas']; ?></p>
                        <p><?php echo $dog['vaccin']; ?></p>
                        <p><?php echo $dog['spay_cast']; ?></p>
                        <p><?php echo $dog['character']; ?></p>
                        </div>
                    </div>

                    <div class="col-md-12 well">
                        <legend id="anch1"><?php echo $dog['name']; ?></legend>
                        <img src="../assets/images/<?php echo $dog['picture_path']; ?>" style="width: 400px">
                        <div class="col-md-6 col-lg-offset-5 centered navbar-text">
                        <p><?php echo $dog['gender']; ?></p>
                        <p><?php echo $dog['age']; ?></p>
                        <p><?php echo $dog['type']; ?></p>
                        <p><?php echo $dog['size_id']; ?></p>
                        <p><?php echo $dog['fleas']; ?></p>
                        <p><?php echo $dog['vaccin']; ?></p>
                        <p><?php echo $dog['spay_cast']; ?></p>
                        <p><?php echo $dog['character']; ?></p>
                        </div>
                    </div>
                   
                </div>
            </div>

        </div>

    </div>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery-migrate.js"></script>
    <script src="../asstes/js/bootstrap.js"></script>
</body>
</html>