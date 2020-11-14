<?php
session_start();
if($_SESSION["user"]){
if($_SESSION["id"]){
$db = new sqlite3("./unk/voices.db");
$id = $_SESSION["id"];
$user = $_SESSION["user"];
$content = $_POST["cont"];
function addslashes_mssql($x) {
    return str_replace("'", "''", $x);
}
$time = date("Y/n/j G:i:s");
$sql = 'insert into voice(by,text,date,image,user_id) values("'.$user.'","'.htmlspecialchars(addslashes_mssql($content)).'","'.$time.'","'.$_SESSION["image"].'","'.$_SESSION["id"].'");';
$db->query($sql);
}else{
http_response_code(418);
exit();
}
}else{
$r1 = rand(12,1000);
$r2 = rand(12,500);
http_response_code(418);
exit();
}
