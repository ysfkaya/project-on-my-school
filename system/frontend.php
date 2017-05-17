<?php

require 'database.php';


function asset($path)
{
    return URL.'/frontend/'.$path;
}

function url($url = null){
	if (empty($url)) {
		return URL;
	}
	return URL.'/'.'?do='.$url;
}


function frontend_path($path = null){
    if (empty($path)){
        return dir.'frontend/';
    }
    return dir.'frontend/inc/user/'.$path.'.php';
}

function icerikler(){
    global $db;
    global $ogrenci;
    global $ayar;
    $do = get('do') ? get('do') : 'index';

    switch ($do){
        case 'index':
            $yeni_mesajlar = yeni_mesajlar(true);
            $mesajlar = mesajlar(true);
            global $kontrols;
            require_once frontend_path('default');
            break;
        case 'projem':
            // bu değişkenler home.php den çekilmiştir.
            global $proje;
            global $projeCount;
            global $ogrenciler;
            global $kontrols;
            require_once frontend_path('projem');
            break;
        case 'kontrol':

            global $kontrols;
            global $id;
            $proje_id = $id;
            require_once frontend_path('kontrol');
            break;
        case 'mesajlar':
            $mesajlar = mesajlar();
            require_once frontend_path('mesajlar');
            break;
        case 'yeni_mesajlar':
            $mesajlar = yeni_mesajlar();
            require_once frontend_path('yeni_mesajlar');
            break;
        case 'proje-ekle':
            $get = proje_ekle();
            $ogrenciler = $get->fetchAll(PDO::FETCH_ASSOC);
            require_once frontend_path('proje_ekle');
            break;

        case 'ayarlar':
            ayarlar();
            $ogrenci['resim'] = !empty($ogrenci['resim']) ? $ogrenci['resim'] : RESIM_YUKLE.'user.png';
            require_once frontend_path('ayarlar');
            break;
        case 'cikis':
            require_once frontend_path('logout');
            break;
        default:
            go('404.php');
            break;
    }
}

