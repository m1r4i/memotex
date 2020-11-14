<?php
session_start();
 
define("Consumer_Key", "");
define("Consumer_Secret", "");
 
//ライブラリを読み込む
require "./src/twitteroauth-master/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
 
//oauth_tokenとoauth_verifierを取得
if($_SESSION['oauth_token'] == $_GET['oauth_token'] and $_GET['oauth_verifier']){
	
	//Twitterからアクセストークンを取得する
	$connection = new TwitterOAuth(Consumer_Key, Consumer_Secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$access_token = $connection->oauth('oauth/access_token', array('oauth_verifier' => $_GET['oauth_verifier'], 'oauth_token'=> $_GET['oauth_token']));
 
	//取得したアクセストークンでユーザ情報を取得
	$user_connection = new TwitterOAuth(Consumer_Key, Consumer_Secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$user_info = $user_connection->get('account/verify_credentials');	
	
	// ユーザ情報の展開
	//var_dump($user_info);
	
	//適当にユーザ情報を取得
	$id = $user_info->id;
	$name = $user_info->name;
	$screen_name = $user_info->screen_name;
	$profile_image_url_https = $user_info->profile_image_url_https;
	$text = $user_info->status->text;
	
	//各値をセッションに入れる
$_SESSION["user"] = $screen_name;
$_SESSION["id"] = $id;
$_SESSION["image"] = $profile_image_url_https;
	header("Location: /");
	exit();
}else{
	header("Location: /?e=1");
	exit();
}