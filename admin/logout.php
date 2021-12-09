<?php
session_start();
//include '../database.inc.php';
include('../function.inc.php');
session_unset();
session_destroy();

redirect("login");
 ?>
