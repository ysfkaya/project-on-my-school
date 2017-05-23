<?php

    require 'system/system.php';
    require 'system/frontend.php';
    error_reporting(E_ERROR | E_WARNING | E_PARSE );

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>404 - Sayfa Bulunamadı</title>

    <?php require_once 'admin/partials/styles.php'; ?>
  </head>
  <body>
    <div class="container">
      <div class="hata-icerik">
        <h1>404</h1>
        
        <h2>SAYFA BULUNAMADI !</h2>
        
        <div class="hata-detay">
            Üzgünüz, aradığınız sayfayı bulamadık!
        </div>
        
        <div class="hata-link">
            <a href="<?=url()?>" class="btn btn-large btn-primary">
                <i class="fa fa-arrow-left"></i>
                &nbsp;
                Anasayfaya Dön                      
            </a>
            
            
            
        </div> 
                    
    </div>  
    </div>
  </body>
</html>
