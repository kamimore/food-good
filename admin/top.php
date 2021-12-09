<?php
session_start();
include('../database.inc.php');
include('../function.inc.php');
include('../constant.inc.php');


/*$data=$_SERVER['REQUEST_URI'];
$data_array=explode('/',$data);
$title=end($data_array);
$title=strstr($title,'.',true);
switch($title)
{
  case 'index':
  $title_data="Food Ordering Website";
  break;
  case 'category':
  $title_data="Category ";
  break;
  case 'user':
  $title_data="User";
  break;
  case 'delivery_boy':
  $title_data="Delivery Boy ";
  break;
  case 'coupon_code':
  $title_data="Coupon Code ";
  break;
  case 'dish':
  $title_data="Dish";
  break;
  default:
  $title_data=" Title loading....";
}

*/

if(isset($_SESSION['username']))
{

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--<title><?/*php echo $title_data; */?></title>-->
  <title class="booktitle"></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo admin_path; ?>assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo admin_path; ?>assets/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo admin_path;?>assets/css/dataTables.bootstrap4.css">

  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo admin_path; ?>assets/css/bootstrap-datepicker.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo admin_path; ?>assets/css/style.css">
</head>
<body class="sidebar-light">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
        <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
          <li class="nav-item nav-toggler-item">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>

        </ul>
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href=javascript:void(0)><img src="<?php echo admin_path; ?>assets/images/logo.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href=javascript:void(0)><img src="<?php echo admin_path; ?>assets/images/logo.png" alt="logo"/></a>
        </div>
        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name bg-danger badge badge-pill text-white lead text-uppercase"><?php echo $_SESSION['username']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout" >
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>

          <li class="nav-item nav-toggler-item-right d-lg-none">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo admin_path; ?>index">
              <i class="mdi mdi-view-quilt menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo admin_path; ?>order">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Orders</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo admin_path; ?>category">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Category</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo admin_path; ?>user">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo admin_path; ?>delivery_boy">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Delivery Boys</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo admin_path; ?>coupon_code">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Coupon Code</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo admin_path; ?>dish">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Dishes</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo admin_path; ?>banner">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Banner</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo admin_path; ?>contact_us">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Contact Us</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo admin_path; ?>setting">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Setting</span>
            </a>
          </li>



        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

<?php
}
else {
  redirect("login");
}

 ?>
