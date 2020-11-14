<?php session_start();
$ua = $_SERVER['HTTP_USER_AGENT'];// ユーザエージェントを取得

function isSmartPhone($ua) {
  if((strpos($ua, 'iPhone') !== false) || (strpos($ua, 'iPod') !== false) ||(strpos($ua, 'Android') !== false)||(strpos($ua, 'iPad') !== false)) return true;  return false;
}
if(isSmartPhone($ua)){
}else{
header("Location: /");
exit();
}
 ?>
<!DOCTYPE HTML>
<html lang="ja">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>TextCloud</title> 
<style>
@font-face {
font-family: 'use-SourceHanSansJP';
  src: url('../font.ttf') format('truetype');
}
@font-face {
font-family: 'font2';
  src: url('../font.otf') format('opentype');
}
body{
overflow:scroll;
font-family: 'use-SourceHanSansJP';
 background:linear-gradient(45deg,#009999,#000066);

}
main{
max-height:100%;
min-height:100vh;
max-width:100%;
background:none;


     position: relative;

}
/* チャットレイアウト */
.chat-box {
    width: 100%;
    height: auto;
    overflow: hidden; /*floatの解除*/
    margin-bottom: 20px;
}
.chat-face {
    float: left;
    margin-right: -120px;
}
.chat-face img{
    border-radius: 30px;
    border: 1px solid #ccc;
    box-shadow: 0 0 4px #ddd;
}
.chat-area {
    width: 100%;
    float: right;
}
.chat-hukidashi {
    display: inline-block; /*コメントの文字数に合わせて可変*/
    padding: 15px 20px;
    margin-left: 120px;
    margin-top: 8px;
    /* border: 1px solid gray; ←削除 */
    border-radius: 10px;
    position: relative; /*追記*/
    background-color: #D9F0FF; /*追記*/
}
/* ↓追記↓ */
.chat-hukidashi:after {
    content: "";
    position: absolute;
    top: 50%; left: -10px;
    margin-top: -10px;
    display: block;
    width: 0px;
    height: 0px;
    border-style: solid;
    border-width: 10px 10px 10px 0;
    border-color: transparent #D9F0FF transparent transparent;
}
.someone {
    background-color: #BCF5A9;
}
.someone:after {
    border-color: transparent #BCF5A9 transparent transparent;
}
/* ↑追記↑ */body{

}
#loader-bg {
  display: none;
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0px;
  left: 0px;
 background:linear-gradient(45deg,#009999,#000066);

  z-index: 1;
}
#loader {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  width: 200px;
  height: 200px;
  margin-top: -100px;
  margin-left: -100px;
  text-align: center;
  color: #fff;
  z-index: 2;
font-family:font2;
}
#loader-bg2 {

  display: none;
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0px;
  left: 0px;
 background:linear-gradient(45deg,#009999,#000066);

  z-index: 1;
}
#loader2 {
  display: none;
  position: fixed;
margin:0 auto;
top:35%;
  width: 100%;
  height: 200px;

  text-align: center;
  color: #fff;
  z-index: 2;
font-family:font2;
}
.r{
background:none !important;
display:inline-block !important;
  border: 1px solid #eee;

}
.btn{
width:20%;
}
.button {
text-align:right;
  border: 1px solid #ccc;
position: fixed; /* フッターを固定する */
bottom: 0; /* 上部から配置の基準位置を決める */
left: 0; /* 左から配置の基準位置を決める */
background:rgba(50,50,255,0.6);
padding:10px; /* フッター内側の余白を指定する(上下左右) */
border-radius:20px;
}
#e{
 position: relative;
}
#is{
 position:absolute;
  top:0;
  right:0;
}


input{
color:#fff !important;
background:none;
}
input::placeholder {
  color: #fff !important;
}

/* IE */
input:-ms-input-placeholder {
  color: #fff !important;
}

/* Edge */
input::-ms-input-placeholder {
  color: #fff !important;
}
#head{
position: fixed; /* フッターを固定する */
top: 0; /* 上部から配置の基準位置を決める */
right: 0; /* 左から配置の基準位置を決める */
padding:10px; /* フッター内側の余白を指定する(上下左右) */
z-index:2;
}
</style>
<body>
<div id="loader-bg">
  <div id="loader">
