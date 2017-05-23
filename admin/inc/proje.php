<?php
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği?") : null;

/**
 * Verileri çekmek için yaptığımız sorugular.
 */

$id = get('id') ? get('id') : go(url('projeler'));
$query = $db->prepare("SELECT * FROM projeler INNER JOIN ogrenciler ON ogrenciler.ogrenci_id = projeler.olusturan_id WHERE projeler.proje_id = :id");
$query->execute(array(
    'id' => $id
));
if ($query->rowCount() < 1) {
    warning('Proje bulunamadı');
}else{
$proje = $query->fetch(PDO::FETCH_ASSOC);

$sorgu = $db->prepare("SELECT * FROM ogrenciler WHERE proje_id = :id");
$sorgu->execute(array(
    'id' => $id
));

$ogrenciler = $sorgu->fetchAll(PDO::FETCH_ASSOC);

$kontrol = $db->prepare("SELECT proje_yuzde FROM kontrol WHERE proje_id = :id Order By kontrol_tarih desc");
$kontrol->execute(array('id' => $id));
if ($kontrol->rowCount() > 0) {
    $yuzde = $kontrol->fetch(PDO::FETCH_ASSOC)['proje_yuzde'];
}else{
    $yuzde = 0;
}

$mesajlar = $db->prepare("SELECT * FROM mesajlar LEFT JOIN ogrenciler ON ogrenciler.proje_id = :id WHERE alici_id = ogrenciler.ogrenci_id LIMIT 0,10");
$mesajlar->execute(array("id" => $id));



$olaylar = $db->prepare("SELECT * FROM olaylar LEFT JOIN ogrenciler ON ogrenciler.ogrenci_id = olaylar.ogrenci_id WHERE olaylar.proje_id = :id ORDER BY olaylar.olay_tarih desc LIMIT 0,10");
$olaylar->execute(array("id" => $id));
$olaylar = $olaylar->fetchAll(PDO::FETCH_ASSOC);
?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Proje Detayları</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="proje-sol">
                        <div class="proje-icerik">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                        <?php if($kontrol->rowCount() > 0):?>
                                            <a href="<?=url('listele&id='.$proje['proje_id'])?>" style="margin-left:10px;" class="btn btn-default btn-xs pull-right"><i class="fa fa-list-alt"></i> Kontrolleri Listele</a>
                                        <?php endif;?>
                                        <a href="<?=url('proje_duzenle&id='.$id)?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-edit"></i> Projeyi Düzenle</a>        
                                        <h4><?=$proje['proje_konu'];?></h4>
                                    </div>
                                    <dl class="dl-horizontal">
                                        <dt>Durum:</dt> <dd><span class="label label-<?=$proje['proje_uygunluk'] == 1 ? 'success' : ($proje['proje_uygunluk'] == 0 && $proje['proje_uygunluk'] != null ? 'danger' : 'warning')?>"><?=$proje['proje_uygunluk'] == 1 ? 'Onaylandı' : ($proje['proje_uygunluk'] == 0 && $proje['proje_uygunluk'] != null ? 'Onaylanmadı' : 'Henüz belirlenmedi')?></span></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Oluşturan:</dt> <dd><?=$proje['ogrenci_isim'];?></dd>
                                        <dt class="proje_ekip">Proje Ekibi:</dt>
                                        <dd class="proje_ekip">
                                        <?php foreach($ogrenciler as $ogrenci):?>
                                            <a href=""><img class="img-circle" title="<?=$ogrenci['ogrenci_isim']?>" src="<?=$ogrenci['resim'] != null ? $ogrenci['resim'] : URL.'/frontend/avatar/user.png'?>"></a>
                                        <?php endforeach;?>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7">
                                    <dl class="dl-horizontal">
                                        <dt>Son Güncelleme:</dt> <dd><?=$proje['proje_duzenleme'] != null ? $proje['proje_duzenleme'] : 'Güncelleme yok'?></dd>
                                        <dt>Oluşturma Tarihi:</dt> <dd> <?=$proje['proje_olusturma']?> </dd>
                                       
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt>Tamamlanan:</dt>
                                        <dd>
                                            <div class="progress progress-striped active m-b-sm">
                                                <div style="width: <?=$yuzde?>%;" class="progress-bar"></div>
                                            </div>
                                            <p>Proje <strong>% <?=$yuzde;?></strong> tamamlandı.</p>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                    <div class="panel blank-panel">
                                        <div class="panel-heading">
                                            <div class="panel-options">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab-1" data-toggle="tab">Gönderilen Mesajlar</a></li>
                                                    <li class=""><a href="#tab-2" data-toggle="tab">Son Olaylar</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="panel-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab-1">
                                                    <div class="mesajlar">
                                                        <?php foreach($mesajlar->fetchAll(PDO::FETCH_ASSOC) as $mesaj): extract($mesaj);?>
                                                            <div class="mesaj">
                                                            <a href="#" class="pull-left">
                                                                <img alt="avatar" class="img-circle" src="<?=$resim;?>">
                                                            </a>
                                                            <div class="mesaj-body">
                                                                <small class="pull-left"><strong><?=$ogrenci_isim;?></strong></small>
                                                                <div class="clearfix"></div>
                                                                <strong><?=$baslik;?></strong>
                                                                <small class="pull-right"><?=myDate($tarih,true);?></small>
                                                                <div class="well">
                                                                    <?=$mesaj;?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach;?>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab-2">
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
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="proje-sag">
                        <h4>Proje Amacı</h4>
                        <p>
                            <?=nl2br($proje['proje_amac'])?>
                        </p>
                        <?php if(count(file_list($proje['proje_id']))):?>
                        <h5>Proje Dosyaları</h5>
                        <ul class="list-unstyled project-files">
                            <?php foreach (file_list($proje['proje_id']) as $value):?>
                            <li><a href="<?=$value['dosya_link'];?>" download><i class="fa fa-file-archive-o"></i> <?=$value['dosya_ad'];?></a></li>
                            <?php endforeach;?>
                        </ul>
                        <?php endif;?>
                        <div class="m-t-md">
                            <a href="<?=url('kontrol&id='.$proje['proje_id'])?>" class="btn btn-success"><i class="fa fa-plus-circle"></i> Kontrol Girdisi Oluştur</a>
                        
                        <?php if(count(file_list($proje['proje_id']))):?>
                            <!-- <a href="<?=url("dosyalari_indir&proje_id=".$proje['proje_id'])?>" class="btn btn-info"><i class="fa fa-download"></i> Dosyaları İndir</a> -->
                        <?php endif;?>

                        </div>
                    </div>
            </div>
        </div>
      </div>
    </div>
  </div>
<?php }?>