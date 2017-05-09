<?php
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği?") : null;

$hepsi = $db->query("SELECT COUNT(*) FROM projeler")->fetchColumn();
$onaylananlar = $db->query("SELECT COUNT(*) FROM projeler WHERE proje_uygunluk = 1")->fetchColumn();
$onaylanmayanlar = $db->query("SELECT COUNT(*) FROM projeler WHERE proje_uygunluk  = 0")->fetchColumn();

$olaylar = $db->query("SELECT * FROM olaylar")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12">
      <div class="widget">
            <div class="widget-header">
              <i class="fa fa-list"></i>
              <h3> Projeler</h3>
            </div>
            <div class="widget-content">
                  <h6 class="help-text">Bu panelde eklenen projelerin kısa detaylarını görmektesiniz.</h6>
                  <div  class="details">
                    <div><a href="<?=url('projeler#tab1primary');?>"><i class="fa fa-flag"></i> <span class="value"><?= $hepsi; ?></span> <span class="text">Toplam</span></a></div>

                    <div><a href="<?=url('projeler#tab2primary');?>"><i class="fa fa-thumbs-o-up"></i> <span class="value"><?= $onaylananlar; ?></span> <span class="text">Onaylanan</span></a></div>

                    <div><a href="<?=url('projeler#tab3primary');?>"><i class="fa fa-thumbs-o-down"></i> <span class="value"><?= $onaylanmayanlar; ?></span> <span class="text">Onaylanmayan</span></a></div>
                  </div>
              </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="widget">
          <div class="widget-header">
            <i class="fa fa-history"></i>
            <h3>Olaylar</h3>
          </div>
          <div class="widget-content">
            <table id="table" class="display responsive"" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>ID #</th>
                          <th>Gerçekleştirilen İşlem</th>
                          <th>Olay</th>
                          <th>Tarihi</th>
                          <th class="no-select">İşlemler</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php foreach($olaylar as $o): extract($o);?>

                      <tr>
                          <td><?=$olay_id;?></td>
                          <td><?=$olay;?></td>
                          <td><?=olay_girdi($olay_tip,$o);?></td>
                          <td><?=$olay_tarih;?></td>
                          <td class="no-select">
                          <button type="button" id="olay_sil" data-id="<?=$olay_id?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</button>
                          </td>
                      </tr>
                  <?php endforeach;?>
                  </tbody>
              </table>
          </div>
      </div>
    </div>
  </div>