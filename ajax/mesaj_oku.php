

<?php 
    require '../system/database.php';
    require '../system/system.php';
    require '../system/frontend.php';

    if (isPost() && isAjax()){
        $array = array();
        $id = post('id');

        $guncelle = $db->prepare("UPDATE mesajlar SET
            okuma = :okuma
            WHERE mesaj_id = :id");
        $sonuc = $guncelle->execute(array(
            'okuma' => 1,
            'id' => $id
            ));
        if ($sonuc) {
            olay(array("Mesaj Okundu","mesaj-oku"),null,getSession('id'),$id);
            $sorgu = $db->query("SELECT * FROM mesajlar WHERE mesaj_id = $id");
            $row = $sorgu->fetch(PDO::FETCH_ASSOC);
            $array['okundu'] = true;
            $array['baslik'] = strip_tags(ss($row['baslik']));
            $array['mesaj'] = ss($row['mesaj']);
        }else{
            $array['hata'] = "Mesaj okuma başarısız. ".$db->errorInfo()[2];
        }

        echo json_encode($array);

    }else{
        die("Geçersiz istek");
    }
