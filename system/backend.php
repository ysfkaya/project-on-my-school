<?php

require 'database.php';


function url($url = null){
    if (!empty($url)){
        return BACKEND_URL.$url;
    }
    return BACKEND_URL;
}

function file_list($proje_id){
    global $db;

    return $db->query("SELECT * FROM dosyalar WHERE proje_id = $proje_id")->fetchAll(PDO::FETCH_ASSOC);

}

function dosya_isle($proje_id){
    global $db;

    $query = $db->prepare("SELECT * FROM dosyalar WHERE proje_id = :proje_id");
    $query->execute(array(
        'proje_id' => $proje_id
        ));
    if ($query->rowCount() > 0) {
        return  $query->fetchAll(PDO::FETCH_ASSOC);
        
    }

    return;
}


function olay_girdi($tip,$olay){
    global $db;
    switch ($tip) {
        case 'giriş':
        $ogrenci_id = $olay['ogrenci_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci giriş yaptı.";    
        
        case 'çıkış':
        $ogrenci_id = $olay['ogrenci_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci çıkış yaptı."; 

        case 'dosya-sil':
        $ogrenci_id = $olay['ogrenci_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci projesinden bir dosya sildi."; 

        case 'dosya-yukle':
        $ogrenci_id = $olay['ogrenci_id'];
        $proje_id = $olay['proje_id'];
        $dosya_id = $olay['dosya_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no,dosyalar.dosya_ad,projeler.proje_konu FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id LEFT JOIN projeler ON projeler.proje_id = $proje_id LEFT JOIN dosyalar ON dosyalar.dosya_id = $dosya_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci <strong>".$bagla['proje_konu']."</strong> adlı projesine <strong>".$bagla['dosya_ad']."</strong> dosyasını ekledi.";

        case 'eposta-degistirildi':
        $ogrenci_id = $olay['ogrenci_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci eposta adresini değiştirdi.";

        case 'kayıt':
        $ogrenci_id = $olay['ogrenci_id'];        
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci kayıt oldu.";

        case 'mesaj-oku':
        $ogrenci_id = $olay['ogrenci_id'];
        $mesaj_id = $olay['mesaj_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no,mesajlar.baslik FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id LEFT JOIN mesajlar ON mesajlar.mesaj_id = $mesaj_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci <strong>".$bagla['baslik']."</strong> adlı mesajını okudu.";

        case 'mesaj-sil':
        $ogrenci_id = $olay['ogrenci_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci bir mesajı sildi.";

        case 'proje-sil':
        $ogrenci_id = $olay['ogrenci_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci bir proje sildi.";

        case 'proje-cik':
        $ogrenci_id = $olay['ogrenci_id'];
        $proje_id = $olay['proje_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no,projeler.proje_konu FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id LEFT JOIN projeler ON projeler.proje_id = $proje_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci <strong>".$bagla['proje_konu']."</strong> adlı projeden çıktı.";

        case 'sifre-degis':
        $ogrenci_id = $olay['ogrenci_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci şiresini değiştirdi.";

        case 'proje-güncellendi':
        $ogrenci_id = $olay['ogrenci_id'];
        $proje_id = $olay['proje_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no,projeler.proje_konu FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id LEFT JOIN projeler ON projeler.proje_id = $proje_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci <strong>".$bagla['proje_konu']."</strong> adlı projeyi güncelledi.";


        case 'proje-ekip':
        $ogrenci_id = $olay['ogrenci_id'];
        $proje_id = $olay['proje_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no,projeler.proje_konu FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id LEFT JOIN projeler ON projeler.proje_id = $proje_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci <strong>".$bagla['proje_konu']."</strong> adlı projede proje ekibi oluşturdu.";


        case 'proje-eklendi':
        $ogrenci_id = $olay['ogrenci_id'];
        $proje_id = $olay['proje_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no,projeler.proje_konu FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id LEFT JOIN projeler ON projeler.proje_id = $proje_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci <strong>".$bagla['proje_konu']."</strong> adlı yeni bir proje oluşturdu.";

        case 'profil-güncellendi':
        $ogrenci_id = $olay['ogrenci_id'];
        $bagla = $db->query("SELECT ogrenciler.ogrenci_no FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = $ogrenci_id")->fetch(PDO::FETCH_ASSOC);
        return  "<strong>".$bagla['ogrenci_no']."</strong> numaralı öğrenci profilini güncelledi.";

        

        default:
            return "tanımsız";
    }


}





