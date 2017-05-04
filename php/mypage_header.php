<header class="navbar-fixed-top">
  <nav>
    <ul>
      <li class="title">
        <a href="top.php" style="font-size: 45px; font-family: 'Times New Roman',italic; position: relative;">
          Life <span style="font-size:30px;">with</span> Dog
        </a>
      </li>
      <li class="nav_list" style="font-family: 'EB Garamond', serif;">
        <a href="search_dog.php">
          体験したい人
        </a>
      </li>
      <li class="nav_list" style="font-family: 'EB Garamond', serif;">
        <a href="search.php">
          預けたい人
        </a>
      </li>
      <li class="nav_list" style="font-family: 'EB Garamond', serif;">
        <a href="index_dog.php">
          愛犬登録
        </a>
      </li>
      <li class="nav_list" style="font-family: 'EB Garamond', serif;">
        <div onclick="obj=document.getElementById('open').style; obj.display=(obj.display=='none')?'block':'none';">
              <a style="cursor:pointer;">マイページ</a>
            </div>

            <div id="open" style="display:none;clear:both; z-index: 1;">

              <div class="navbar navbar-default navbar-static-bottom" style="position: fixed; z-index: 1">
                    <p class="navbar-text pull-left" style=": center;">
                        <a href="mypage.php" target="_blank"> マイページ
                    </p>
                    <p class="navbar-text pull-left" style=": center;">
                        <a href="custom.php" target="_blank"> 自分の情報を編集する
                    </p>
                    <p class="navbar-text pull-left" style=": center;">
                        <a href="user_history.php" target="_blank"> 自分の利用履歴を見る
                    </p>
                    <p class="navbar-text pull-left" style=": center;">
                        <a href="favorite_history.php" target="_blank"> 自分の気になる！履歴を見る
                    </p>
                    <p class="navbar-text pull-left" style=": center;">
                        <a href="notice.php" target="_blank"> リクエスト一覧を見る
                    </p>
                    <p class="navbar-text pull-left" style=": center;">
                        <a href="sns_history.php" target="_blank"> やりとり履歴を見る
                    </p>
              </div>

            </div>
      </li>
      <li class="li-logout" style="font-family: 'EB Garamond', serif;">
        <a href="#">
          <div class="hd-logout">
            <a href="logout.php" style="color: white;">ログアウト</a>
          </div>
        </a>
      </li>
    </ul>
  </nav>
</header>