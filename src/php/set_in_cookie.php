<?php
//用于设置内部版本的cookie
session_start();
require_once('in_cookie_config.php');
if ($_POST['in_cookie'] === $in_cookie_token) {
    setcookie('in_cookie', $in_cookie_token, time()+3600*24*730, '/');
    echo json_decode(true);
}else{
    echo json_decode(false);
}
