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

$db = new sqlite3("./unk/voices.db");
$sql = 'select * from voice order by id desc';
$res = $db->query($sql);
while( $row = $res->fetchArray() ) {

$r1 = rand(12,180);
$r2 = rand(12,500);

if($_SESSION["last"]==$row["id"]){
break;
}

if(stristr($row["text"],"@".$_SESSION["user"]." ")){
$row["text"] = str_replace("@".$_SESSION["user"]." ",'<a href="https://twitter.com/'.$_SESSION["user"].'">@'.$_SESSION["user"].' </a>',$row["text"]);
echo'
<audio src="pick.mp3" autoplay></audio>
<div class="block"  style="top:'.$r2.'px; left:'.$r1.'px;">
<div class="kaiwa"">
 <figure class="kaiwa-img-right">
   <img src="'.str_replace("http://","https://",$row["image"]).'" alt="no-img2″>
 <figcaption class="kaiwa-img-description">
'.$row["by"].'
 </figcaption>
 </figure>
 <div class="kaiwa-text-left" style="background:#00ff00;">
   <p class="kaiwa-text">
'.$row["text"].'<br><p class="numm">'.$row["date"].'</p>
   </p>
 </div>
</div>
</div>';
}else{
echo'<div class="block"  style="top:'.$r2.'px; left:'.$r1.'px;">
<div class="kaiwa"">
 <figure class="kaiwa-img-right">
   <img src="'.str_replace("http://","https://",$row["image"]).'" alt="no-img2″>
 <figcaption class="kaiwa-img-description">
'.$row["by"].'
 </figcaption>
 </figure>
 <div class="kaiwa-text-left">
   <p class="kaiwa-text">
'.$row["text"].'<br><p class="numm">'.$row["date"].'</p>
   </p>
 </div>
</div>
</div>';
}

$_SESSION["last"]=$row["id"];
break;
}
?>