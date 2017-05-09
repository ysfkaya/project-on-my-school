<?php

require '../system/database.php';
require '../system/system.php';
require '../packages/PHPMailler/class.phpmailer.php';
require '../packages/PHPMailler/PHPMailerAutoload.php';

if (isPost() && isAjax()){
    $array = array();
    $ad = post('ad');
    $no = post('no');
    $eposta = post('eposta');

    if (post('kayityap') == true){
            $kayit_array = array();
            $query = $db->prepare("INSERT INTO ogrenciler SET
                  ogrenci_no =:numara,
                  ogrenci_isim = :ad,
                  ogrenci_eposta = :eposta,
                  ogrenci_sifre = :sifre,
                  ogrenci_kayit = :kayit
              ");
            $query->execute(array(
                'numara' => post('kayit')['numara'],
                'ad' => post('kayit')['ad'],
                'eposta' => post('kayit')['eposta'],
                'sifre' => post('kayit')['sifre'],
                'kayit' => post('kayit')['kayit']
            ));
            if ($query->rowCount() > 0) {
                olay(array("Kayıt Olundu","kayıt"),null,$db->lastInsertId());
                $kayit_array['basarili'] = 'Kayıt başarıyla oluşturuldu. Giriş yapmak için lütfen eposta adresinizdeki şifreyle giriniz.';
            }else{
                $kayit_array['hata'] = ':'.$db->errorInfo();
            }
            echo json_encode($kayit_array);
    }else{
        if (!is_numeric($no)) {
            $array['hata'] = 'Lütfen okul numaranız sadece sayısal değerleri içersin.';
        }else{
            $sifre = uniqid();
            $og_no = $db->prepare("SELECT * FROM ogrenciler WHERE ogrenci_no = :no");
            $og_no->execute(array(
                'no' => $no
            ));

            $og_eposta = $db->prepare("SELECT * FROM ogrenciler WHERE ogrenci_eposta = :eposta");
            $og_eposta->execute(array(
                'eposta' => $eposta
            ));

            if ($og_no->rowCount() > 0){
                $array['var'] = 'Girdiğiniz okul numarası ile bir öğrenci sistemde kayıtlı. Giriş yapmak istiyorsanız eposta adresinize gönderilen şifre ile giriş yapabilirsiniz';
            }else if ($og_eposta->rowCount() > 0){
                $array['var'] = 'Girdiğiniz eposta ile bir öğrenci sistemde kayıtlı. Giriş yapmak istiyorsanız eposta adresinize gönderilen şifre ile giriş yapabilirsiniz';
            }else{

                $kod = md5($eposta.$sifre.$ad.date("Y-m-d H:i:s"));
                $gonder = mailGonder($eposta,$ad,$sifre,$kod,true);
                if ($gonder){
                    $array['kod'] = $kod;
                    $array['onay'] = true;
                    $array['kayit'] = array(
                        'numara' => $no,
                        'ad' => $ad,
                        'eposta' => $eposta,
                        'sifre' => md5($sifre),
                        'kayit' => date('Y-m-d H:i:s')
                    );
                }else{
                    $array['hata'] = $mail->ErrorInfo;
                }
            }
        }

        echo json_encode($array);

    }

}else{
    die("Geçersiz istek");
}