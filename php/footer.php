<?php
require_once('./class/authentication_class.php');
$authentication_footer = new Authentication();
$footerflag=$authentication_footer->statuscheck();
?>