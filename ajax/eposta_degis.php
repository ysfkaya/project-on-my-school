<?php

require '../system/database.php';
require '../system/system.php';
require '../packages/PHPMailler/class.phpmailer.php';
require '../packages/PHPMailler/PHPMailerAutoload.php';

if (isPost() && isAjax()){
    $array = array();
    $id = getSession('id');
    $eposta = post('eposta');
    $no = getSession('ogrenci_no');
    $isim = getSession('ogrenci_isim'); 

    if (post('eposta_degis') == true){
            $kayit_array = array();
            $query = $db->prepare("UPDATE ogrenciler SET
                ogrenci_eposta = :eposta
                WHERE ogrenci_id = :id");
            $query->execute(array(
                'eposta' => $eposta,
                'id' => $id
            ));
            if ($query->rowCount() > 0) {
                olay(array("Eposta Değiştirdi","eposta-degistirildi"),null,$id);
                $kayit_array['basarili'] = 'Eposta başarıyla değiştirildi.';
            }else{
                $kayit_array['hata'] = ':'.$db->errorInfo();
            }
            echo json_encode($kayit_array);
    }else{

        $sorgu = $db->prepare("SELECT * FROM ogrenciler WHERE ogrenci_eposta = :eposta");
        $sorgu->execute(array(
            'eposta' => $eposta
        ));
        if ($sorgu->rowCount() > 0) {
            $array['var'] = 'Girdiğiniz eposta adresi başka bir öğrenci tarafından kullanılıyor lütfen başka bir eposta adresi giriniz.';
        }else{
            $kod = md5($eposta.$no.$isim.date("Y-m-d H:i:s"));
            $gonder = mailGonder($eposta,$isim,null,$kod,false,'Eposta Onay Kodu');
            if ($gonder === true){
                $array['kod'] = $kod;
                $array['gonderildi'] = true;
            }else{
                $array['hata'] = mailGonder($eposta,$isim,null,$kod,false,'Eposta Onay Kodu');
            }
        }

        echo json_encode($array);
    }



}else{
    die("Geçersiz istek");
}