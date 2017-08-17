<?php 
require_once('../config.php');
$depid = $_POST['iddepnya'];

$query = $pdo->prepare("DELETE FROM departemen WHERE id = ?");
$query->bindValue(1, $depid);
if($query->execute()){
	echo "sukses";
}else{
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	$arr = $pdo->errorInfo();
print_r($arr);
}


 ?>