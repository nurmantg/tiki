<?php
session_start(); 
date_default_timezone_set('Asia/Jakarta');
require_once("../config.php");
$nama		= $_POST['judul'];
$dep		= $_POST['departemen'];
$tanggal 	= date("m/d/Y");
$target 	= "../upload/";
$namafile	= $_FILES['filenya']['name'];
$tmpfile	= $_FILES['filenya']['tmp_name'];
$sizefile	= $_FILES['filenya']['size'];
$typefile	= $_FILES['filenya']['type'];
$extfile	= pathinfo($namafile,PATHINFO_EXTENSION);
$cekuser	= $pdo->prepare("SELECT * FROM user WHERE username = ?");
$cekuser->bindValue(1, $_SESSION['login_data']);
$cekuser->execute();
$hasil  = $cekuser->fetch(PDO::FETCH_ASSOC);

if($extfile != "xls" && $extfile != "xlsx" && $extfile  != "pdf" && $extfile != "doc" && $extfile != "docx" && $extfile != "ppt" && $extfile != "pptx" && $extfile != "txt"){
	echo "ext";
}
if ($sizefile > 10097152) {
	echo "max";
}else{
	$query = $pdo->prepare("INSERT INTO files(nama,ekstensi,byuser,tanggal,departemen,keperluan,url) VALUES (?,?,?,?,?,?,?)");
	$query->bindValue(1, $nama);
	$query->bindValue(2, $extfile);
	$query->bindValue(3, $hasil['nama_lengkap']);
	$query->bindValue(4, $tanggal);
	$query->bindValue(5, $dep);
	$query->bindValue(6, "upload");
	$query->bindValue(7, $target.$namafile);
	if($query->execute()){
		move_uploaded_file($tmpfile,$target.$namafile);
		echo "sukses";
	}
	else{
		echo "ERROR";
	}
	
}


 ?>