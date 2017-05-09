<?php
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği?") : null;

$proje_id = get('proje_id');
$files = dosya_isle($proje_id);
foreach ($files as $value) {
	if(file_exists($value['dosya_yol']) && is_file($value['dosya_yol']))
	{
	    header('Content-Description: File Transfer');
	    header('Content-Type:'.$value['dosya_uzantı']);
	    header('Content-Disposition: attachment; filename="'.$value['dosya_ad'].'"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . $value['dosya_boyut']);
	    readfile($value['dosya_yol']);
	}
	else {
	    die("Hata : ".$value['dosya_ad']." mevcut değil");
	}
}
?>