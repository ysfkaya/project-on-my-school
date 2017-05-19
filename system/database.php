<?php 

// Sadece belirli hataları gösterir.
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);

// Sessionımızı başlattık.
session_start();

// Yönlendirme işlemlerinde bir sorun olmaması için tanımladık.
ob_start();

// Varsayılan zamanlama dilimini seçtik.
date_default_timezone_set('Etc/GMT-3');


/* Veritabanı Bağlantısı */

require_once 'config.php'; // değişkenlerimizi çağırdık.

try{
    $db = new PDO("mysql:host={$_host};dbname={$_dbname};charset=utf8","{$_username}","{$_password}",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    die($e->getMessage());
}



/* Sabitler */
define("dir",$_SERVER['DOCUMENT_ROOT'].'/proje/'); // çalışma alanı

define("URL","http://".$_SERVER["SERVER_NAME"]."/proje"); // url adresimizi

define("BACKEND_URL",URL."/admin/"); // admin url adresi

define("PROJE_DOSYA",dir."dosyalar/"); // proje dosyalarının dizini

define("RESIM",dir."frontend/avatar/"); // kullanıcıların fotoğraflar dizini

define("RESIM_YUKLE",URL."/frontend/avatar/"); // resim yüklerken erişmek için oluşturulan url adresi

define('LOGO', dir.'logo/'); // logo dizini

define('LOGO_URL', URL.'/logo/'); // logo url adresi



/* ayarlar
 * Tüm dosyalarda ulaşabileceğimiz bir sorgu oluşturduk.
 * Böylece site için kaydettiğimiz ayarları her dosyadan çekebiliyoruz.
 */
$ayar = $db->query("SELECT * FROM ayarlar WHERE ayar_id = 1")->fetch(PDO::FETCH_ASSOC);



// proje dosyamazın için dosyalar klasörüne ihtiyacımız olduğunu belirttik.
if (!is_dir(PROJE_DOSYA)) {
	die("HATA ! Lütfen ana dizinde \"dosyalar\" adında bir dosya oluşturunuz.");
}

// ogrenci girişi varsa her dosyadan ulaşmak için öğrenci değişkeni tanımladık.
if (@$_SESSION['user'] == 'ogrenci' && isset($_SESSION['id'])) {
	$id = $_SESSION['id'];
	$ogrenci = $db->query("SELECT * FROM ogrenciler WHERE ogrenci_id = $id")->fetch(PDO::FETCH_ASSOC);
}


