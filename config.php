<?php 
	try {
    $pdo = new PDO("mysql:host=localhost;dbname=tiki;","root","stundak123");
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>