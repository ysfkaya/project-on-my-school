<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=url();?>">Proje Takibim - Admin </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= url(); ?>">Kontrol Paneli</a></li>
                <li id="target-4"><a href="<?= url('ayarlar'); ?>">Ayarlar</a></li>
                <li id="target-5"><a href="<?= url('profil'); ?>">Profil</a></li>
                <li><a href="<?= url('cikis'); ?>">Çıkış Yap</a></li>
            </ul>
        </div>
    </div>
</nav>