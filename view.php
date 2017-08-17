<?php 
session_start();
require_once('config.php');
if(!$_SESSION['login_data']){
  header('Location: login.php');
}

if(isset($_GET['file'])){
	$file = $_GET['file'];
	$query = $pdo->prepare("SELECT * FROM files WHERE url = ?");
	$query->bindValue(1, $file);
	$query->execute();
	$fetch = $query->fetch(PDO::FETCH_ASSOC);

	if($fetch['ekstensi'] == "pdf"){
		$filename = $file;
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="' . $filename . '"');
		header('Content-Transfer-Encoding: binary');
		header('Accept-Ranges: bytes');
		@readfile($file);
	}
	elseif($fetch['ekstensi'] == "ppt" || $fetch['ekstensi'] == "pptx"){
		?>
			<iframe src="http://docs.google.com/gview?url=http://www.domainname.com/presentation.ppt&embedded=true" style="width:550px; height:450px;" frameborder="0"></iframe>
		<?php
	}
	
}else{
	header('Location: login.php');
}


 ?>