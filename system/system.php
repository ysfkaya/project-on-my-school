<?php 

/**
 * POST isteklerinde xss ve ajax işlemlerinde güvenlik önlemleri için oluşturulmuştur.
 * @param  $par POST edilen değeri alır
 * @param  $text Html etiketlerini kaydetmek istediğimizde değerini true yaparız.
 * @return void
 */
function post($par,$text = false){
    if (is_array($_POST[$par])){
        return array_map(function ($item){
            if ($text === true) {
                $post = addslashes(trim($item)); 
            }else{
                $post = htmlspecialchars(addslashes(trim($item)),ENT_COMPAT,"UTF-8",false);
            }
            return $post;
        },$_POST[$par]);
    }else{
        if ($text === true) {
            $post = addslashes(trim($_POST[$par])); 
        }else{
            $post = htmlspecialchars(addslashes(trim($_POST[$par])),ENT_COMPAT,"UTF-8",false);
        }
        return $post;
     
    }

}
/**
 * GET isteklerinde xss ve ajax işlemlerinde güvenlik önlemleri için oluşturulmuştur.
 * @param  $par GET edilen değeri alır
 * @param  $text Html etiketlerini kaydetmek istediğimizde değerini true yaparız.
 * @return void
 */
function get($par,$text = false){
    if (is_array($_POST[$par])){
        return array_map(function ($item){
            if ($text === true) {
                $post = addslashes(trim($item)); 
            }else{
                $post = htmlspecialchars(addslashes(trim($item)),ENT_COMPAT,"UTF-8",false);
            }
            return $post;
        },$_GET[$par]);
    }else{
        if ($text === true) {
            $post = addslashes(trim($_GET[$par])); 
        }else{
            $post = htmlspecialchars(addslashes(trim($_GET[$par])),ENT_COMPAT,"UTF-8",false);
        }
        return $post;
     
    }

}


/**
 * Session verilerini toplu bir şekilde oluşturur.
 * @param  array $param oluşturulacak sessionlar.
 * @return void
 */
function create_session(array $param){
    foreach ($param as $key => $value){
        $_SESSION[$key] = $value;
    }

}
/**
 * Post ve get işlemleri yaparken verileri veritabanına xss açığını önlemek için '\' ters slash ile ekliyoruz
 * bu verileri geri çekerken slashlar veya etiketler (<p>,<b>,<i> vs..) kullanıcıya gözükebiliyor. 
 * Bu yüzden de bu fonksiyonda slashları kaldırılıyor.
 * @param  $par
 * @return void
 */
function ss($par){
    
    return stripslashes($par);
}
/**
 * Session verilerini alır.
 * @param  $param girilen elemanı çeker.
 * @return void
 */
function getSession($param){
    if (isset($_SESSION[$param])){
        return $_SESSION[$param];
    }
    if (empty($param)) {
        return $_SESSION;
    }
    return null;

}

/**
 * Session değerinin olup olmadığını kontrol eder.
 * @param  $param
 * @return boolean       
 */
function isSession($param){
    if (isset($_SESSION[$param]) && $_SESSION[$param] != ''){
        return true;
    }
    return false;

}
/**
 * Ajax isteğini kontrol eder.
 * @return boolean
 */
function isAjax(){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest"){
            return true;
        }

        return false;

}

/**
 * Yönlendirme işlemlerinde kullanılır.
 * @param  string   $url  Gidilecek url
 * @param  integer  $time Kaç saniye sonra yönlendireleceğini belirler.
 * @return void        
 */
function go($url,$time = null){
    if ($time){
        return header("Refresh:{$time};url={$url}");
    }else{
        return header("Location:{$url}");
    }

}

/**
 * Uyarı mesajı
 * @param  $message Kullanıcaya gösterilecek mesaj
 * @param  $margin  Style ayarı.
 */
function warning($message,$margin='20px'){
    $html = '<div class="alert alert-warning" style="margin-bottom:'.$margin.'" role="alert">';
    $html .=  '<strong>Uyarı !</strong> '.$message;
    $html .= '</div>';

    echo $html;

}

/**
 * Bilgi mesajı
 * @param  $message Kullanıcaya gösterilecek mesaj
 * @param  $margin  Style ayarı.
 */
