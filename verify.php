
<?php

/*include ("header.php");

$msg="";
//Email id verify
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($_GET['id']);
	mysqli_query($con,"update user set email_verify=1 where rand_str='$id'");
	$msg="Email id verify";
}else{
	redirect('index.php');

}*/
?>
<?php
include ("header.php");
$msg="";
$check="";

if(isset($_GET['id']) && $_GET['id']!='')
{
  $id=$_GET['id'];
   $check=mysqli_fetch_assoc(mysqli_query($conn,"select email_verify from user where rand_str='$id'"));
   
   if(!isset($check)){
    redirect(user_login.'shop');
   }else{
    if($check['email_verify']==1 ){
      redirect(user_login.'shop');
    }
   }
  
  mysqli_query($conn,"update user set email_verify=1 where rand_str='$id'");
  $msg="Dear User Your Email id has been Verified";

// activation of referral code in time of email verification

  /*$res=mysqli_query($conn,"select from_referral_code,email from user
	where rand_str='$id'");
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_assoc($res);
		$email=$row['email'];
		$from_referral_code=$row['from_referral_code'];
		$row=mysqli_fetch_assoc(mysqli_query($conn,"select id from user
		 where referral_code='$from_referral_code'"));
		$uid=$row['id'];
		$msg1='Referral Amt from '.$email;
		manageWallet($uid,50,'in',$msg1);
	}*/

}
else{
  redirect(user_login);
}



 ?>

<div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="<?php echo user_login?>shop">Home</a></li>
                        <li class="active"> Email Verify </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="contact-area pt-100 pb-100">
            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <div class="contact-message-wrapper">
                            <h4 class="contact-title">
								<?php
								echo $msg;
								?>
							</h4>

                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include("footer.php");
?>
