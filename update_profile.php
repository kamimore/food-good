<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
if(!isset($_SESSION['FOOD_USER_ID'])){
	redirect(user_login.'shop');
}
//include('smtp/PHPMailerAutoload.php');
$uid=$_SESSION['FOOD_USER_ID'];
$type=safe($_POST['type']);
if($type=='profile'){
	$name=safe($_POST['name']);
	$mobile=safe($_POST['mobile']);
	$_SESSION['FOOD_USER_NAME']=$name;
	mysqli_query($conn,"update user set name='$name',mobile='$mobile' where id='$uid'");
	$arr=array('status'=>'success','msg'=>'Profile has been updated');
	echo json_encode($arr);
}

if($type=='password'){
	$old_password=safe($_POST['old_password']);
	$new_password=safe($_POST['new_password']);

	$check=mysqli_num_rows(mysqli_query($conn,"select * from user where password='$old_password'"));
	$res=mysqli_query($conn,"select password from user where id='$uid'");
	$row=mysqli_fetch_assoc($res);
	$dbpassword=$row['password'];
	if(password_verify($old_password,$dbpassword)){
		$new_password=password_hash($new_password,PASSWORD_BCRYPT);
		mysqli_query($conn,"update user set password='$new_password' where id='$uid'");
	$arr=array('status'=>'success','msg'=>'Password has been updated');
	}else{
		$arr=array('status'=>'error','msg'=>'Please enter correct password');
	}

	echo json_encode($arr);
}
?>
