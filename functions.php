<?php 
// function 関数名(引数) {
//  処理
//  return 返り値;
// }
function getFileNameFromUri() {
  $uri_arr = explode('/', $_SERVER['REQUEST_URI']);
  $last = end($uri_arr);
  $file_name = explode('?', $last);
  $file_name = $file_name[0];
  return $file_name;
}

// 上記関数を元に引数に与えられたファイル名と$file_nameが一致するかどうかを判定し true or falseをreturnする関数isfileName()を作成しfooter.phpで実行する
?>