
<?php 
    require '../system/database.php';
    require '../system/system.php';
    require '../system/frontend.php';

    if (isPost() && isAjax()){
        $array = array();
        $gonderen = post('gonderen');
        $baslik = post('baslik',true);
        $alici = post('alici');
        $mesaj = post('mesaj',true);

        $ekle = $db->prepare("INSERT INTO mesajlar SET
            gonderen_id =:gonderen,
            alici_id =:alici,
            mesaj =:mesaj,
            baslik = :baslik,
            tarih =:tarih
            ");
        $sonuc = $ekle->execute(array(
            'gonderen' => $gonderen,
            'baslik' => $baslik,
            'alici'=> $alici,
            'mesaj' => $mesaj,
            'tarih' => date("Y-m-d H:i:s")
            ));

        if ($sonuc) {
            $array['basarili'] = "Mesaj başarıyla gönderildi";
        }else{
            $array['hata'] = "Mesaj gönderme sırasında bir hata meydana geldi".$db->errorInfo()[2];
        }

        echo json_encode($array);

    }else{
        die("Geçersiz istek");
    }
