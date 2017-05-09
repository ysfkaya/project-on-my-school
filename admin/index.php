<?php

    require '../system/backend.php';
    require '../system/system.php';

    if(isLogin() && isAdmin()){
        define('ADMIN',true);
    }else{
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

    <?php require_once 'partials/styles.php'; ?>
  </head>
  <body>
    <?php require 'partials/navbar.php'; ?>
    <?php require 'partials/subnavbar.php'; ?>
    <div class="container<?= get('do') ? '-fluid' : null; ?>">
      <?php
        $do = get('do') ? get('do') : "default";
        if (empty($do) || $do == "default"){
            require 'inc/home.php';
        }else{
            if (file_exists('inc/'.$do.'.php')){
                require 'inc/'.$do.'.php';
            }else{
                go(url('404.php'));
            }
        }

      ?>
    </div>
    <?php require_once 'partials/scripts.php'; ?>
  </body>
</html>
