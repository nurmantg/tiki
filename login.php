<?php 
session_start();
if($_SESSION['login_data']){
  header('Location: index.php');
}
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
    
    <div class="container container-login">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="form">
                    
                    <form class="form-validate form-horizontal form-login" method="post" id="loginform">
                        <div class="form-group logo-login">
                            <img src="img/rsz_tiki-web-logo.png" class="img-responsive">
                        </div>
                        <div id="status"></div>
                        <div class="form-group">
                            <input class="form-control" name="username" minlength="5" type="text" placeholder="Username" required />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group text-center">
                            <button id="login" class="btn btn-default login-btn" type="submit">Login</button><br>
                            <p class="daftar">Tidak mempunyai akun? <a href="register.php">Daftar Akun</a></p>
                        </div>
                    </form>
                </div>
                <br>
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
    <script>
        $(document).ready(function(){
            var datauser = $('#loginform');
            $('#login').click(function(){
                $.ajax({
                    type    : 'POST',
                    url     : 'ajax/login.php',
                    data    : datauser.serialize(),
                    beforeSend: function(){
                        $('#login').html('Process . . .');
                    },
                    success: function(response){
                        if(response == 'sukses'){
                            $("#status").attr('class', '');
                            $('#status').addClass("alert alert-success");
                            $('#status').html("Login Sukses, mohon tunggu . . . ");
                            $('#login').html('Login');
                            window.setTimeout(function(){
                                window.location.href = "index.php";
                            }, 1000);
                        }
                        else if(response == 'ar'){
                            $("#status").attr('class', '');
                            $('#status').addClass("alert alert-warning");
                            $('#status').html("All fields are required");
                            $('#login').html('Login');
                        }
                        else{
                            $("#status").attr('class', '');
                            $('#status').addClass("alert alert-danger");
                            $('#status').html("Username / Password Incorrect");
                            $('#login').html('Login');
                        }
                    }
                });
                return false;
            });
            
        });
    </script>
    <!--custome script for all page-->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/scripts.js"></script>
</body>
</html>