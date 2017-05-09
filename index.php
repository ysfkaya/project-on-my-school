<?php


require_once 'system/system.php';
require_once 'system/frontend.php';

define('GUVENLIK',true);

if (isLogin() && isUser()){
    require 'frontend/home.php';
}else{
    require 'frontend/index.php';
}
