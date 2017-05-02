<header>
 <nav>
   <ul>
     <li class="title">
       <a href="top.php" style="font-size: 45px; font-family: ‘Times New Roman’,italic;">
         Life <span style=“font-size:30px;“>with</span> Dog
       </a>
     </li>
     <li class="nav_list">
       <a href="search_dog.php">
         体験したい人
       </a>
     </li>
     <li class="nav_list">
       <a href="search.php">
         預けたい人
       </a>
     </li>
     <li class="nav_list">
       <a href="mypage.php">
         マイページ
       </a>
     </li>
     <li class="li-logout">
       <a href="#">
         <div class="hd-logout">
           ログアウト
         </div>
       </a>
     </li>
   </ul>
 </nav>

</header>
<div class="clear"></div>
<?php
 $file_name = getFileNameFromUri();
 if($file_name == 'index.php'):?>