<h1>TextCloud! Mobile</h1>
    <img src="/loading.gif" width="80" height="80" alt="Now Loading..." />
<p class="text-muted" style="font-lamily:serif ;">Made by point1reiya</p>
  </div>
</div>
<div id="loader-bg2">
  <div id="loader2">
<h1>TextCloud! Mobile</h1>
<a href="/twitter" class="btn btn-info">Twitterでログイン</a>
<p class="text-muted" style="font-lamily:serif ;">Made by point1reiya</p>
  </div>
</div>
<nav class="navbar navbar-light text-light" style="background:none;">

<img src="logo.png" width="300px" id="head">
</nav>
<main>




 <footer class="change-border01 button">
     <input class="form-control form-control-lg r effect-7 r et"type="text" id="et" placeholder="今何が起きてる?">
     <input class="form-control form-control-lg  btn r effect-7_e" id="send" style="display:inline;" type="button" value="Say!">
<span class="focus-border">
            	<i></i>
            </span>
    </footer>
</main>

<script src="https://code.jquery.com/jquery-1.12.2.min.js"></script>
<script type="text/javascript">

$(function() {
  var h = $(window).height();
 
  $('#contents').css('display','none');
  $('#loader-bg ,#loader').height(h).css('display','block');
});
 

 
//10秒たったら強制的にロード画面を非表示
$(function(){
  setTimeout('stopload()',1000);

});
 
function stopload(){
  $('#contents').css('display','block');
  $('#loader-bg').delay(900).fadeOut(800);
  $('#loader').delay(600).fadeOut(300);
}

// JavaScript for label effects only
	$(window).load(function(){
		$(".col-3 input").val("");
		
		$(".input-effect input").focusout(function(){
			if($(this).val() != ""){
				$(this).addClass("has-content");
			}else{
				$(this).removeClass("has-content");
			}
		})
	});
<?php
if(isset($_SESSION["user"])){

}else{
echo "
var h = $(window).height();
setTimeout(function(){
$('#contents').css('display','none');
  $('#loader-bg2 ,#loader2').height(h).css('display','block');
},1900);
";
}
?>
</script>
<script>

var tex2 = Math.round( Math.random()*1000);
var tex3 = Math.round( Math.random()*500);
if (tex2<10){
tex2 = tex2+10;
}
if (tex3<10){
tex3 = tex3+10;
}
var tex4 = Math.round( Math.random()*25+25);
  $.ajax('get.php',
      {
        type: 'get'
      }
    )
    // 検索成功時にはページに結果を反映
    .done(function(data) {
   $("main").prepend(data);
    })
    // 検索失敗時には、その旨をダイアログ表示
    .fail(function() {
$(".et").attr("placeholder","サーバーに接続できませんでした...");
    });
$(".a"+tex4).fadeOut(60000);

setInterval(function(){
var tex2 = Math.round( Math.random()*1000);
var tex3 = Math.round( Math.random()*500);
var tex4 = Math.round( Math.random()*25+25);
  $.ajax('get2.php',
      {
        type: 'get'
      }
    )
    // 検索成功時にはページに結果を反映
    .done(function(data) {
if(data=="51"){
$(".et").attr("placeholder","ログアウトされました");
}else{
   $("main").prepend(data);
$(".et").attr("placeholder","今何が起きてる?");
}
    })
    // 検索失敗時には、その旨をダイアログ表示
    .fail(function() {
$(".et").attr("placeholder","サーバーに接続できませんでした...");
    });

},1500);
$("#send").click(function(){
  $.ajax('/post.php',
      {
        type: 'post',
data: {"cont":$("#et").val()}
      }
    )
    // 検索成功時にはページに結果を反映
    .done(function(data) {

$("#et").attr("placeholder","投稿しました!");
    })
    // 検索失敗時には、その旨をダイアログ表示
    .fail(function() {
$("#et").attr("placeholder","サーバーに接続できませんでした...");
    });
$("#et").val("");
});
$(".a"+tex4).fadeOut(60000);
</script>

</body>

</html>