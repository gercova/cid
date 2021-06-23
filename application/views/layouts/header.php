<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CID</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CID</title>
    <link rel="icon" href="<?php echo base_url()?>assets/img/cti.png" type="image/png">
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <!-- timepicker 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/timepicker/bootstrap-timepicker.css">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.css">

    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/template/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/datatables.net-bs/css/jquery.dataTables.min.css">
     <!-- DataTables exports -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/datatablesexport/css/buttons.dataTables.min.css">
     <!-- DataTables icons  -->
   <link rel="stylesheet" href="<?php echo base_url();?>assets/template/ionicons/css/ionicons.min.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/template/sheguito/formularios.css">
    <!-- IMPLEMENTACION JTABLE -->

    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/jtable/themes/lightcolor/blue/jtable.min.css">


    <!-- Font Awesome  detalles de los botones dibujos-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/font-awesome/css/font-awesome.min.css"> 
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    parte izquierada menus del sistema -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/dist/css/skins/_all-skins.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url();?>dashboard" class="logo">  
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>IDIOMAS</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>IDIOMAS</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url()?>assets/template/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->userdata("nombre")?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <a href="<?php echo base_url(); ?>auth/logout"> Cerrar Sesión</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>