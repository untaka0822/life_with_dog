<?php 
  session_start();
  require('dbconnect.php');
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/favorite_history.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/mypage.css">
  <title>気になる！一覧</title>

  <?php 
    require('mypage_header.php');
  ?>
    

  <br>
  <br>
  <br>
  
</head>
<body>

<?php
  require('mypage_sidebar.php');
?>

<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-6 col-lg-offset-2 centered">
                <h3>あなたが気になった人 (犬) 一覧</h3>
            </div>    
        </div>
        <div id="carousel-example-generic"  data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-sm-4 col-lg-offset-3 centered">
                            <div class="col-item">
                                <div class="photo">
                                    <a href="#">
                                      <img src="../assets/images/mypage-user.jpg"  width="350px"  height="260px" class="img-responsive" alt="a" />
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>吉田健伴</h5>
                                            <h5 class="price-text-color">ロン</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="hoge2">
                                           <!--  <i class="fa fa-shopping-cart"></i> -->
                                          <input type="submit" value="詳細へ！" id="hoge1"  class="btn btn-primary btn-xs hoge1">
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="../assets/images/mypage-user.jpg"  width="350px"  height="260px" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>吉田健伴</h5>
                                            <h5 class="price-text-color">ロン</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="hoge2">
                                           <!--  <i class="fa fa-shopping-cart"></i> -->
                                             <input type="submit" value="詳細へ！" id="hoge1"  class="btn btn-primary btn-xs hoge1">
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
               </div>
              </div>
             </div>
            </div>
           </div>
          </div>

    <div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-6 col-lg-offset-2 centered">
                <h3>
                    あなたのことを気になった人一覧</h3>
            </div>    
        </div>
        <div id="carousel-example-generic"  data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-sm-4 col-lg-offset-3 centered">
                            <div class="col-item">
                                <div class="photo">
                                    <a href="#">
                                      <img src="../assets/images/mypage-user.jpg"  width="350px"  height="260px" class="img-responsive" alt="a" />
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>吉田健伴</h5>
                                            <h5 class="price-text-color">ロン</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="hoge2">
                                           <!--  <i class="fa fa-shopping-cart"></i> -->
                                             <input type="submit" value="詳細へ！" id="hoge1"  class="btn btn-primary btn-xs hoge1">
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-4 ">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="../assets/images/mypage-user.jpg"  width="350px"  height="260px" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>吉田健伴</h5>
                                            <h5 class="price-text-color">ロン</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="hoge2">
                                           <!--  <i class="fa fa-shopping-cart"></i> -->
                                             <input type="submit" value="詳細へ！" id="hoge1"  class="btn btn-primary btn-xs hoge1">
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                   </div>
                                  </div>
                                 </div>

                               </div>
                              </div>
                             </div>
                            </div>
                           </div>
                          </div>
                         </div>
                        </div>

</body>
</html>
