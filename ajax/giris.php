<?php 
    require '../system/database.php';
    require '../system/system.php';
    require '../system/frontend.php';

    if (isPost() && isAjax()){
        $no = post('okul_no');
        $sifre = md5(post('sifre'));
        $array = array();
        $query = $db->prepare("SELECT * FROM ogrenciler WHERE ogrenci_no = :no AND ogrenci_sifre =:sifre");
        $query->execute(array(
            'no' => $no,
            'sifre' => $sifre
        ));
        if ($query->rowCount() > 0) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $session = array(
                'id' => $row['ogrenci_id'],
                'ogrenci_no' => $row['ogrenci_no'],
                'ogrenci_isim' => $row['ogrenci_isim'],
                'ogrenci_eposta' => $row['ogrenci_eposta'],
                'avatar' => $row['resim'],
                'login' => true,
                'user' => 'ogrenci'
            );
            create_session($session);
            $id = $row['ogrenci_id'];
            $date = date('Y-m-d H:i:s');
            $update = $db->prepare("UPDATE ogrenciler SET ogrenci_giris = :tarih WHERE ogrenci_id = :id");
            $update->execute(array(
                'tarih' => $date,
                'id' => $id
            ));
            olay(array("Giriş Yapıldı","giriş"),null,$row['ogrenci_id']);
            $array['basarili'] = 'Giriş Başarıyla Gerçekleştirildi. Yönlendiriliyorsunuz...';
        }else{
            $array['uyari'] = 'Öğrenci numarası veya şifre hatalı';
        }
        
        echo json_encode($array);

    }else{
        die("Geçersiz istek");
    }
