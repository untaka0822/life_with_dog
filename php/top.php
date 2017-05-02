<?php 
session_start();
require('dbconnect.php');

// ログイン判定プログラム
if (isset($_SESSION['login_user_id']) && $_SESSION['time']+ 3600 > time()) {
	$_SESSION['time'] = time();
	$sql = 'SELECT * FROM `users` WHERE `user_id`=? ';
	$data = array($_SESSION['login_user_id']);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$login_user = $stmt->fetch(PDO::FETCH_ASSOC);

}else{
		// ログインしていない場合
		header('Location: login.php');
		exit();
}

 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="../assets/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../assets/css/header.css">
<!-- Custom styles for this template -->
<link href="../assets/css/top.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=EB+Garamond' rel='stylesheet' type='text/css'>
<script type="text/javascript">
$(function(){
    $("#tabMenu li a").on("click", function() {
        $("#tabBoxes div").hide();
        $($(this).attr("href")).fadeToggle();
    });
    return false;
});
</script>
<title>MINIMAL - Free Bootstrap 3 Theme</title>
<header>
  <?php
      require('mypage_header.php');
  ?>
</header>
<div class="clear"></div>
</head>
<body data-spy="scroll" data-offset="0" data-target="#theMenu">
<section id="home" name="home"></section>
<div id="headerwrap">
	<div class="container top-content"><br>
		<div class="row">
			<h1>Life with Dog</h1>
			<br>
			<h2>〜犬と共に〜</h2>
			<br>
			<br>
		<div class="col-lg-6 col-lg-offset-3"></div>
	</div>
 </div><!-- /container -->
</div><!-- /headerwrap -->
<section id="about" name="about"></section>
<div id="f">
	<div class="container">
		<div class="row">
			<h3>利用方法</h3>
			<div class="howtouse">
				<ul id="tabMenu" class="clearfix">
  					<li>
              STEP1
              <ul id="tabinner">
                <li><span class="glyphicon glyphicon-search" style="transform: rotate(90deg); margin-top:10px; margin-bottom:10px;"></span></li>
                <li><h3 style="margin:0; color:#555; margin-bottom:10px;">探す</h3></li>
                <li><h5 style="margin-top:5px; line-height:1.5;">犬のいる生活を<br>体験しよう</h5></li>
              </ul>
            </li>
 						<li class="text-align:center;">
              STEP2
              <ul id="tabinner">
                <li><span class="glyphicon glyphicon-calendar" style="margin-top:10px; margin-bottom:10px;"></span></li>
                <li><h3 style="margin:0; color:#555; margin-bottom:10px;">予約</h3></li>
                <li><h5 style="margin-top:5px; line-height:1.5;">ホストと<br>コンタクトをとる</h5></li>
              </ul>
            </li>
  					<li>
              STEP3
              <ul id="tabinner">
                <li><span class="glyphicon glyphicon-home" style="margin-top:10px; margin-bottom:10px;"></span></li>
                <li><h3 style="margin:0; color:#555; margin-bottom:10px;">体験</h3></li>
                <li><h5 style="margin-top:5px; line-height:1.5;">犬を迎える</h5></li>
              </ul>
            </li>
				</ul>
			</div>
		</div>
	</div><!-- /container -->
