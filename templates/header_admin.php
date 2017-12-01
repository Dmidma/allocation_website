<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TuniWin</title>  <!--  hedhi   bech tatla3lek  fel  ongle mel fou9 -->
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>TuniWin</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $admin["image"];?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $admin["user_name"]; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $admin["image"];?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $admin["user_name"]; ?>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                 
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <div class="pull-left">
                  <a href="admin_config.php" class="btn btn-default btn-flat">Configuration</a>
                </div>


                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">déconnexion</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $admin["image"];?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $admin["user_name"]; ?></p>  
          <a href="#"><i class="fa fa-circle text-success"></i> en ligne</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu</li>
      


        <!-- Hotel -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Gestion Hotel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin_add_hotel.php"><i class="fa fa-circle-o"></i>Ajouter</a></li>
            <li><a href="admin_modify_hotel.php"><i class="fa fa-circle-o"></i>Liste des Hotels</a></li>
            <li><a href="admin_images_hotel.php"><i class="fa fa-circle-o"></i>galleries</a></li>
          </ul>
        </li>

         <!-- Voiture -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Gestion Voiture</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin_add_voiture.php"><i class="fa fa-circle-o"></i>Ajouter</a></li>
            <li><a href="admin_modify_voiture.php"><i class="fa fa-circle-o"></i>Liste des Voitures</a></li>
            <li><a href="admin_images_voiture.php"><i class="fa fa-circle-o"></i>galleries</a></li>
          </ul>
        </li>

         <!-- Circuit -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Gestion d'Excursion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin_add_circuit.php"><i class="fa fa-circle-o"></i>Ajouter</a></li>
            <li><a href="admin_modify_circuit.php"><i class="fa fa-circle-o"></i>Liste des Excursions</a></li>
            <li><a href="admin_images_circuit.php"><i class="fa fa-circle-o"></i>galleries</a></li>
          </ul>
        </li>


           <!-- Promotions -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Promotions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin_create_promotion.php"><i class="fa fa-circle-o"></i>Ajouter</a></li>
            <li><a href="admin_current_promotion.php"><i class="fa fa-circle-o"></i>Current</a></li>
            <li><a href="admin_done_promotion.php"><i class="fa fa-circle-o"></i>Done</a></li>
          </ul>
        </li>



        <!-- Clients -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Clients</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="clients.php"><i class="fa fa-circle-o"></i>Liste des Clients</a></li>
            <li><a href="admin_client_cart.php"><i class="fa fa-circle-o"></i>Cart</a></li>
          </ul>
        </li>

        <!-- Contactez Nous -->
        <li class="treeview">
          <a href="admin_contact.php">
            <i class="fa fa-dashboard"></i> <span>Contact</span>
          </a>
        </li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">