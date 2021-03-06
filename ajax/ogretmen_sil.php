<?php 
    require '../system/database.php';
    require '../system/system.php';
    require '../system/frontend.php';

    if (isPost() && isAjax()){
        $id = post('id');
        $array = array();  
        $sil = $db->prepare('DELETE FROM ogretmenler WHERE ogretmen_id = :id');
        $sonuc = $sil->execute(array(
            'id' => $id
        ));         
        if ($sonuc){
            $array['basarili'] = "Öğretmen başarıyla silindi.";
        }else{
            $array['hata'] = $db->erroInfo()[2];
        }        
        
        echo json_encode($array);

    }else{
        die("Geçersiz istek");
    }
