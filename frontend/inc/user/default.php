<?php echo !defined("GUVENLIK") ? die("Geçersiz istek") : null; ?>
<div class="content-header">
    <h3><i class="fa fa-user"></i> Hoşgeldin <?=getSession('ogrenci_isim')?></h3>
</div>
<div class="content-body">
    <div class="row ">
        <a href="<?=url('yeni_mesajlar');?>">
            <div class="box-menu col-lg-2 col-md-2 col-sm-2 box-menu-black text-center">
                <i class="fa fa-bell"></i>
                <div class="clearfix"></div>
                <span>
                <?=$yeni_mesajlar;?> Yeni Mesaj
            </span>
            </div>
        </a>
        <a href="<?=url('mesajlar');?>">
            <div class="box-menu col-lg-2 col-md-2 col-sm-2 box-menu-green text-center">
                <i class="fa fa-envelope"></i>
                <div class="clearfix"></div>
                <span>
                 Toplam Mesaj (<?=$mesajlar?>)
            </span>
            </div>
        </a>
        <a href="<?=url('kontrol')?>">
            <div class="box-menu col-lg-2 col-md-2 col-sm-2 box-menu-orange text-center">
                <i class="fa fa-bookmark"></i>
                <div class="clearfix"></div>
                <span>
                Kontrol Sayısı (<?=$kontrols != 0 ? $kontrols->rowCount() : '0';?>)
            </span>
            </div>
        </a>
        <a href="<?=url('ayarlar');?>">
            <div class="box-menu col-lg-2 col-md-2 col-sm-2 box-menu-light-red text-center">
                <i class="fa fa-cog"></i>
                <div class="clearfix"></div>
                <span>
               Pofil Ayarları
            </span>
            </div>
        </a>
        <a href="<?=url('cikis');?>">
            <div class="box-menu col-lg-2 col-md-2 col-sm-2 box-menu-light-brown text-center">
                <i class="fa fa-sign-out"></i>
                <div class="clearfix"></div>
                <span>
               Çıkış Yap
            </span>
            </div>
        </a>
    </div>
</div>