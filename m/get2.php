<?php
session_start();
if($_SESSION["user"]){

}else{
$r1 = rand(12,1000);
$r2 = rand(12,500);
echo '51';
exit();
}
$ua = $_SERVER['HTTP_USER_AGENT'];// ユーザエージェントを取得

function isSmartPhone($ua) {
  if((strpos($ua, 'iPhone') !== false) || (strpos($ua, 'iPod') !== false) ||(strpos($ua, 'Android') !== false)) return true;
  return false;
}

$db = new sqlite3("../unk/voices.db");
$sql = 'select * from voice order by id desc';
$res = $db->query($sql);
while( $row = $res->fetchArray() ) {

$r1 = rand(12,180);
$r2 = rand(12,1000);

if($_SESSION["last"]==$row["id"]){
break;
}

if(stristr($row["text"],"@".$_SESSION["user"]." ")){
$row["text"] = str_replace("@".$_SESSION["user"]." ",'<a href="https://twitter.com/'.$_SESSION["user"].'">@'.$_SESSION["user"].' </a>',$row["text"]);
echo'
<audio src="/pick.mp3" autoplay></audio>
<div class="chat-box">
  <div class="chat-face">
    <img src="'.str_replace("http://","https://",$row["image"]).'" alt="誰かのチャット画像です。" width="90" height="90">
  </div>
  <div class="chat-area">
    <div class="chat-hukidashi">
'.$row["text"].'<br><p class="numm">'.$row["date"].'</p>投稿者: '.$row["by"].'
    </div>
  </div>
</div>';
}else{
echo'<div class="chat-box">
  <div class="chat-face">
    <img src="'.str_replace("http://","https://",$row["image"]).'" alt="誰かのチャット画像です。" width="90" height="90">
  </div>
  <div class="chat-area">
    <div class="chat-hukidashi someone">
'.$row["text"].'<br><p class="numm">'.$row["date"].'</p>投稿者: '.$row["by"].'
    </div>
  </div>
</div>';
}

$_SESSION["last"]=$row["id"];
break;
}
?>