<?php
session_start();
require_once('./class/authentication_class.php');
$obj = new Authentication();

$obj->signout('./index.php');

?>