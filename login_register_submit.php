<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
include 'smtp/PHPMailerAutoload.php';

$type=($_POST['type']);
$added_on=date('Y-m-d h:i:s');

if($type=="register")
{
  $name=safe($_POST['name']);
  $email=safe($_POST['email']);
  $mobile=safe($_POST['mobile']);
  $password=safe($_POST['password']);
$check=mysqli_num_rows(mysqli_query($conn,"SELECT * from user where email='$email'"));
if($check > 0)
{
  $arr=array('status'=>'error','msg'=>'Email id already registered','field'=>'email_error');
}
else {
  $new_password=password_hash($password,PASSWORD_BCRYPT);

  $rand=rand_str();
  $referral_code=rand_str();
  if(isset($_SESSION['FROM_REFERRAL_CODE']) &&
  $_SESSION['FROM_REFERRAL_CODE']!=''){
    $from_referral_code=$_SESSION['FROM_REFERRAL_CODE'];
  }else{
    $from_referral_code='';
  }
  mysqli_query($conn,"INSERT INTO user(name,email,mobile,
    password,status,email_verify,rand_str,added_on,referral_code,
    from_referral_code)
   values('$name','$email','$mobile','$new_password',1,0,'$rand','$added_on'
   ,'$referral_code','$from_referral_code')");
   $id=mysqli_insert_id($conn);
   unset($_SESSION['FROM_REFERRAL_CODE']);

   $getSetting=getSetting();
   $wallet_amt=$getSetting['wallet_amt'];
   if($wallet_amt>0){
     manageWallet($id,$wallet_amt,'in','Register');
   }


   $html=user_login."verify?id=".$rand;

   send_email("radhanegi996@gmail.com",$html,"Verify Your Password");

   $arr=array('status'=>'success','msg'=>'Thank you for register. Please check your email id, to verify your account','field'=>'form_msg');

}
echo json_encode($arr);

}


if($type=='login'){
	$email=safe($_POST['user_email']);
	$password=safe($_POST['user_password']);
	$res=mysqli_query($conn,"select * from user where email='$email'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$status=$row['status'];
		$email_verify=$row['email_verify'];
		$dbpassword=$row['password'];
		if($email_verify==1){
			if($status==1){

				if(password_verify($password,$dbpassword)){
					$_SESSION['FOOD_USER_ID']=$row['id'];
					$_SESSION['FOOD_USER_NAME']=$row['name'];
         			$_SESSION['FOOD_USER_EMAIL']=$row['email'];
					$arr=array('status'=>'success','msg'=>'');
        if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0)
        {
        foreach($_SESSION['cart'] as $key=>$value)
        {
          $attr=$key;
          $qty=$value['qty'];
          manageUserCart(	$_SESSION['FOOD_USER_ID'],$qty,$attr);
        }
        }
    //manageUserCart($uid,$qty,$attr)
				}else{
					$arr=array('status'=>'error','msg'=>'Please enter correct password');
				}
			}else{
				$arr=array('status'=>'error','msg'=>'Your account has been deactivated.');
			}
		}else{
			$arr=array('status'=>'error','msg'=>'Please varify your email id');
		}
	}else{
		$arr=array('status'=>'error','msg'=>'Please enter valid email id');
	}
	echo json_encode($arr);
}

if($type=='forgot'){
	$email=safe($_POST['user_email']);

	$res=mysqli_query($conn,"select * from user where email='$email'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$status=$row['status'];
		$email_verify=$row['email_verify'];
		$id=$row['id'];
		if($email_verify==1){
			if($status==1){

        $rand_str_update=mysqli_fetch_assoc(mysqli_query($conn,"select * from user where id=$id"));

        /*echo $rand_str_update['rand_str'];
        echo user_login."/forgot_password_reset?request=".$rand_str_update['rand_str'];
        pxr($rand_str_update);
        die();*/
        $subject="Password RESET Request";
        $html=user_login."forgot_password_reset?request=".$rand_str_update['rand_str'];

        send_email($email,$html,$subject);
        $arr=array('status'=>'success','msg'=>'Check Your email id to reset your password');

			/*	$rand_password=rand(11111,99999);
				$new_password=password_hash($rand_password,PASSWORD_BCRYPT);
				mysqli_query($conn,"update user set password='$new_password' where id='$id'");
				$html=$rand_password;
				send_email($email,$html,'New Password');
				$arr=array('status'=>'success','msg'=>'Password has been reset and send it to your email id');*/

			}else{
				$arr=array('status'=>'error','msg'=>'Your account has been deactivated.');
			}
		}else{
			$arr=array('status'=>'error','msg'=>'Please varify your email id');
		}
	}else{
		$arr=array('status'=>'error','msg'=>'Please enter valid email id');
	}
	echo json_encode($arr);
}


?>