</div><!-- /f -->
<section id="portfolio" name="portfolio"></section>
<div id="f">
	<div class="container">
		<div class="row centered">
			<div class="container">
				<div class="row">
					<h4 class="hoge">こんな方が利用しています</h4><br>	
				</div>
			</div>
			<div class="carousel-reviews broun-block">
 				<div class="container">
     			<div class="row">
         		<div id="carousel-reviews" class="carousel slide" ata-ride="carousel">
              <div class="carousel-inner">
                <div class="item active">
              		<div class="col-md-4 col-sm-6">
      				  		<div class="block-text rel zmin">
					      			<p>体験した方の声</p>
					      			<div style="height: 364px;">
					      				<p>子供に犬を飼いたいと言われ検討をしてはいますが、幼い子供達が犬と生活すること対して不安がありました。<br>一度犬と生活する雰囲気を体験させてみたいと思いこのサービスを利用しました。犬が大好きな娘に反して息子は恐怖心がありましたが、時間を共にするにつれて慣れてきたようで、わんちゃんとお別れするのを寂しがっていました。<br>「新しく迎えるわんちゃんとも仲良くなれる気がする！」と息子が言ってくれたので家族全員の意思統一ができました。</p>
					    				</div>
						    			<ins class="ab zmin sprite sprite-i-triangle block"></ins>
				      			</div>
						  			<div class="person-text rel">
			          			<p class="thumbnail"><img class="img-circle" src="../assets/images/use-image1.JPG" alt=""></p>
							  			<p>埼玉県在住　野中さん</p>
										</div>
									</div>
          				<div class="col-md-4 col-sm-6 hidden-xs">
					    			<div class="block-text rel zmin">
					        		<p>愛犬を預けた方の声</p>
					        		<div style="height: 364px;">
					        			<p>私は愛犬家です。犬との日々はとても幸せを感じます。全ての犬が愛されて欲しいと願っています。<br>犬のために何か私にも出来ることはないかと考えていたところ、人と犬との出会いのお手伝いができるLife with Dogを見つけました。<br>体験者様にも新たな気付きがあり、私たち家族もペットホテル代わりに利用できるのでとても便利なサービスだと感じています。通常動物をペットホテルに預けた場合、長時間狭いゲージに入ることになりますがその不安も解消されました。</p>
					      			</div>
				         	 		<ins class="ab zmin sprite sprite-i-triangle block"></ins>
			          		</div>
						     		<div class="person-text rel">
			            		<p class="thumbnail"><img class="img-circle" src="../assets/images/use-image2.JPG" alt=""></p>
					        		<p>京都府在住　高橋さん</p>
										</div>
					 				</div>
									<div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
										<div class="block-text rel zmin">
											<p>体験した方の声</p>
											<div style="height: 364px;">
  											<p>以前、小型犬を飼っていました。新しく迎える犬種について家族と相談した結果、ゴールデンレトリバーを迎えたい！となりました。ですが、間取りの狭い室内で大型犬を飼うことに不安がありました。<br>実際に体験してみて、やはりゴールデンレトリバーにとっては窮屈な環境でストレスを感じてしまうのではないかと思い、検討し直すことにしました。私たちは犬が快適に暮らせる環境を整える必要があると改めて感じました。</p>
  										</div>
											<ins class="ab zmin sprite sprite-i-triangle block"></ins>
						  			</div>
										<div class="person-text rel">
							      	<p class="thumbnail"><img class="img-circle" src="../assets/images/top-image3.JPG" alt=""></p>
							    	  <p>千葉県在住　武石さん</p>
										</div>
									</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
		</div><!-- row -->
	</div><!-- container -->
</div>	<!-- f -->
<!-- Bootstrap core JavaScript -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="../assets/js/jquery-3.1.1.js"></script>
<script src="../assets/js/jquery-migrate-1.4.1.js"></script>
<script src="../assets/js/classie.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/smoothscroll.js"></script>
<script src="../assets/js/main.js"></script>

			</div><!-- row -->
		</div><!-- container -->
	</div>	<!-- f -->
  <!-- Bootstrap core JavaScript -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../assets/js/jquery-3.1.1.js"></script>
  <script src="../assets/js/jquery-migrate-1.4.1.js"></script>
	<script src="../assets/js/classie.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/smoothscroll.js"></script>
	<script src="../assets/js/main.js"></script>

	<footer>
		<div id="copyright">
			<div class="teamname" id="inline-copyright">
	    Team B
	  	</div>
		</div>
	</footer>

<script src="../assets/js/jquery-3.1.1.js"></script>
<script src="../assets/js/jquery-migrate-1.4.1.js"></script>
<script src="../assets/js/classie.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/smoothscroll.js"></script>
<script src="../assets/js/main.js"></script>

</body>
</html>
