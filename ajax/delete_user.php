<?php 
require_once('../config.php');
$userid = $_POST['idusernya'];

$query = $pdo->prepare("DELETE FROM user WHERE id = ?");
$query->bindValue(1, $userid);
if($query->execute()){
	echo "sukses";
}else{
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	$arr = $pdo->errorInfo();
print_r($arr);
}


 ?>