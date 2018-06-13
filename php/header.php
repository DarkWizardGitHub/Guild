<?php
require_once('./class/authentication_class.php');
$objAuthentication = new Authentication();
// 検索機能
// サインイン遷移
// サインアップ遷移
// ログイン確認によるユーザーアイコンの変移
// $authentication->test();
$headerflag=$objAuthentication->statuscheck();
?>