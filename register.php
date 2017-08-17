<?php 
require_once('config.php');
$querydep = $pdo->prepare("SELECT * FROM departemen");
$querydep->execute();
$resultdep = $querydep->fetchAll();
?>
<html>
    <head>
        <title>Login</title>
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
    
<body class="bodyloginregister">
    
    <div class="container container-register">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="form">
                		
                    <form class="form-validate form-horizontal form-login" method="post" id="register">
                        <div class="form-group logo-login">
                            <img src="img/rsz_tiki-web-logo.png" class="img-responsive">
                        </div>
                        <div id="status">
                            
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="idanggota" minlength="5" type="text" placeholder="ID Anggota"  />
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="fullname" minlength="5" type="text" placeholder="Nama Lengkap"  />
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="departemen">
                                            <outgroup label="Departement">
                                                <?php foreach ($resultdep as $depnya) {?>
                                                <option value="<?php echo $depnya['departemen'] ?>" selected>
                                                    <?php echo $depnya['departemen'] ?>
                                                </option>
                                                <?php }?>
                                            </outgroup>
                                        </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="username" minlength="5" type="text" placeholder="Username"  />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group text-center">
                            <button id="regist" class="btn btn-default login-btn">Daftar</button>
                            <p class="daftar">Sudah mempunyai akun? <a href="login.php">Login disini</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
    
    
    
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
    <script>
        $(document).ready(function(){
            var datauser = $('#register');
            $('#regist').click(function(){
                $.ajax({
                    type    : 'POST',
                    url     : 'ajax/register.php',
                    data    : datauser.serialize(),
                    beforeSend: function(){
                        $('#regist').html('Process . . .');
                    },
                    success: function(response){
                        if(response == 'sukses'){
                            $("#status").attr('class', '');
                            $('#status').addClass("alert alert-success");
                            $('#status').html("Sukses Daftar! Silahkan Login");
                            $('#regist').html('Daftar');
                        }
                        else if(response == 'ar'){
                            $("#status").attr('class', '');
                            $('#status').addClass("alert alert-warning");
                            $('#status').html("All fields are required");
                            $('#regist').html('Daftar');
                        }
                        else if(response == 'useruse'){
                            $("#status").attr('class', '');
                            $('#status').addClass("alert alert-warning");
                            $('#status').html("Username already use ");
                            $('#regist').html('Daftar');
                        }
                    }
                });
                return false;
            });
            
        });
    </script>
    
    
</body>
</html>