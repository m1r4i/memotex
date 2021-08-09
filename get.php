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
$db = new sqlite3("./unk/voices.db");
$sql = 'select * from voice';
$res = $db->query($sql);
while( $row = $res->fetchArray() ) {
$r1 = rand(12,1000);
$r2 = rand(12,250);
if(stristr($row["text"],"@".$_SESSION["user"]." ")){
$row["text"] = str_replace("@".$_SESSION["user"]." ",'<a href="https://twitter.com/'.$_SESSION["user"].'">@'.$_SESSION["user"].' </a>',$row["text"]);
echo'<div class="block"  style="top:'.$r2.'px; left:'.$r1.'px;">
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
$i++;
$_SESSION["last"]=$row["id"];
if($I>24){
break;
}
}
?>
