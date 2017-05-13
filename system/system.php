<?php


function post($par){
    if (is_array($_POST[$par])){
        return array_map(function ($item){
            return htmlspecialchars(addslashes(trim($item)),ENT_COMPAT,"UTF-8",false);
        },$_POST[$par]);
    }else{
        return htmlspecialchars(addslashes(trim($_POST[$par])),ENT_COMPAT,"UTF-8",false);
    }

}


function get($par){
    if (is_array($_GET[$par])){
        return array_map(function ($item){
            return htmlspecialchars(addslashes(trim($item)),ENT_COMPAT,"UTF-8",false);
        },$_GET[$par]);
    }else{
        return htmlspecialchars(addslashes(trim($_GET[$par])),ENT_COMPAT,"UTF-8",false);
    }
}

function ss($par){
    return stripslashes($par);
}

function create_session($param = array()){
    foreach ($param as $key => $value){
        $_SESSION[$key] = $value;
    }
}

function getSession($param){
    if (isset($_SESSION[$param])){
        return $_SESSION[$param];
    }
    if (empty($param)) {
        return $_SESSION;
    }
    return null;
}

function isSession($param){
    if (isset($_SESSION[$param]) && $_SESSION[$param] != ''){
        return true;
    }
    return false;
}

function isAjax(){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])){
            return true;
        }

        return false;
}


function create_cookie($param,$time = 3){
    foreach ($param as $key => $value) {
        setcookie($key,$value,time()+($time));
    }
}

function getCookie($cookie){
    if (isset($_COOKIE[$cookie])  ) {
        return $_COOKIE[$cookie];
    }
    return false;
}


function go($url,$time = null){
    if ($time){
        return header("Refresh:{$time};url={$url}");
    }else{
        return header("Location:{$url}");
    }
}


function warning($message,$margin='20px'){
    $html = '<div class="alert alert-warning" style="margin-bottom:'.$margin.'" role="alert">';
    $html .=  '<strong>Uyarı !</strong> '.$message;
    $html .= '</div>';

    echo $html;
}

function info($message,$margin='20px'){
    $html = '<div class="alert alert-info" style="margin-bottom:'.$margin.'" role="alert">';
    $html .=  '<strong>Bilgi !</strong> '.$message;
    $html .= '</div>';

    echo $html;
}

function success($message){
    $html = '<div class="alert alert-success" role="alert">';
    $html .=  '<strong>Başarılı !</strong> '.$message;
    $html .= '</div>';

    echo $html;
}

function error($message){
    $html = '<div class="alert alert-danger" role="alert">';
    $html .=  '<strong>Hata !</strong> '.$message;
    $html .= '</div>';

    echo $html;
}


function isLogin(){
    if (isSession('login')){
        return true;
    }
    return false;
}


function isPost(){
    if ($_POST){
        return true;
    }

    return false;

}

function isAdmin(){
    if (getSession('user') == 'admin'){
        return true;
    }
    return false;
}

function isUSer()
{
    if (getSession('user') == 'ogrenci') {
        return true;
    }

    return false;
}

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

function dosya($param)
{
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

function dosyaYukle($dizin,$dosya,$buraya,$name = null)
{

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

function mailGonder($eposta,
                    $ad,
                    $sifre = null,
                    $kod,
                    $sifreGonder = false,
                    $baslik = 'Proje Takibim Mail Doğrulama Kodu ve Şifre')
{
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

function olay($olay = array(),$proje_id = null , $ogrenci_id = null,$mesaj_id = null,$dosya_id = null){
    global $db;
    $tarih = date("Y-m-d H:i:s");
    filter($proje_id);
    filter($mesaj_id);
    filter($ogrenci_id);
    filter($mesaj_id);
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


function filter (&$input) {
    if (!is_int($input) && !is_null($input)){
        settype($input,'int');
    }

}
