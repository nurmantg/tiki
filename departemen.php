<?php 
session_start();
if(!$_SESSION['login_data']){
  header('Location: login.php');
}
date_default_timezone_set('Asia/Jakarta');
require_once("config.php");

$query = $pdo->prepare("SELECT * FROM departemen");
$query->execute();
$result = $query->fetchAll();
$infouser = $pdo->prepare("SELECT * FROM user WHERE username =?");
$infouser->bindValue(1, $_SESSION['login_data']);
$infouser->execute();
$hasilnya = $infouser->fetch(PDO::FETCH_ASSOC);
if($hasilnya['admin'] == 1){
  $isadmin = 1;
}else{
  header('Location: index.php');
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
                  <li >
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
                  <li class="active">
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
          <h3 class="page-header"><i class="fa fa-laptop"></i> Departemen</h3>
          <ol class="breadcrumb">
            <li><i class="icon_house_alt"></i><a href="index.php">Dashboard</a></li>
            <li><i class="fa fa-university"></i>Departemen</li>                
          </ol>
        </div>
      </div>
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
              <input type="hidden" id="deluserid" name="iddepnya">
              <button type="button" class="btn btn-danger" id="btndel">Delete</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </form>
              
            </div>
          </div>

        </div>
      </div>
            <div class="row">
              <div class="panel-heading">
                <h3>Tambah Departemen</h3>
              </div>
              <div class="col-lg-12 box-search">
                    <form class="form-validate form-horizontal" method="POST" id="formtambah">
                        <div id="status1"></div>
                        <div class="form-group">
                            <label for="cname" class="control-label col-lg-2">Nama Departemen</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="namadepartemen" minlength="5" type="text" placeholder="Departement"  />
                                <input type="hidden" name="pembuat" value="<?php $hasil['nama_lengkap'] ?>">
                          </div>
                        </div>
                        <div class="form-group">
                                        <div class="col-lg-1 col-md-offset-5">
                                            <button id="tambah" type="submit" class="btn btn-default">
                                            Tambahkan Departemen</button>
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
                                            <td>Nama Departemen</td>
                                            <td>Pembuat</td>
                                            <td>Option</td>
                                        </tr>
                                    </tbody>
                                  </table>         
                          <table class="table table-hover personal-task">
                              <tbody>
                              <?php foreach ($result as $hasil ) {
                              ?>
                              
                              <tr id="tr<?php echo $hasil['id']; ?>">
                                    <td>
                                        <?php echo $hasil['departemen']; ?>
                                    </td>
                                    <td class="td-departement" style="text-align: left"><span class="border-departement">
                                      <a href="#"><?php echo $hasil['pembuat']; ?></a></span>
                                    </td>
                                    <td class="td-option">
                                        <span>
                                            <button type="submit" id="buton-delete" data-toggle="modal" data-target="#modaldelete" data-id="<?php echo $hasil['id']; ?>" class="btn btn-default" >Delete</button>
                                        </span>
                                    </td>
                                </tr>

                              <?php
                            } 
                            ?>                             
                            </tbody>
                          </table>

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
    <script>
      $(document).ready(function(){
        var datadep = $('#formtambah');
        $('#tambah').click(function(){
          $.ajax({
            type  : 'POST',
            url   : 'ajax/add_departemen.php',
            data  : datadep.serialize(),
            beforeSend: function(){
              $('#tambah').html('Process . . .');
            },
            success: function(response){
              if(response == 'sukses'){
                $("#status1").attr('class', '');
                $('#status1').addClass("alert alert-success");
                $('#status1').html("Sukses Menambahkan Departemen");
                $('#tambah').html('Tambahkan Departemen');
              }
              else if(response == 'ar'){
                $("#status1").attr('class', '');
                $('#status1').addClass("alert alert-warning");
                $('#status1').html("All fields are required");
                $('#tambah').html('Tambahkan Departemen');
              }
              else if(response == 'depuse'){
                $("#status1").attr('class', '');
                $('#status1').addClass("alert alert-warning");
                $('#status1').html("Departemen Telah ada ");
                $('#tambah').html('Tambahkan Departemen');
              }
              else{
                $("#status1").attr('class', '');
                $('#status1').addClass("alert alert-warning");
                $('#status1').html(response);
                $('#tambah').html('Tambahkan Departemen');
              }
            }
          });
          return false;
        });
        
      });
    </script>
    <script>

        $('.td-option button').click(function(){
          dataid = $(this).attr('data-id'); 
           $('#status').html("Are You sure want to delete it?");
           $('#btndel').show();
        });
        $('#modaldelete').on('show.bs.modal', function (e) {
          $(this).find('#deluserid').val(dataid);
        });
        var datas = $('#formdel');
        $('#btndel').click(function(){
          $.ajax({
            type  : 'POST',
            url   : 'ajax/delete_departemen.php',
            data  : datas.serialize(),
            beforeSend  : function(){
              $('#status').html("Deleting user . . . ");
            },
            success     : function(response){
              if(response == "sukses"){
                $('#status').html("Success delete user");
                $('#btndel').hide();
                $('#tr'+$('#deluserid').val()).slideUp(1000);
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
