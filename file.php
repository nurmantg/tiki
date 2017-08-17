<?php
session_start();
if(!$_SESSION['login_data']){
  header('Location: login.php');
}
require_once('config.php');
$querydep = $pdo->prepare("SELECT * FROM departemen");
$querydep->execute();
$resultdep = $querydep->fetchAll();
$infouser = $pdo->prepare("SELECT * FROM user WHERE username =?");
$infouser->bindValue(1, $_SESSION['login_data']);
$infouser->execute();
$hasilnya = $infouser->fetch(PDO::FETCH_ASSOC);

if(isset($_GET['namafile'])){
  $nama = $_GET['namafile'];
  $dep  = $_GET['departemen'];
  $ekstensi = $_GET['ekstensi'];


  $query = $pdo->prepare("SELECT * FROM files WHERE nama LIKE ? AND departemen LIKE ? ");
  $query->bindValue(1, $nama."%");
  $query->bindValue(2, $dep. "%");
  $query->execute();
  $result = $query->fetchAll();
}else{
  $query = $pdo->prepare("SELECT * FROM files");
  $query->execute();
  $result = $query->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Tiki Admin</title>

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
				  <li class="active">
                      <a href="file.php" class="">
                          <i class=" icon_folder"></i>
                          <span>File</span>
                      </a>
                  </li>       
                  <li class="sub-menu">
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-laptop"></i>Dashboard</li>						  	
					</ol>
				</div>
			</div>
              
           
		  
		  <div class="row">
                <!-- Modal -->
      <div id="modaldelete" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
              <p id="status">Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
              <form method="POST" id="formdel">
              <input type="hidden" id="delfileid" name="idfilenya">
              <button type="button" class="btn btn-danger" id="btndel">Delete</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </form>
              
            </div>
          </div>

        </div>
      </div>
                  <div class="col-lg-12 box-search">
                    <form class="form-validate form-horizontal" id="feedback_form" method="get" action="">
                        <div class="form-group">
                            <label for="cname" class="control-label col-lg-2">Judul Berkas</label>
                            <div class="col-lg-8">
                                <input class="form-control" id="cname" name="namafile" minlength="5" type="text" required />
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
                            <div class="col-md-offset-4">
                            <label class="checkbox-inline"><input type="checkbox" name="ekstensi[]" value="pdf">PDF</label>
                            <label class="checkbox-inline"><input type="checkbox" name="ekstensi[]" value="doc">DOC</label>
                            <label class="checkbox-inline"><input type="checkbox" name="ekstensi[]" value="xls">XLS</label>
                            <label class="checkbox-inline"><input type="checkbox" name="ekstensi[]" value="txt">TXT</label>
                            <label class="checkbox-inline"><input type="checkbox" name="ekstensi[]" value="ppt">PPT</label>
                            </div>
                        </div>
                        <div class="form-group">
                                        <div class="col-lg-1 col-md-offset-5">
                                            <button class="btn btn-default" type="submit">
                                            Search</button>
                                        </div>
                                    </div>
                    </form>
                  </div>
                  <div class="col-lg-12">
                      <!--Project Activity start-->
                      <section class="panel">
                                  <table class="table table-header personal-header">
                                    <tbody>
                                        <tr>
                                            <td>Nama File</td>
                                            <td>User</td>
                                            <td>Size</td>
                                            <td>Option</td>
                                        </tr>
                                    </tbody>
                                  </table>         
                          <table class="table table-hover personal-task">
                              <tbody>
                              <?php foreach ($result as $hasil ) {
                                if($hasilnya['admin'] == 0){
                                  if($hasil['departemen'] != $hasilnya['departemen'] ){
                                  continue;
                                  }
                                }
                                
                                
                                $ukuran = $hasil['size'];
                                $final  = "";
                                if ($ukuran >= 1073741824)
                                {
                                    $final = number_format($ukuran / 1073741824, 2) . ' GB';
                                }
                                elseif ($ukuran >= 1048576)
                                {
                                    $final = number_format($ukuran / 1048576, 2) . ' MB';
                                }
                                elseif ($ukuran >= 1024)
                                {
                                    $final = number_format($ukuran / 1024, 2) . ' KB';
                                }
                                elseif ($ukuran > 1)
                                {
                                    $final = $ukuran . ' bytes';
                                }
                                elseif ($ukuran == 1)
                                {
                                    $final = $ukuran . ' byte';
                                }
                                else
                                {
                                    $final = '0 bytes';
                                }
                              ?>
                              <tr id="tr<?php echo $hasil['id']; ?>">
                                  <td>
                                      <?php echo $hasil['nama']; ?></td>
                                  <td><a href="#"><?php echo $hasil['byuser']; ?></a></td>
                                  <td class="td-size">
                                      <?php echo $final; ?>
                                  </td>
                                  <td class="td-option">
                                      <span>
                                          <a href="<?php echo $hasil['url']; ?>"><button type="submit" class="btn btn-default ">Download</button></a>
                                      </span>
                                      <span>
                                        <a href="view.php?file=<?php echo $hasil['url']; ?>"><button type="submit" class="btn btn-default">
                                            View  
                                        </button></a>
                                      </span>
                                      <span>
                                        <?php 
                                          if($hasilnya['admin'] == 1){
                                        ?>
                                        <button type="submit" id="btndelete" data-toggle="modal" data-target="#modaldelete" data-id="<?php echo $hasil['id']; ?>" class="btn btn-default" >Delete</button>
                                      </span>
                                      <?php } ?>
                                  </td>
                              </tr>
                              <?php } ?>
                              </tbody>
                          </table>

                      </section>
                  </div>
              </div>
          </section>
          </section>
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
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/scripts.js"></script>
   <script>

        $('.td-option button').click(function(){
          dataid = $(this).attr('data-id'); 
           $('#status').html("Are You sure want to delete it?");
           $('#btndel').show();
        });
        $('#modaldelete').on('show.bs.modal', function (e) {
          $(this).find('#delfileid').val(dataid);
        });
        var datas = $('#formdel');
        $('#btndel').click(function(){
          $.ajax({
            type  : 'POST',
            url   : 'ajax/delete_file.php',
            data  : datas.serialize(),
            beforeSend  : function(){
              $('#status').html("Deleting user . . . ");
            },
            success     : function(response){
              if(response == "sukses"){
                $('#status').html("Success delete user");
                $('#btndel').hide();
                $('#tr'+$('#delfileid').val()).slideUp(1000);
              }
              else{
                $('#status').html(response);
              }
            }
          });
        });          


    </script>

  </body>
</html>
