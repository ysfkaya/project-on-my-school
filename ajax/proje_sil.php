<?php 
    require '../system/database.php';
    require '../system/system.php';
    require '../system/frontend.php';

    if (isPost() && isAjax()){
        $id = post('id');
        $array = array();
        dosyaSil($id);  
        $sil = $db->prepare('DELETE FROM projeler WHERE proje_id = :id');
        $sonuc = $sil->execute(array(
            'id' => $id
        ));         
        if ($sonuc){
            isSession('ogretmen_id') ? null : olay(array("Bir Proje Silindi","proje-sil"),null,getSession('id'));
            $array['basarili'] = "Proje başarıyla silindi.";
        }else{
            $array['hata'] = $db->errorInfo()[0];
        }        
        
        echo json_encode($array);

    }else{
        die("Geçersiz istek");
    }
