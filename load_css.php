<!-- CSSの読み込み -->
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="header.css">

  <!-- URIで判定する -->
  <!-- http://ドメイン名/パス -->
  <!-- パス部分のみ = URI -->
  <!-- URIのファイル名部分を取得して、ページごとで処理を分ける -->
  <!-- $_SERVER は、ヘッダー、パス、スクリプトの位置のような 情報を有する配列です。この配列のエントリは、Web サーバーにより 生成されます。全ての Web サーバーがこれら全てを提供する保障はありません -->
  <?php
  if (empty($_SERVER['HTTPS'])) {
      echo 'http://';
  } else {
      echo 'https://';
  }

   echo '<br>';
   echo $_SERVER['HTTP_HOST'];
   echo '<br>';
   echo $_SERVER['REQUEST_URI'];
   echo '<br>';
   // URIの最後にあるファイル名のみ取得
   $uri_arr = explode('/', $_SERVER['REQUEST_URI']);
   echo '<pre>';
   var_dump($uri_arr);
   echo '</pre>';
   $last = end($uri_arr);
   echo $last;
   echo '<br>';

   $file_name = explode('?', $last);
   $file_name = $file_name[0];
   echo $file_name;
   echo '<br>';
   // パラメータが存在する場合 ?より後ろのこと
   // どこにでも使用できるよう関数化
  ?>

  <?php if($file_name == 'index.php'): ?>
    ほげ<br>
  <link rel="stylesheet" type="text/css" href="top.css">
  <?php endif; ?>