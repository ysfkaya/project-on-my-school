<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE );
// error_reporting(-1);
// ini_set('display_errors','On');
session_start();
ob_start();
date_default_timezone_set('Etc/GMT-3');
/* Veritabanı Bağlantısı */
try{
    $db = new PDO("mysql:host=localhost;dbname=proje_takip;charset=utf8","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    die($e->getMessage());
}



/* Sabitler */
define("dir",$_SERVER['DOCUMENT_ROOT'].'/proje/');
define("URL","http://".$_SERVER["SERVER_NAME"]."/proje");
define("BACKEND_URL",URL."/admin/");
define("PROJE_DOSYA",dir."dosyalar/");
define("RESIM",dir."frontend/avatar/");
define("RESIM_YUKLE",URL."/frontend/avatar/");
define('LOGO', dir.'logo/');
define('LOGO_URL', URL.'/logo/');



/* ayarlar */
$ayar = $db->query("SELECT * FROM ayarlar WHERE ayar_id = 1")->fetch(PDO::FETCH_ASSOC);



if (!is_dir(PROJE_DOSYA)) {
	die("HATA ! Lütfen ana dizinde \"dosyalar\" adında bir dosya oluşturunuz.");
}

if ($_SESSION['user'] == 'ogrenci' && isset($_SESSION['id'])) {
	$id = $_SESSION['id'];
	$ogrenci = $db->query("SELECT * FROM ogrenciler WHERE ogrenci_id = $id")->fetch(PDO::FETCH_ASSOC);
}


