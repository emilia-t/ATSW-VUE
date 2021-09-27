<?php
//用于检查是否为内部人员的
$is_internal_staff=false;
if (isset($_COOKIE['in_cookie'])) {
require_once('in_cookie_config.php');
if ($_COOKIE['in_cookie']===$in_cookie_token){$is_internal_staff=true;}
}
