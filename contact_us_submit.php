<?php
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
$name=safe($_POST['name']);
$email=safe($_POST['email']);
$mobile=safe($_POST['mobile']);
$subject=safe($_POST['subject']);
$message=safe($_POST['message']);
$added_on=date('Y-m-d h:i:s');
mysqli_query($conn,"insert into contact_us(name,email,mobile,subject,message,added_on)
values('$name','$email','$mobile','$subject','$message','$added_on')");
echo "Thank you for connecting with us, will get back to you shortly";
?>
