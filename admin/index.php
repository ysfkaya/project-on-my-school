<?php

    require '../system/backend.php';
    require '../system/system.php';

    if(isLogin() && isAdmin()){ // admin oturumu oluşturulmuş ise güvenlik işin sabit tanımlıyoruz
        define('ADMIN',true);
    }else if (isUSer()){
        die("Kullanıcı girişi mevcut. Lütfen ilk önce oturumu kapatınız...");
    }
    else{// giriş yok ise direkt giris.php ye yönlendiriyoruz.
        go(url('giris.php'));
    }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$ayar['site_baslik'];?> - Admin Paneli</title>

    <?php require_once 'partials/styles.php'; // style dosyaları?>
  </head>
  <body>
    <?php require 'partials/navbar.php'; ?>
    <?php require 'partials/subnavbar.php'; ?>
    <div class="container<?= get('do') ? '-fluid' : null; ?>">
      <?php
        $do = get('do') ? get('do') : "default";
        if (empty($do) || $do == "default"){// admin tarafında linklere do isteği ile ulaşıyoruz ve buna göre burda işleme sokuyoruz.
            require 'inc/home.php'; // bir do isteği yok veya "default" ise home.php çağırıyoruz.
        }else{
            if (file_exists('inc/'.$do.'.php')){ // do isteği var ve bu do isteğine ait bir dosyamız varsa burda onu çağırıyoruz.
                require 'inc/'.$do.'.php';
            }else{// yoksa hata sayfasına yönlendiriyoruz
                go(url('404.php'));
            }
        }

      ?>
    </div>
    <?php require_once 'partials/scripts.php'; // script dosyaları?>
  </body>
</html>
<?php 
global $db;
ob_end_flush();// header işlemlerinde ob_start() fonksiyonunu başlatmıştık şimdi ise bunu sonlandırıyoruz. 
$db = null; // veri tabanını kapatıyoruz.
?>