function info($message,$margin='20px'){
    $html = '<div class="alert alert-info" style="margin-bottom:'.$margin.'" role="alert">';
    $html .=  '<strong>Bilgi !</strong> '.$message;
    $html .= '</div>';

    echo $html;

}

/**
 * Başarı mesajı
 * @param  $message Kullanıcaya gösterilecek mesaj
 * @param  $margin  Style ayarı.
 */
function success($message){
    $html = '<div class="alert alert-success" role="alert">';
    $html .=  '<strong>Başarılı !</strong> '.$message;
    $html .= '</div>';

    echo $html;

}

/**
 * Hata mesajı
 * @param  $message Kullanıcaya gösterilecek mesaj
 * @param  $margin  Style ayarı
 */
function error($message){
    $html = '<div class="alert alert-danger" role="alert">';
    $html .=  '<strong>Hata !</strong> '.$message;
    $html .= '</div>';

    echo $html;

}

/**
 * Kullanıcı girişini kontrol eder
 * @return boolean
 */
function isLogin(){
    if (isSession('login')){
        return true;
    }
    return false;

}

/**
 * Post isteğini kontrol eder.
 * @return boolean
 */
function isPost(){
    if ($_POST){
        return true;
    }

    return false;

}

/**
 * Öğretmen girişini kontrol eder.
 * @return boolean
 */
function isAdmin(){
    if (getSession('user') == 'admin'){
        return true;
    }
    return false;

}

/**
 * Öğrenci girişin kontrol eder.
 * @return boolean
 */
function isUSer(){
    if (getSession('user') == 'ogrenci') {
        return true;
    }

    return false;

}

/**
 * Tarih gösterme fonksiyonu. (26 May 2017)
 * @param  $date 
 * @param  boolean $saat
 * @return void       
 */
function myDate($date,$saat = false){
    $time = explode(' ',$date);
    $left = explode('-',$time[0]);
    $right = explode(':',$time[1]);
    $year = $left[0];
    $day = $left[2];
    $hour = $right[0];
    $minute = $right[1];
    $second = $right[2];
    switch ($left[1]){
        case 1;
            $month = 'Ock';
            break;

        case 2;
            $month = 'Şub';
            break;

        case 3;
            $month = 'Mar';
            break;

        case 4;
            $month = 'Nis';
            break;

        case 5;
            $month = 'May';
            break;

        case 6;
            $month = 'Haz';
            break;

        case 7;
            $month = 'Tem';
            break;

        case 8;
            $month = 'Auğ';
            break;

        case 9;
            $month = 'Eyl';
            break;

        case 10;
            $month = 'Eki';
            break;

        case 11;
            $month = 'Kas';
            break;

        case 12;
            $month = 'Ara';
            break;
        default:
            $month = 'tanımsız';
            break;
    }

    if ($saat == false) {
        $fulltime = $day." ".$month." ".$year." &nbsp;".$hour.":".$minute;
    }else{
        $fulltime = $day." ".$month." ".$year." &nbsp;".$hour.":".$minute.":".$second;
    }
    return $fulltime;

}

/**
 * $_FILES değişkeni ile aynı işlevi görür. Pratikleştirmek için tanımlanmıştır.
 * @param  [type] $param
 * @return boolean|array       
 */
function dosya($param){
    if (isset($_FILES[$param]) && !empty($_FILES[$param])) {
        $array = array();
        $array['adı'] = $_FILES[$param]['name'];
        $array['tür'] = $_FILES[$param]['type'];
        $array['tam_yol'] = $_FILES[$param]['tmp_name'];
        $array['boyut'] = $_FILES[$param]['size'];
        $array['hata'] = $_FILES[$param]['error'];

        return $array;
    }
    return false;

}

/**
 * Dosya yükleme işlemi.
 * @param  $dizin  Kaydedilecek yer.
 * @param  $dosya  Post edilen dosya.
 * @param  $buraya Kaydedilen yerin url adresi.
 * @param  $name   Kaydedilecek dosyanın ismi. Boş ise şuanki zaman varsayılarak bir ad oluşturulur.
 * @return boolean|string        
 */
