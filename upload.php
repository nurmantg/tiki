<?php 
session_start();
if(!$_SESSION['login_data']){
  header('Location: login.php');
}
require_once("config.php");
$querydep = $pdo->prepare("SELECT * FROM departemen");
$querydep->execute();
$resultdep = $querydep->fetchAll();
$infouser = $pdo->prepare("SELECT * FROM user WHERE username =?");
$infouser->bindValue(1, $_SESSION['login_data']);
$infouser->execute();
$hasilnya = $infouser->fetch(PDO::FETCH_ASSOC);
if($hasilnya['admin'] == 1){
  $isadmin = 1;
}
date_default_timezone_set('Asia/Jakarta');
require_once("config.php");
if(isset($_POST['submit'])){
  $error = "";
  $nama   = $_POST['judul'];
  $dep    = $_POST['departemen'];
  $tanggal  = date("m/d/Y");
  $target   = "upload/";
  $namafile = $_FILES['filenya']['name'];
  $tmpfile  = $_FILES['filenya']['tmp_name'];
  $sizefile = $_FILES['filenya']['size'];
  $typefile = $_FILES['filenya']['type'];
  $extfile  = pathinfo($namafile,PATHINFO_EXTENSION);
  $cekuser  = $pdo->prepare("SELECT * FROM user WHERE username = ?");
  $cekuser->bindValue(1, $_SESSION['login_data']);
  $cekuser->execute();
  $hasil  = $cekuser->fetch(PDO::FETCH_ASSOC);

  if($extfile != "xls" && $extfile != "xlsx" && $extfile  != "pdf" && $extfile != "doc" && $extfile != "docx" && $extfile != "ppt" && $extfile != "pptx" && $extfile != "txt"){
    $error = "Extensi tidak diperbolehkan";
  }
  elseif ($sizefile > 10097152) {
    $error =  "Max 10mb";
  }else{
    $query = $pdo->prepare("INSERT INTO files(nama,ekstensi,byuser,tanggal,departemen,keperluan,url,size) VALUES (?,?,?,?,?,?,?,?)");
    $query->bindValue(1, $nama);
    $query->bindValue(2, $extfile);
    $query->bindValue(3, $hasil['nama_lengkap']);
    $query->bindValue(4, $tanggal);
    $query->bindValue(5, $dep);
    $query->bindValue(6, "upload");
    $query->bindValue(7, $target.$namafile);
    $query->bindValue(8, $sizefile);
    if($query->execute()){
      move_uploaded_file($tmpfile,$target.$namafile);
      $error =  "sukses";
    }
    else{
      $error =  "ERROR";
    }
    
  }
}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Creative - Bootstrap Admin Template</title>

    <link href="css/fileinput.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    
    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />    

    <!-- Custom styles -->
	<link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
	<link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
      
    <script src="js/sortable.js" type="text/javascript"></script>
    <script src="js/fileinput.js" type="text/javascript"></script>
    <script src="js/fr.js" type="text/javascript"></script>
    <script src="js/es.js" type="text/livescript"></script>  
    <script src="js/theme.js" type="text/javascript"></script>
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
      <header class="header dark-bg">
           
          <div class="row">
            <div class="col-md-2 logo-tiki">
                <img src="img/rsz_tiki-web-logo.png">  
            </div>
          </div>

            <div class="top-nav notification-row">                
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                    
                    <!-- task notificatoin start -->
                    <!-- task notificatoin end -->
                    <!-- inbox notificatoin start-->
                    
                    <!-- alert notification start-->
                    <li id="alert_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="icon-bell-l"></i>
                            <span class="badge bg-important">7</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-blue"></div>
                            <li>
                                <p class="blue">You have 4 new notifications</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-success"><i class="icon_like"></i></span> 
                                    Mick appreciated your work.
                                    <span class="small italic pull-right"> Today</span>
                                </a>
                            </li>                            
                            <li>
                                <a href="#">See all notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- alert notification end-->
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="img/avatar1_small.jpg">
                            </span>
                            <span class="username">Jenifer Smith</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li class="eborder-top">
                                <a href="#"><i class="icon_profile"></i> My Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="icon_clock_alt"></i> Timeline</a>
                            </li>
                            <li>
                                <a href="login.php"><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>      
      <!--header end-->

      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">                
                  <li>
                      <a class="parent-menu" href="index.php">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
				  <li class="sub-menu">
                      <a href="file.php" class="">
                          <i class=" icon_folder"></i>
                          <span>File</span>
                      </a>
                  </li>       
                  <li class="active">
                      <a href="upload.php" class="">
                          <i class=" icon_upload"></i>
                          <span>Upload Berkas</span>
                      </a>
                  </li>
                  <?php if(!$hasilnya['admin'] == 1){ ?>
                  
                  <?php }else{ ?>
                  <li class="sub-menu">
                      <a href="user.php" class="">
                          <i class=" icon_profile"></i>
                          <span>User</span>
                      </a>
                  </li>
                  <li>
                      <a href="departemen.php" class="">
                          <i class=" fa fa-university"></i>
                          <span>Departemen</span>
                      </a>
                  </li>
                  <?php } ?>
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Upload</h3>
					<ol class="breadcrumb">
						<li><i class="icon_house_alt"></i><a href="index.php">Dashboard</a></li>
						<li><i class="icon_upload"></i>Upload</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row">
			 <div class="col-md-12">
                    <section class="panel">
                        
                        <div class="panel-body">
                            <div class="form">
                                <form class="form-validate form-horizontal" enctype="multipart/form-data" id="uploadform" method="post">
                                  <div id="status">
                                    <?php
                                      if(isset($error)){
                                        ?>
                                          <div class="alert alert-info"><?php echo $error; ?></div>
                                    <?php
                                      }
                                    ?>
                                    
                                  </div>
                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">Judul Berkas</label>
                                        <div class="col-lg-8">
                                              <input class="form-control" id="cname" name="judul" minlength="5" type="text" required />
                                          </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="cname" class="control-label col-lg-2">Departement</label>
                                        <div class="col-lg-8">
                                        <select class="form-control" name="departemen">
                                            <outgroup label="Departement">
                                                <?php
                                                if ($hasilnya['admin'] == 1) {
                                                  foreach ($resultdep as $resultadmin) {
                                                    ?>
                                                    <option value="<?php echo $resultadmin['departemen']; ?>" selected>
                                                    <?php echo $resultadmin['departemen']; ?>
                                                </option>.
                                                <?php 
                                                  }
                                                }else{
                                               ?>
                                                <option value="<?php echo $hasilnya['departemen']; ?>" selected>
                                                    <?php echo $hasilnya['departemen']; ?>
                                                </option>
                                                <?php } ?>
                                            </outgroup>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="cname" class="control-label col-lg-2">File</label>
                                        <div class="col-lg-8">
                                            <input id="file-0d" name="filenya" class="file" type="file">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-1 col-md-offset-5">
                                            <button type="submit" name="submit" class="btn btn-default" id="uploadbtn" >
                                            Upload</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>	
			</div>
			
            
		  
		  
        
          </section>
       </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

    <!-- javascripts -->
    <script src="js/jquery.js"></script>
	<script src="js/jquery-ui-1.10.4.min.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <!-- bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <!--custome script for all page-->
    
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <!--<script>
      $(document).ready(function(){
        $('#uploadbtn').click(function(){
          var dataupload = $('#uploadform').serialize();
          var formData = new FormData(dataupload);
          $.ajax({
            type  : 'POST',
            url   : 'ajax/upload.php',
            data  : formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend  : function(){
              $('#uploadbtn').html("Processing . . .");
            },
            success     : function(response){
              if(response == 'sukses'){
                $("#status").attr('class', '');
                $('#status').addClass("alert alert-success");
                $('#status').html("Sukses Upload file :)");
                $('#uploadbtn').html('Upload');
              }
              else if(response == 'ext'){
                $("#status").attr('class', '');
                $('#status').addClass("alert alert-warning");
                $('#status').html("Ekstensi file dilarang");
                $('#uploadbtn').html('Upload');
              }
              else if(response == 'max'){
                $("#status").attr('class', '');
                $('#status').addClass("alert alert-warning");
                $('#status').html("Maximal uload file 10mb");
                $('#uploadbtn').html('Upload');
              }
              else{
                $("#status").attr('class', '');
                $('#status').addClass("alert alert-warning");
                $('#status').html(response);
                $('#uploadbtn').html('Upload');
              }
            }
          });  
          return false;
        });
        
      });
</script>!-->
      
  </body>
</html>
