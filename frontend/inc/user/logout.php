<?php

echo !defined("GUVENLIK") ? die("Geçersiz istek") : null;

if(isLogin() == true){

	olay(array("Çıkış Yapıldı","çıkış"),null,getSession('id'));
    session_destroy();
    go(url());
}else{
    go(url());
}





?>