function dosyaYukle($dizin,$dosya,$buraya,$name = null){

    if (!empty($dosya) && !empty($dizin)){
        $tam_yol = $dosya['tam_yol'];
        $mimetype = substr($dosya['adı'], -4,4);
        $adı = time().$mimetype;
        if (!empty($name)) {
            $yukle = $dizin.$name.$mimetype;            
        }else{
            $yukle = $dizin.$adı;
        }
        if (move_uploaded_file($tam_yol, $yukle)){
            if (!empty($name)) {
                return $buraya.$name.$mimetype;            
            }else{
                return $buraya.$adı;
            }
        }else {
            return false;
        }  
    }

    return false;

}


/**
 * Mail gönderme işlemi
 * @param  string  $eposta      Gönderilecek e-posta adresi
 * @param  string  $ad          Gönderilecek kişinin adı
 * @param  string  $sifre       Kayıt olan kişinin şifresi için tanımlanmıştır. 
 * @param  string  $kod         Rastegele oluşturulmuş kod.
 * @param  boolean $sifreGonder False ise şifre göndermez. True ise şifre gönderir.
 * @param  string  $baslik      Mail başlığı
 * @return boolean               
 */
function mailGonder($eposta,$ad,$sifre = null,$kod,$sifreGonder = false,$baslik = 'Proje Takibim Mail Doğrulama Kodu ve Şifre'){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.live.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'projetakibim@hotmail.com';
    $mail->Password = 'projem012';
    $mail->setFrom($mail->Username,'Proje Takibim');
    $mail->addAddress($eposta,$ad);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $baslik;
    if ($sifre != null && $sifreGonder == true) {
        $content = '
            <center>
                <div style="width:1000px;height:50px;padding: 20px 30px; font-size: 30px;background:#eee;border:3px solid #eee;">
                        Merhaba <b>'.$ad.'</b>
                </div>
                <div style="width:1000px;height:100px;padding: 20px 30px; font-size: 20px;background:#fff;border:3px solid #eee;">
                           Onay Kodunuz:<b>'.$kod.'</b>
                           <br><br>
                           Şifreniz: <b>'.$sifre.'</b>
                </div>
            </center>
        ';
    }else{
        $content = '
            <center>
                <div style="width:1000px;height:50px;padding: 20px 30px; font-size: 30px;background:#eee;border:3px solid #eee;">
                        Merhaba <b>'.$ad.'</b>
                </div>
                <div style="width:1000px;height:100px;padding: 20px 30px; font-size: 20px;background:#fff;border:3px solid #eee;">
                           Onay Kodunuz:<b>'.$kod.'</b>
                </div>
            </center>
        ';
    }
    $mail->msgHTML($content);
    
    return $mail->send() ? true : $mail->ErrorInfo;

}

/**
 * Veritabanındaki olaylar tablosuna veri girişi yapar.
 * @param  array  $olay       Yapılan olaylar. örn: ["Giriş Yapıldı","giriş-yap"]
 * @param  [type] $proje_id   Proje id
 * @param  [type] $ogrenci_id Öğrenci id
 * @param  [type] $mesaj_id   Mesaj id
 * @param  [type] $dosya_id   Dosya id
 * @return void
 */
function olay($olay = array(),$proje_id = null , $ogrenci_id = null,$mesaj_id = null,$dosya_id = null){
    global $db;
    $tarih = date("Y-m-d H:i:s");
    filter($proje_id);
    filter($mesaj_id);
    filter($ogrenci_id);
    filter($dosya_id);
    $ekle = $db->prepare("INSERT INTO olaylar SET
        proje_id = :proje,
        ogrenci_id = :ogrenci,
        mesaj_id = :mesaj,
        dosya_id = :dosya,
        olay = :olay,
        olay_tip = :tip,
        olay_tarih = :tarih
        ");
    $ekle->execute(array(
        'proje' => $proje_id,
        'ogrenci' => $ogrenci_id,
        'mesaj' => $mesaj_id,
        'dosya' => $dosya_id,
        'olay' => $olay[0],
        'tip' => $olay[1],
        'tarih' => $tarih
        ));

}

/**
 * String olan değişkeni integer değişkene dönüştürur.  
 * @param  &$input
 * @return void
 */
function filter (&$input) {
    if (!is_int($input) && !is_null($input)){
        settype($input,'int');
    }

}
