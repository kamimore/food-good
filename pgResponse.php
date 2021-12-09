<?php
session_start();
/*header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");*/

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");


include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
include('smtp/PHPMailerAutoload.php');

//pxr($_SESSION);
/*
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<pre>";
print_r($_COOKIE);
echo "</pre>";

echo "<pre>";
print_r($_POST);
echo "</pre>";
die();
*/
////////////////////////////////////
//ye code me ab wallet me amount ko add krne ke liye kar raha hu
$oid=$_POST['ORDERID'];

if(substr($oid,0,4)==='ORDS')
{

	$newarr=array();
	$newarr=explode('_',$_POST['ORDERID']);
	$userid=$newarr[1];
	$queryforWallet=mysqli_fetch_assoc(mysqli_query($conn,"select * from user where id=$userid"));

	$_SESSION['IS_WALLET']='YES';
	$_SESSION['FOOD_USER_ID']=$userid;
	$_SESSION['FOOD_USER_NAME']=$queryforWallet['name'];
	$_SESSION['FOOD_USER_EMAIL']=$queryforWallet['email'];
//	pxr($_SESSION);
}


//////////////////////

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;


$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

//pxr($_COOKIE);

if($isValidChecksum == "TRUE") {
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		$TXNID=$_POST['TXNID'];
		$amt=$_POST['TXNAMOUNT'];
		if(isset($_SESSION['IS_WALLET'])){
			manageWallet($_SESSION['FOOD_USER_ID'],$amt,'in','Added',$TXNID);
			unset($_SESSION['IS_WALLET']);
			redirect(user_login.'wallet');
		}else{
		/*	$oid=$_POST['ORDERID'];
			$oArr=explode('_',$oid);
			$oid=$oArr[0];*/

			$oArr=explode('_',$oid);
			$oid=$oArr[0];
			$queryforgettinguserid=mysqli_fetch_assoc(mysqli_query($conn,"select * from order_master where id='$oid'"));
		//	pxr($queryforgettinguserid);

			if(!isset($_SESSION['FOOD_USER_NAME'])){
				$_SESSION['FOOD_USER_ID']=$queryforgettinguserid['user_id'];
				$_SESSION['FOOD_USER_NAME']=$queryforgettinguserid['name'];
				$_SESSION['FOOD_USER_EMAIL']=$queryforgettinguserid['email'];
				$_SESSION['ORDER_ID']=$queryforgettinguserid['id'];
			}

			$getUserDetailsBy=getUserDetailsByid();
			$email=$getUserDetailsBy['email'];

			$emailHTML=orderEmail($oid);
			//$_SESSION['ORDER_ID']=$oid;

			mysqli_query($conn,"update  order_master set payment_status='success', 	payment_id='$TXNID' where id='$oid'");
			echo "hello";
		//	die();
			send_email($email,$emailHTML,'Order Placed');
			redirect(user_login.'success');
		}

	}
	else {
		$oid=$_POST['ORDERID'];
		$oArr=explode('_',$oid);
		$oid=$oArr[0];
		//$TXNID=$_POST['TXNID'];
		//mysqli_query($conn,"update payment_status='failed', payment_id='$TXNID' where id='$oid'");

		redirect(user_login.'error');
	}
}else{
	$oid=$_POST['ORDERID'];
	$oArr=explode('_',$oid);
	$oid=$oArr[0];
	$TXNID=$_POST['TXNID'];
	mysqli_query($conn,"update payment_status='failed', payment_id='$TXNID' where id='$oid'");
	redirect(user_login.'error');
}

?>
