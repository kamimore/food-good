<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
if(!isset($_SESSION['FOOD_USER_ID'])){
	redirect(user_login.'shop');
}
$rate=safe($_POST['rate']);
$id=safe($_POST['id']);
$order_id=safe($_POST['oid']);
$added_on=date('Y-m-d h:i:s');
$uid=$_SESSION['FOOD_USER_ID'];
mysqli_query($conn,
"insert into rating(user_id,dish_detail_id,rating,order_id)
values('$uid','$id','$rate','$order_id')");
?>
