<?php 
    require '../system/database.php';
    require '../system/system.php';
    require '../system/frontend.php';

    if (isPost() && isAjax()){
        $id = post('id');
        $proje_id = post('proje_id');
        $array = array();
        $guncelle = $db->prepare('UPDATE ogrenciler SET
            proje_id = :bos
            WHERE ogrenci_id = :id
        ');
        $sonuc = $guncelle->execute(array(
            'bos' => null,
            'id' => $id
        ));
        $guncelle2 = $db->prepare('UPDATE projeler SET
            olusturan_id = :bos
            WHERE olusturan_id = :id');
        $sonuc2 = $guncelle2->execute(array(
            'bos' => null,
            'id' => $id
        ));               
        if ($sonuc && $sonuc2){
            olay(array("Projeden Çıkıldı","proje-cik"),$proje_id,$id);
            $array['basarili'] = "Projeden başarıyla çıkış yapıldı.";
        }else{
            $array['hata'] = $db->erroInfo()[2];
        }        
        
        echo json_encode($array);

    }else{
        die("Geçersiz istek");
    }
