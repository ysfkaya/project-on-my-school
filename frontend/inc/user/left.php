<?php echo !defined("GUVENLIK") ? die("Geçersiz istek") : null;?>

<div class="panel">
    <div class="user-heading">
        <a href="#" class="image">
            <img src="<?= empty($ogrenci['resim']) ? asset('avatar/user.png') : $ogrenci['resim']?>" alt="">
        </a>
        <h3><?=getSession('ogrenci_isim')?></h3>
    </div>
    <div class="user-links">
        <ul>
            <li><a class="<?=get('do') == null ? 'active' : null;?>" href="<?=url();?>"><i class="fa fa-id-card"></i> Profil</a></li>
            <li><a class="<?=get('do') == 'projem' ? 'active' : null;?>" href="<?=url('projem');?>"><i class="fa fa-star"></i> Projem</a></li>
            <li><a class="<?=get('do') == 'mesajlar' ? 'active' : null;?>" href="<?=url('mesajlar');?>"><i class="fa fa-envelope"></i> Mesajlar</a></li>
        </ul>
    </div>
</div>