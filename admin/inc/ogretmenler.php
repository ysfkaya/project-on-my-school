<?php
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği?") : null;

$ogretmenler = $db->query("SELECT * FROM ogretmenler")->fetchAll(PDO::FETCH_ASSOC);
?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel with-nav-tabs panel-default">
        <div class="panel-body">
            <table id="table" class="display responsive" cellspacing="0" width="100%">
            <a href="<?=url('ogretmen_ekle')?>" class="btn btn-success pull-right"><i class="fa fa-plus-circle"></i> Öğretmen Ekle</a>
                <thead>
                <tr>
                    <th>ID #</th>
                    <th>Kullanıcı Adı</th>
                    <th>Eposta Adresi</th>
                    <th>İsmi</th>
                    <th>Kayıt Tarihi</th>
                    <th>Son Giriş</th>
                    <th class="no-select" width="10%">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($ogretmenler as $ogretmen): extract($ogretmen);?>
                    <?php if($ogretmen_id != getSession('ogretmen_id')):?>
                    <tr>
                        <td><?=$ogretmen_id;?></td>
                        <td><?=$ogretmen_kullaniciadi?></td>
                        <td><?=$ogretmen_eposta;?></td>
                        <td><?=$ogretmen_ad." ".$ogretmen_soyad;?></td>
                        <td><?=myDate($ogretmen_kayit);?></td>
                        <td><?=!empty($ogretmen_giris) ? myDate($ogretmen_giris) : 'Giriş Yapılmamış';?></td>
                        <td class="no-select">
                            <a href="<?=url('ogretmen_duzenle&id='.$ogretmen_id)?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Düzenle</a>
                            <button type="button" id="ogretmen_sil" data-id="<?=$ogretmen_id?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</button>

                        </td>
                    </tr>
                    <?php endif;?>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>