<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Jakarta");
include('../config/koneksi.php');
isLoggedIn();

$last_login = date('Y-m-d H:i:s');
$user = $_POST['user'];
$pass = md5($_POST['pass']);
$pass = mysqli_real_escape_string($conn,$pass);
if (empty($user) && empty($pass)) {
    header('location:../?error=1');
    exit;
} else if (empty($user)) {
    header('location:../?error=2');
    exit;
} else if (empty($pass)) {
    header('location:../?error=3');
    exit;
} else if(isLoggedIn()){
    header('location:../dashboard/');
    exit;
}


$q = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '$user' AND pass = '$pass'") or die(mysqli_error($conn));
if (mysqli_num_rows($q) > 0) {
	$user_data = mysqli_fetch_array($q,MYSQLI_ASSOC);
	$token = insertToken($user_data['id']);
	$userID = $user_data['id'];
	$_SESSION['user'] = $user;
	$_SESSION['token'] = $token;
	if($user_data['level'] == 'reseller' || $user_data['level'] == 'vip' || $user_data['level'] == 'user'){
	    $_SESSION['user'] == '';
        unset($_SESSION['user']);
        session_destroy();
        header('location:../../login/');
	}
	else {
	    $update = mysqli_query($conn,"UPDATE `tb_user` SET last_login = '$last_login' WHERE user = '".$_SESSION['user']."'") or die(mysqli_error());
	    header('location:../dashboard/');
	}
	
} else {
    header('location:../?error=4');
}

function insertToken($user_id = 0){
    $conn = $GLOBALS['conn'];
	if(empty($user_id) && $user_id === 0){
		return false;
	}

	$token = generateToken();
	$sql_insert_token = "INSERT INTO tb_token (token) VALUES ('$token')";
	$query_insert_token = mysqli_query($conn,$sql_insert_token) or die(mysqli_error($conn));
    $token_id = mysqli_insert_id($conn);

	// update table user
	$sql_update_user = "UPDATE tb_user SET token_id = $token_id WHERE id = $user_id;";
	$query_update_user = mysqli_query($conn,$sql_update_user) or die(mysqli_error($conn));
	return $token;
}

function generateToken(){
	$length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

	$token = md5(microtime(true).$characters);
	return $token;
}

function isLoggedIn(){
	if(isset($_SESSION['user'])	&& $_SESSION['user'] != "" && isset($_SESSION['token']) && $_SESSION['token'] != ""){
		return true;
	}
	return false;
}
?>