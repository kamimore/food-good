<?php
include ("header.php");

$randomstring='';
$dbpassword='';

if(isset($_GET['request'])){
  $randomstring=safe($_GET['request']);
}

if(isset($_POST['submit']))
{

   $rand_str=safe($_POST['rand_str']);
   $password=safe($_POST['password']);
   $query=mysqli_query($conn,"select * from user where rand_str='$rand_str'");


  if(mysqli_num_rows(mysqli_query($conn,"SELECT * from  user where rand_str='$rand_str'"))>0)
  {

    $dbpassword=password_hash($password,PASSWORD_BCRYPT);

    mysqli_query($conn,"UPDATE user SET password='$dbpassword' where rand_str='$rand_str'");
    
    redirect('login_register');
  }
  else{
    redirect('index');
  }

}

?>
<div class="login-register-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <h4>Reset Password</h4>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="post" action="">
                                                <input type="password" name="password" placeholder="Enter New Password" required>
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                  <a href="<?php echo user_login?>login_register">Login</a>
                                                    </div>
                                                    <button  type="submit" name='submit'>Submit</button>
													<input type="hidden" name="rand_str" value="<?php echo $randomstring ?>"/>
												   <div id="form_forgot_msg" class="success_field"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include("footer.php");
?>
