<?php 
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği") : null;

if(isLogin() == true){
    session_destroy();
    go(url());
}else{
    go(url());
}
