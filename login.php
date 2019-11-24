<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Perpustakaan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/AdminLTE/plugins/iCheck/square/blue.css">

  <link rel="SHORTCUT ICON" href="assets/img/logo.png">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-color: #999999">
<div class="login-box" style="margin-top: 70px">
  <center><h3 style="color: white"><b>Selamat Datang Di Menu Admin</b></h3></center>
  <center><h3 style="color: white"><b>Silahkan Login</b></h3></center>
  <center><h3><b><hr></b></h3></center>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <center> 
      <img src="assets/img/logo.png" alt="Logo" width="50%"><br>
    </center>
    <form action="login.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <a href="index.php" class="btn btn-default btn-block btn-flat"><i class="fa fa-close"></i> Back</a>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" name="login" class="btn btn-success btn-block btn-flat"><i class="fa fa-sign-in"></i> Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="assets/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/AdminLTE/plugins/iCheck/icheck.min.js"></script>
</body>
</html>




<?php
session_start();

if(isset($_SESSION['username'])) {
  if($_SESSION['username'] != null){
    header("location:dashboard.php");
  }
}

if(isset($_POST['login'])) {    

  $username=$_POST["username"];
  $password=$_POST["password"];
    
    if($username=="admin" AND $password=="admin")
    {   
        $_SESSION['username'] = $username;
        header("location:dashboard.php"); 
    }else{
        echo "<script type='text/javascript'>
            alert ('Gagal Melakukan Login !');
            window.location.replace('http://localhost/ppl%20baru/SistemPerpustakaan-master/login.php');
          </script>"; 
    }

}


?>