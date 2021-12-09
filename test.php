<?php session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
echo md5("next");
die();
?>