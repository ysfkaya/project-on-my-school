<?php 
    require '../system/database.php';
    require '../system/system.php';
    require '../system/frontend.php';

    if (isPost() && isAjax()){
        $id = post('id');
        $mevcut_sifre = md5(post('mevcut_sifre'));
        $yeni_sifre = md5(post('yeni_sifre'));
        $array = array();

        $sorgu = $db->prepare("SELECT * FROM ogrenciler WHERE ogrenci_sifre != :sifre AND ogrenci_id = :id");
         $sorgu->execute(array(
            'sifre' => $mevcut_sifre,
            'id' => $id
            ));
        if ($sorgu->rowCount() > 0) {
            $array['hata'] = "Girdiğiniz mevcut şifre uyuşmuyor";
        }else{
            $guncelle = $db->prepare("UPDATE ogrenciler SET
                ogrenci_sifre = :yeni_sifre
                WHERE ogrenci_id = :id");
            $etki = $guncelle->execute(array(
                'yeni_sifre' => $yeni_sifre,
                'id' => $id
                ));
            if ($etki) {
                olay(array("Şifre Değiştirildi","sifre-degis"),null,$id);
                $array['basarili'] = 'Şifre başarıyla değiştirildi';
            }else{
                $array['hata'] = 'Ekleme işleminde hata! '.$db->errorInfo()[2];
            }
        }
        
        echo json_encode($array);

    }else{
        die("Geçersiz istek");
    }
