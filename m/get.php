<?php
session_start();
if($_SESSION["user"]){

}else{
$r1 = rand(12,1000);
$r2 = rand(12,500);
echo '<div class="block"  style="top:'.$r2.'px; left:'.$r1.'px;"><div class="balloon6"><div class="faceicon"><img src="https://pbs.twimg.com/profile_images/1073563120117854208/6fIZosze_bigger.png"></div><div class="chatting"><div class="says"><p>ログインしてください<a href="./twitter">ログイン</a></p></div></div></div></div></div>';
exit();
}

$_SESSION["last"]="";
$db = new sqlite3("../unk/voices.db");
$sql = 'select * from voice order by id desc';
$res = $db->query($sql);
while( $row = $res->fetchArray() ) {
$r1 = rand(12,500);
$r2 = rand(12,180);
if(stristr($row["text"],"@".$_SESSION["user"]." ")){
$row["text"] = str_replace("@".$_SESSION["user"]." ",'<a href="https://twitter.com/'.$_SESSION["user"].'">@'.$_SESSION["user"].' </a>',$row["text"]);
echo'

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
echo '<div class="chat-box">
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
$i++;
$_SESSION["last"]=$row["id"];
if($i>24){
break;
}
}
?>