<?php 
    require '../system/database.php';
    require '../system/system.php';
    require '../system/frontend.php';

    if (isPost() && isAjax()){
        $array = array();
        $id = post('id');

        $sil = $db->prepare("DELETE FROM  olaylar WHERE olay_id = :id");
        $sonuc = $sil->execute(array(
            'id' => $id
            ));
        if ($sonuc) {
            $array['silindi'] = true;
        }else{
            $array['hata'] = "Olay silme başarısız. ".$db->errorInfo()[2];
        }

        echo json_encode($array);

    }else{
        die("Geçersiz istek");
    }
