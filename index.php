<?php


/*
 * Sistem ve anasayfa dosyalarını çağırdık.
 */
require_once 'system/system.php';
require_once 'system/frontend.php';

/*
 * Yetkisiz girişi önlemek için bir sabit tanımladık.
 */
define('GUVENLIK',true);
/*
 * isLogin -> Bu fonksiyon kullanıcı girişi olup olmadığını kontrol eder.
 * isUser  -> Bu fonksiyon giriş yapan kullanıcının öğrenci olup olmadığını kontrol eder.
 */

if (isLogin() && isUser()){
	/*
	 * Eğer giriş yapan bir kullanıcı varsa ve bu kullanıcı öğrenci ise öğrenci panelini yükler.
	 */
    require 'frontend/home.php';
}else{
	/*
	 * Eğer giriş yapan bir kullanıcı yoksa anasayfayı yükler.
	 */
    require 'frontend/index.php';
}


