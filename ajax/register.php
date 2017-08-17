<?php
require_once('../config.php'); 
$id 		= $_POST['idanggota'];
$nama 		= $_POST['fullname'];
$dep 		= $_POST['departemen'];
$username	= $_POST['username'];
$password 	= $_POST['password'];


$querycek = $pdo->prepare('SELECT * FROM user WHERE username = ?');
$querycek->bindValue(1, $username);
$querycek->execute();
$result = $querycek->fetchColumn();
if(empty($id) || empty($nama) || empty($dep) || empty($username) || empty($password) ){
	echo "ar";
}elseif($result > 0){
	echo "useruse";
}else{
	$query = $pdo->prepare("INSERT INTO user(id_anggota, nama_lengkap, departemen, username, password) VALUES (?,?,?,?,?)");
	$query->bindValue(1, $id);
	$query->bindValue(2, $nama);
	$query->bindValue(3, $dep);
	$query->bindValue(4, $username);
	$query->bindValue(5, sha1($password));
	if($query->execute()){
		echo "sukses";
	}else{
		echo "gagal";
	}
}
 

 ?>
