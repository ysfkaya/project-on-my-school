
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="navbar-center">
        <li class="<?=get('do') == 'projeler' || get('do') == 'proje' || get('do') == 'proje_duzenle'  ? 'active' : null?>" id="target-1">
          <a href="<?= url('projeler'); ?>">
            <i class="fa fa-tasks"></i>
            Projeler
          </a>
        </li>
        <li class="<?=get('do') == 'ogrenciler' ? 'active' : null?>" id="target-2">
          <a href="<?= url('ogrenciler'); ?>">
             <i class="fa fa-graduation-cap"></i>
             Öğrenciler
          </a>
        </li>
        <li class="<?=get('do') == 'ogretmenler' || get('do') == 'ogretmen_duzenle' || get('do') == 'ogretmen_ekle' ? 'active' : null?>" id="target-3">
          <a href="<?= url('ogretmenler'); ?>">
             <i class="fa fa-users"></i>
             Yetkili Öğretmenler
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>