function proje(){
    global $db;
    if (isPost() && post('proje') == true) {
        
        $array = array(
            'proje_id' => post('proje_id'),
            'proje_konu' => post('proje_konu'),
            'proje_amac' => post('proje_amac'),
            'proje_tur' => post('proje_tur')
        );

        $guncelle = $db->prepare("UPDATE projeler SET
            proje_konu = :proje_konu,
            proje_amac = :proje_amac,
            proje_tur = :proje_tur
            WHERE proje_id = :proje_id");
        $g1 = $guncelle->execute($array);
        $g2 = true;
        $g3 = true;
        if (post('proje_tur') == 0) {
            $guncelle2 = $db->prepare('UPDATE ogrenciler SET
                proje_id = :bos
                WHERE proje_id != :id');
            $G2 = $guncelle2->execute(array(
                'bos' => null,
                'id' => getSession('id')    
            ));
            if ($G2) {   
                $guncelle3 = $db->prepare('UPDATE ogrenciler SET
                    proje_id = :proje_id
                    WHERE ogrenci_id = :ogrenci_id');
                $G3 = $guncelle3->execute(array(
                    'proje_id' => post('proje_id'),
                    'ogrenci_id' => getSession('id')  
                ));
            }
            if (!$G2 && !$G3) {
                 $g2 = false;
             } 
        }
        if (post('proje_ekip')) {
            $ekip = post('proje_ekip');
            foreach ($ekip as $key => $value) {
                $guncelle4 = $db->prepare("UPDATE ogrenciler SET
                    proje_id = :proje
                    WHERE ogrenci_id = :id");
                $G4 = $guncelle4->execute(array(
                    'proje' => post('proje_id'),
                    'id' => $value
                ));
                if (!$G4) {
                    $g3 = false;
                }
            }
        }

        if ($g1 && $g2 && $g3) {
            olay(array("Proje Güncellendi","proje-güncellendi"),post('proje_id'),getSession('id'));
            success('Güncelleme başarılı. Yönlendiriliyorsunuz');
            go(url('projem'),2);
        }else{
            error('Güncelleme başarısız'.$db->errorInfo()[2]);
        }

    }
    $ogrenci_id = getSession('id');
    $proje = $db->query("SELECT * FROM projeler WHERE proje_id = (SELECT proje_id FROM ogrenciler WHERE ogrenci_id = {$ogrenci_id})");
    $ogrenciler = $db->query("SELECT ogrenci_isim,ogrenci_id,proje_id FROM ogrenciler");
    return array($proje,$ogrenciler);
}

function proje_ekle(){
    global $db;
    global $ogrenci;
    if ($ogrenci['proje_id'] != null) {
        go(url('projem'));
    }
    if (isPost() && post('proje_ekle') == true) {
        $tur = post('proje_tur');
        $ekip = post('proje_ekip') && !empty(post('proje_ekip')) ? post('proje_ekip') : null;
        $konu = post('proje_konu');
        $amac = post('proje_amac');
        $id = getSession('id');
        $s = true;
        $dosya = $id.' - '.$konu;
        $dosya = PROJE_DOSYA.$dosya;


        $ekle = $db->prepare("INSERT INTO projeler SET
                proje_tur = :tur,
                proje_konu = :konu,
                proje_amac = :amac,
                olusturan_id = :id,
                proje_dosya = :dosya   
            ");
        $sonuc = $ekle->execute(array(
                'tur' => $tur,
                'konu' => $konu,
                'amac' => $amac,
                'id' => $id,
                'dosya' => $dosya
            ));

        $proje_id = $db->lastInsertId();

        if ($ekip != null) {
            $ekip[] = getSession('id');
            foreach ($ekip as $key => $value){
                $guncelle = $db->prepare("UPDATE ogrenciler SET
                    proje_id = :id"
                    );
                $s1 = $guncelle->execute(array(
                    'id' => $proje_id
                    ));
                if (!$s1) {
                    $s = false;
                }
            }
            olay(array("Proje Ekibi Oluşturuldu","proje-ekip"),$proje_id,getSession('id'));
        }else{
            $guncelle = $db->prepare("UPDATE ogrenciler SET
                    proje_id = :id
                    WHERE ogrenci_id = :ogrenci");
            $s1 = $guncelle->execute(array(
                    'id' => $proje_id,
                    'ogrenci' => $id
                ));
            if (!$s1) {
                $s = false;
            }
        }
        if ($sonuc && $s) {
            olay(array("Proje Eklendi","proje-eklendi"),$proje_id,getSession('id'));
            mkdir($dosya,0777);
            success('Proje başarıyla eklendi. Yönlendiriliyorsunuz.');
            go(url('projem'),2);
        }else{
            error("Proje ekleme hatası".$db->errorInfo()[2]);
        }

    }

    $ogrenciler = $db->query("SELECT ogrenci_isim,ogrenci_id,proje_id FROM ogrenciler");

    return $ogrenciler;
}

function ayarlar(){
    global $db;
    global $ogrenci;
    if (isPost() && post('ayarlar') == true) {
        $no = post('ogrenci_no');
        $id = getSession('id');
        $kontrol = $db->prepare("SELECT * FROM ogrenciler WHERE ogrenci_no = :no AND ogrenci_id != :id");
        $sonuc = $kontrol->execute(array(
            'no' => $no,
            'id' => getSession('id')
            ));
        if ($kontrol->rowCount() > 0 ) {
            error('Girdiğiniz okul numarası başka bir öğrenci tarafından kullanılmaktadır. Lütfen başka bir öğrenci numarası giriniz');
        }
        $isim = post('ogrenci_isim');
        $dosya = dosya('resim');
        
        if (count(array_filter($dosya)) > 1) {
            $yukle = dosyaYukle(RESIM,$dosya,RESIM_YUKLE);
            $resim = $yukle;
        }else{
            if (empty($ogrenci['resim'])) {
                $resim = RESIM_YUKLE."user.png";
            }else{
                $resim = $ogrenci['resim'];
            }
        }
        $guncelle = $db->prepare("UPDATE ogrenciler SET
                ogrenci_no = :no,
                ogrenci_isim = :isim,
                resim = :resim
            WHERE ogrenci_id = :id");
        $etki = $guncelle->execute(array(
                'no' => $no,
                'isim' => $isim,
                'resim' => $resim,
                'id' => $id
            ));
        if ($etki) {
            olay(array("Profil Güncellendi","profil-güncellendi"),null,$id);
            success('Güncelleme işlemi başarıyla gerçekleştirildi.');
            go(url('ayarlar'),2);
        }else{
            error($db->errorInfo()[2]);
        }
    }
}


function dosyaSil($id){
    global $db;
    $query = $db->prepare("SELECT * FROM projeler WHERE proje_id = :id");
    $query->execute(array(
        'id' => $id
    ));

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $dir = $row['proje_dosya'];
    if (is_dir($dir)) {
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!unlink($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        rmdir($dir);
    }
}

function yeni_mesajlar($type = false){
    global $db;
    $id = getSession('id');
    $query = $db->query("SELECT * FROM mesajlar INNER JOIN ogretmenler ON ogretmenler.ogretmen_id = mesajlar.gonderen_id WHERE mesajlar.okuma = 0 AND mesajlar.alici_id = $id");

    if ($type == true) {
        return $query->rowCount();
    }
    return $query;
    
}
function mesajlar($type = false){
    global $db;
    $id = getSession('id');
    $query = $db->query("SELECT * FROM mesajlar INNER JOIN ogretmenler ON ogretmenler.ogretmen_id = mesajlar.gonderen_id WHERE mesajlar.alici_id = $id");

    if ($type == true) {
        return $query->rowCount();
    }
    return $query;
    
}

function dosya_listele($id,$type = false){
    global $db;
    $liste = array();
    $dosya = $db->query("SELECT * FROM dosyalar WHERE proje_id = $id")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dosya as $key => $value) {
        $liste[] = $value['dosya_link']; 
    }

    if ($type == true) {
        return $dosya;
    }

    return $liste;
}


