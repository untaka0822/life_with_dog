$(document).ready(function(){ 
    $('#characterLeft').text('140 characters left');
    $('#message').keydown(function () {
        var max = 140;
        var len = $(this).val().length;
        if (len >= max) {
            $('#characterLeft').text('You have reached the limit');
            $('#characterLeft').addClass('red');
            $('#btnSubmit').addClass('disabled');            
        } 
        else {
            var ch = max - len;
            $('#characterLeft').text(ch + ' characters left');
            $('#btnSubmit').removeClass('disabled');
            $('#characterLeft').removeClass('red');            
        }
    });    
});

// 画像のプレビュー用js ↓

// documentと毎回書くのがだるいので$に置き換え
var $ = document; 
var $form = $.querySelector('form');// jQueryの $("form")相当

//jQueryの$(function() { 相当(ただし厳密には違う)
$.addEventListener('DOMContentLoaded', function() {
    //画像ファイルプレビュー表示
    //  jQueryの $('input[type="file"]')相当
    // addEventListenerは on("change", function(e){}) 相当
    $.querySelector('input[type="file"]').addEventListener('change', function(e) {
        var file = e.target.files[0],
               reader = new FileReader(),
               $preview =  $.querySelector(".preview"), // jQueryの $(".preview")相当
               t = this;

        // 画像ファイル以外の場合は何もしない
        if(file.type.indexOf("image") < 0){
          return false;
        }

        reader.onload = (function(file) {
          return function(e) {
             //jQueryの$preview.empty(); 相当
             while ($preview.firstChild) $preview.removeChild($preview.firstChild);

            // imgタグを作成
            var img = document.createElement( 'img' );
            img.setAttribute('src',  e.target.result);
            img.setAttribute('width', '150px');
            img.setAttribute('title',  file.name);
            // imgタグを$previeの中に追加
            $preview.appendChild(img);
          }; 
        })(file);

        reader.readAsDataURL(file);
    }); 
});