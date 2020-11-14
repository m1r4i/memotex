<?php session_start();
$ua = $_SERVER['HTTP_USER_AGENT'];// ユーザエージェントを取得

function isSmartPhone($ua) {
  if((strpos($ua, 'iPhone') !== false) || (strpos($ua, 'iPod') !== false) ||(strpos($ua, 'Android') !== false)||(strpos($ua, 'iPad') !== false)) return true;
  return false;
}
if(isSmartPhone($ua)){
header("Location: /m");
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
#contents{
width:75%;
height:80%;
}
@font-face {
font-family: 'use-SourceHanSansJP';
  src: url('font.ttf') format('truetype');
}
@font-face {
font-family: 'font2';
  src: url('font.otf') format('opentype');
}
body{
  font-family: "use-SourceHanSansJP";
}
/*以下、①背景色など*/
.line-bc {
  padding: 20px 10px;
  max-width: 450px;
  margin: 15px auto;
  text-align: right;
  font-size: 14px;
  background: #7da4cd;

}

/*以下、②左側のコメント*/
.balloon6 {
    width: 100%;
    margin: 10px 0;
    overflow: hidden;
}

.balloon6 .faceicon {
    float: left;
    margin-right: -50px;
    width: 40px;
}

.balloon6 .faceicon img{
    width: 100%;
    height: auto;
    border-radius: 50%;
}
.balloon6 .chatting {
    width: 100%;
    text-align: left;
}
.says {
    display: inline-block;
    position: relative; 
    margin: 0 0 0 50px;
    padding: 10px;
    max-width: 250px;
    border-radius: 12px;
    background: #edf1ee;
}

.says:after {
    content: "";
    display: inline-block;
    position: absolute;
    top: 3px; 
    left: -19px;
    border: 8px solid transparent;
    border-right: 18px solid #edf1ee;
    -ms-transform: rotate(35deg);
    -webkit-transform: rotate(35deg);
    transform: rotate(35deg);
}
.says p {
    margin: 0;
    padding: 0;
}

/*以下、③右側の緑コメント*/
.mycomment {
    margin: 10px 0;
}
.mycomment p{
    display: inline-block;
    position: relative; 
    margin: 0 10px 0 0;
    padding: 8px;
    max-width: 250px;
    border-radius: 12px;
    background: #30e852;
    font-size: 15px:
}

.mycomment p:after {
    content: "";
    position: absolute;
    top: 3px; 
    right: -19px;
    border: 8px solid transparent;
    border-left: 18px solid #30e852;
    -ms-transform: rotate(-35deg);
    -webkit-transform: rotate(-35deg);
    transform: rotate(-35deg);
}
#contents {
	position: relative;

flex: 1;

}
.block {
	position: absolute;

}
body {
background: #00008b; /* Old browsers */
background: -moz-linear-gradient(top, #00008b 0%, #63accc 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, #00008b 0%,#63accc 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, #00008b 0%,#63accc 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00008b', endColorstr='#63accc',GradientType=0 ); /* IE6-9 */
display: flex;
flex-flow: column;
min-height: 100vh;

}
#footer{
　　width: 100% !important;
　　height: 100px  !important;
　　position: fixed  !important;
　　bottom: 0  !important;
left:0  !important;
}
 #modal .inner {
  position:absolute;
  z-index:11;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
}
#modal {
  position:absolute;
  width:100%;
  height:100vh;
  top:0;
  left:0;
  display:none;
}
#e{
 position: relative;
}
#is{
 position:absolute;
  top:0;
  right:0;
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
  border: 1px solid #ccc;
width:100%;
display: flex;
border-radius:20px;
}
.*{
overflow:hidden !important;
}

