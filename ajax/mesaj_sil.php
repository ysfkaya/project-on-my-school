<?php 
    require '../system/database.php';
    require '../system/system.php';
    require '../system/frontend.php';

    if (isPost() && isAjax()){
        $array = array();
        $id = post('id');

        $sil = $db->prepare("DELETE FROM  mesajlar WHERE mesaj_id = :id");
        $sonuc = $sil->execute(array(
            'id' => $id
            ));
        if ($sonuc) {
            olay(array("Bir Mesaj Silindi","mesaj-sil"),null,getSession('id'),null);
            $array['silindi'] = true;
        }else{
            $array['hata'] = "Mesaj silme başarısız. ".$db->errorInfo()[2];
        }

        echo json_encode($array);

    }else{
        die("Geçersiz istek");
    }
