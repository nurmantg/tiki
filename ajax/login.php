<?php
require_once('../config.php');
session_start();
$username	= $_POST['username'];
$password 	= $_POST['password'];

if(empty($username) || empty($password) ){
	echo "ar";
}else{
	$query = $pdo->prepare("SELECT * FROM user WHERE username = ?");
	$query->bindValue(1, $username);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);

	if($result['password'] == sha1($password)){
		$_SESSION['login_data'] = $username;
		echo "sukses";
	}
	else{
		echo "wrong";
	}
}
 

 ?>
