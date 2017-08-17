<?php
session_start();
require_once('../config.php'); 
$namadep = $_POST['namadepartemen'];

$querycek = $pdo->prepare('SELECT * FROM departemen WHERE departemen = ?');
$querycek->bindValue(1, $namadep);
$querycek->execute();
$result = $querycek->fetchColumn();

$cekuser  = $pdo->prepare("SELECT * FROM user WHERE username = ?");
$cekuser->bindValue(1, $_SESSION['login_data']);
$cekuser->execute();
$hasil  = $cekuser->fetch(PDO::FETCH_ASSOC);

if(empty($namadep)){
	echo "ar";
}
elseif($result > 0){
	echo "depuse";
}else{
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	$query = $pdo->prepare("INSERT INTO departemen(departemen,pembuat) VALUES (?,?)");
	$query->bindValue(1, $namadep);
	$query->bindValue(2, $hasil['nama_lengkap']);
	if($query->execute()){
		echo "sukses";
	}else{
		print_r($pdo->errorInfo());
	}
}