<?php session_start();
include '../database.inc.php';
include '../function.inc.php';
include('../constant.inc.php');

$msg="";
if(isset($_POST['submit']))
{
  $username=safe($_POST['username']);
  $password=md5(safe($_POST['password']));
  $sql="SELECT * from admin where username='$username' and password='$password'";

  $query=mysqli_query($conn,$sql);
  if(mysqli_num_rows($query) > 0)
  {
    $row=mysqli_fetch_assoc($query);
    $_SESSION['username']=safe($_POST['username']);
    $_SESSION['password']=safe($_POST['password']);
    $_SESSION['ADMIN_USER']=safe($_POST['username']);

    redirect("index");

  }
  else {
    $msg="Please enter correct username or password";

  }
}
 ?>
 
 <!DOCTYPE html>
 
 <html lang="en">
 <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Food Ordering Admin</title>
   <!-- plugins:css -->
   
   <link rel="stylesheet" href="<?php echo admin_path; ?>assets/css/materialdesignicons.min.css">
  

   <link rel="stylesheet" href="<?php echo admin_path; ?>assets/css/vendor.bundle.base.css">
   
   <!-- endinject -->
   <!-- Plugin css for this page -->
   
   <link rel="stylesheet" href="<?php echo admin_path; ?>assets/css/bootstrap-datepicker.min.css">
   <!-- End plugin css for this page -->
   <!-- inject:css -->
   

   <link rel="stylesheet" href="<?php echo admin_path; ?>assets/css/style.css">
 </head>
 <body class="sidebar-light">
   <div class="container-scroller">
     <div class="container-fluid page-body-wrapper full-page-wrapper">
       <div class="content-wrapper d-flex align-items-center auth">
         <div class="row w-100">
           <div class="col-lg-4 mx-auto">
             <div class="auth-form-light text-left p-5">
               <div class="brand-logo text-center">
                 <img src="<?php echo admin_path; ?>assets/images/logo.png" alt="logo">
               </div>
               <h6 class="font-weight-light">Sign in to continue.</h6>
               <form class="pt-3" method="post">
                 <div class="form-group">
                   <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" name="username" placeholder="Username" required>
                 </div>
                 <div class="form-group">
                   <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Password" required>
                 </div>
                 <div class="mt-3">
                   <input type="submit" class="btn btn-primary btn-block" name="submit" placeholder="SIGN IN">
                   <p class="my-2 badge badge-danger text-black "><?php echo $msg; ?></p>
                 </div>

               </form>
             </div>
           </div>
         </div>
       </div>
       <!-- content-wrapper ends -->
     </div>
     <!-- page-body-wrapper ends -->
   </div>

   <!-- plugins:js -->
   <script src="<?php echo admin_path; ?>assets/js/vendor.bundle.base.js"></script>
   <!-- endinject -->
   <!-- Plugin js for this page -->
   <script src="<?php echo admin_path; ?>assets/js/Chart.min.js"></script>
   <script src="<?php echo admin_path; ?>assets/js/bootstrap-datepicker.min.js"></script>
   <!-- End plugin js for this page -->
   <!-- inject:js -->
   <script src="<?php echo admin_path; ?>assets/js/off-canvas.js"></script>
   <script src="<?php echo admin_path; ?>assets/js/hoverable-collapse.js"></script>
   <script src="<?php echo admin_path; ?>assets/js/template.js"></script>
   <script src="<?php echo admin_path; ?>assets/js/settings.js"></script>
   <script src="<?php echo admin_path; ?>assets/js/todolist.js"></script>
   <!-- endinject -->
   <!-- Custom js for this page-->
   <script src="<?php echo admin_path; ?>assets/js/dashboard.js"></script>
   <!-- End custom js for this page-->
 </body>
 </html>