input{
color:#fff !important;
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
/* 全体のスタイル */
.kaiwa {
  margin-bottom: 25px;
background-color:rgba(0,0,0,0.4);
border-radius:25%;
padding:15px;
color:#fff;
}
/* 左画像 */
.kaiwa-img-left {
  margin: 0;
  float: left;
  width: 60px;
  height: 60px;
  margin-right: -70px;
}
/* 右画像 */
.kaiwa-img-right {
  margin: 0;
  float: right;
  width: 60px;
  height: 60px;
  margin-left: -70px;
}
.kaiwa figure img {
  width: 100%;
  height: 100%;
  border: 1px solid #aaa;
  border-radius: 50%;
  margin: 0;
}
/* 画像の下のテキスト */
.kaiwa-img-description {
  padding: 5px 0 0;
  font-size: 10px;
  text-align: center;
  position: relative;
  bottom: 15px;
color:#fff !important;
}
/* 左からの吹き出しテキスト */
.kaiwa-text-right {
  position: relative;
  margin-left: 80px;
  padding: 10px;
  border-radius: 10px;
  background: #eee;
  margin-right: 12%;
  float: left;
}
/* 右からの吹き出しテキスト */
.kaiwa-text-left {
  position: relative;
  margin-right: 80px;
  padding: 10px;
  border-radius: 10px;
  background-color: #9cd6e7;
  margin-left: 12%;
  float: right;
color:#000;
}
a{
color:#0044ff !important;
}
p.kaiwa-text {
  margin: 0 0 20px;
}
p.kaiwa-text:last-child {
  margin-bottom: 0;
}
/* 左の三角形を作る */
.kaiwa-text-right:before {
  position: absolute;
  content: '';
  border: 10px solid transparent;
  top: 15px;
  left: -20px;
}
.kaiwa-text-right:after {
  position: absolute;
  content: '';
  border: 10px solid transparent;
  border-right: 10px solid #eee;
  top: 15px;
  left: -19px;
}
/* 右の三角形を作る */
.kaiwa-text-left:before {
  position: absolute;
  content: '';
  border: 10px solid transparent;
  top: 15px;
  right: -20px;
}
.kaiwa-text-left:after {
  position: absolute;
  content: '';
  border: 10px solid transparent;
  border-left: 10px solid #9cd6e7;
  top: 15px;
  right: -19px;
}
/* 回り込み解除 */
.kaiwa:after,.kaiwa:before {
  clear: both;
  content: "";
  display: block;
}
.numm{
color:#111;
font-size:12px;
display:inline;
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
#head{
position: fixed; /* ヘッダーを固定する */
top: 0; /* 上部から配置の基準位置を決める */
right: 0; /* 左から配置の基準位置を決める */
z-index:100;
}
</style>
<link rel="stylesheet" type="text/css" href="css/input-style.css">
<body>
<nav class="navbar navbar-light text-light" style="background:none;">

<img src="logo.png" width="300px" id="head">

</nav>
<div id="loader-bg">
  <div id="loader">
<h1>TextCloud!</h1>
    <img src="loading.gif" width="80" height="80" alt="Now Loading..." />
<p class="text-muted" style="font-lamily:serif ;">NotifySound by <a href="https://pocket-se.info/">https://pocket-se.info/</a></p>
  </div>
</div>
<div id="loader-bg2">
  <div id="loader2">
<h1>TextCloud!</h1>
<a href="./twitter" class="btn btn-info">Twitterでログイン</a>
<p class="text-muted" style="font-lamily:serif ;">NotifySound by <a href="https://pocket-se.info/">https://pocket-se.info/</a></p>
  </div>
</div>

<div id="contents">

	</div>


 <footer class="change-border01 button">
     <input class="form-control form-control-lg r effect-7 r et"type="text" id="et" placeholder="今何が起きてる?">
     <input class="form-control form-control-lg  btn r effect-7_e" id="send" style="display:inline;" type="button" value="Say!">
<span class="focus-border">
            	<i></i>
            </span>
    </footer>


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
$(function(){

    var text_max = 280; // 最大入力値
    $(".count").text(text_max - $("#introduction").val().length);

    $("#et").on("keydown keyup keypress change",function(){
        var text_length = $(this).val().length;
        var countdown = text_max - text_length;
        $(".count").text(countdown);
        // CSSは任意で
        if(countdown < 0){
            $('.count').css({
                color:'#ff0000',
                fontWeight:'bold'
            });
$("#send").prop('disabled', true);
        } else {
            $('.count').css({
                color:'#000000',
                fontWeight:'normal'
            });
$("#send").prop('disabled', false);
        }
    });
});
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
   $("#contents").append('<div class="a'+tex4+'">'+data+"</div>");
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
   $("#contents").append('<div class="a'+tex4+'">'+data+"</div>");
$(".et").attr("placeholder","今何が起きてる?");
}
    })
    // 検索失敗時には、その旨をダイアログ表示
    .fail(function() {
$(".et").attr("placeholder","サーバーに接続できませんでした...");
    });

},1500);
$("#send").click(function(){
  $.ajax('post.php',
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