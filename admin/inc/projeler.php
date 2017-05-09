<?php
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği?") : null;

$query = $db->query('SELECT * FROM projeler');
$projeler = $query->fetchAll(PDO::FETCH_ASSOC);
$ogrenciler = $db->query("SELECT * FROM ogrenciler")->fetchAll(PDO::FETCH_ASSOC);

$queryOnay = $db->query('SELECT * FROM projeler WHERE proje_uygunluk = 1');
$proje_onaylananlar = $queryOnay->fetchAll(PDO::FETCH_ASSOC);

$queryRed = $db->query('SELECT * FROM projeler WHERE proje_uygunluk = 2');
$proje_onaylanmayanlar = $queryRed->fetchAll(PDO::FETCH_ASSOC);
?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel with-nav-tabs panel-default">
        <div class="panel-heading">
          <ul class="nav nav-tabs">
              <li class="active"><a href="#tab1primary" data-toggle="tab"><i class="fa fa-globe"></i> Tümü <span class="badge"><?=$query->rowCount();?></span></a></li>
              <li><a href="#tab2primary" data-toggle="tab"><i class="fa fa-thumbs-o-up"></i> Onaylananlar <span class="badge"><?=$queryOnay->rowCount();?></span></a></li>
              <li><a href="#tab3primary" data-toggle="tab"><i class="fa fa-thumbs-o-down"></i> Onaylanmayanlar <span class="badge"><?=$queryRed->rowCount();?></span></a></li>
          </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1primary">
                    <table id="table" class="display responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID #</th>
                                <th>NO #</th>
                                <th>Konu</th>
                                <th>Öğrenciler</th>
                                <th>Durum</th>
                                <th>Gönderim Tarihi</th>
                                <th>Proje Bitirme Tarihi</th>
                                <th class="no-select">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($projeler as $proje): extract($proje);?>

                            <tr>
                                <td><?=$proje_id;?></td>
                                <td><?=empty($proje_no) ? 'Henüz Belirlenmedi' : $proje_no;?></td>
                                <td><?=$proje_konu;?></td>
                                <td>
                                <?php 
                                    $array = array();
                                    foreach ($ogrenciler as $ogrenci){
                                        if ($ogrenci['proje_id'] == $proje_id) {
                                            $array[] = $ogrenci['ogrenci_isim'];
                                        }
                                    }
                                    echo implode(', ',$array);
                                ?>          
                                </td>
                                   
                                <td><?=$proje_uygunluk == 1 ?  '<label class="label label-success">Kabul Edildi</label>' : ($proje_uygunluk == 2 ? '<label class="label label-error">Kabul Edilmedi</label>' : '<label class="label label-warning">Henüz Belirlenmedi</label>');?></td>
                                <td><?=myDate($proje_olusturma);?></td>
                                <td><?=!empty($proje_bitirme) ? myDate($proje_bitirme,true) : 'Henüz Belirlenmedi'?></td>
                                <td class="no-select">
                                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#mesaj-<?=$proje_id;?>"><i class="fa fa-comment-o"></i> Mesaj Gönder</button>
                                    <a href="<?=url('proje&id='.$proje_id)?>" class="btn btn-primary btn-sm"><i class="fa fa-share-square-o"></i> İncele</a>
                                    <a href="<?=url('proje_duzenle&id='.$proje_id)?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Düzenle</a>
                                    <button type="button" id="proje_sil" data-id="<?=$proje_id?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div id="mesaj-<?=$proje_id;?>" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Mesaj Gönder</h4>
                                  </div>
                                  <form action="" id="mesaj_gonder">
                                    <input type="hidden" id="modal_id" value="<?=$proje_id?>">
                                    <input type="hidden" id="mesaj_gonderen_id" value="<?=getSession('ogretmen_id');?>">
                                    <p class="text-danger text-center" style="margin-top: 10px;margin-bottom: -10px;"  id="hata"></p>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Mesaj Göndermek İstediğiniz Öğrenci</label>
                                            <select class="selectpicker form-control" data-live-search="true" id="mesaj_alici_id" required>
                                                <?php 
                                                foreach ($ogrenciler as $ogrenci){
                                                    if ($ogrenci['proje_id'] == $proje_id) {
                                                        ?>
                                                        <option value="<?=$ogrenci['ogrenci_id'];?>"><?=$ogrenci['ogrenci_isim'];?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Mesaj Başlığı</label>
                                            <input type="text" id="baslik" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Mesajınız</label>
                                            <textarea  id="mesaj" cols="30" rows="10" required class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                                        <button type="submit" class="btn btn-success">Gönder</button>
                                    </div>
                                </form>
                                </div>

                              </div>
                            </div>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="tab2primary">
                    <table id="table" class="display responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID #</th>
                                <th>NO #</th>
                                <th>Konu</th>
                                <th>Öğrenciler</th>
                                <th>Durum</th>
                                <th>Gönderim Tarihi</th>
                                <th>Proje Bitirme Tarihi</th>
                                <th class="no-select">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($proje_onaylananlar as $proje): extract($proje);?>

                            <tr>
                                <td><?=$proje_id;?></td>
                                <td><?=empty($proje_no) ? 'Henüz Belirlenmedi' : $proje_no;?></td>
                                <td><?=$proje_konu;?></td>
                                <td>
                                <?php 
                                    $array = array();
                                    foreach ($ogrenciler as $ogrenci){
                                        if ($ogrenci['proje_id'] == $proje_id) {
                                            $array[] = $ogrenci['ogrenci_isim'];
                                        }
                                    }
                                    echo implode(', ',$array);
                                ?>          
                                </td>
                                   
                                <td><?=$proje_uygunluk == 1 ?  '<label class="label label-success">Kabul Edildi</label>' : ($proje_uygunluk == 2 ? '<label class="label label-error">Kabul Edilmedi</label>' : '<label class="label label-warning">Henüz Belirlenmedi</label>');?></td>
                                <td><?=myDate($proje_olusturma);?></td>
                                <td><?=!empty($proje_bitirme) ? myDate($proje_bitirme,true) : 'Henüz Belirlenmedi'?></td>
                                <td class="no-select">
                                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#mesaj-<?=$proje_id;?>"><i class="fa fa-comment-o"></i> Mesaj Gönder</button>
                                    <a href="<?=url('proje&id='.$proje_id)?>" class="btn btn-primary btn-sm"><i class="fa fa-share-square-o"></i> İncele</a>
                                    <a href="<?=url('proje_duzenle&id='.$proje_id)?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Düzenle</a>
                                    <button type="button" id="proje_sil" data-id="<?=$proje_id?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div id="mesaj-<?=$proje_id;?>" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Mesaj Gönder</h4>
                                  </div>
                                  <form action="" id="mesaj_gonder">
                                    <input type="hidden" id="modal_id" value="<?=$proje_id?>">
                                    <input type="hidden" id="mesaj_gonderen_id" value="<?=getSession('ogretmen_id');?>">
                                    <p class="text-danger text-center" style="margin-top: 10px;margin-bottom: -10px;"  id="hata"></p>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Mesaj Göndermek İstediğiniz Öğrenci</label>
                                            <select class="selectpicker form-control" data-live-search="true" id="mesaj_alici_id" required>
                                                <?php 
                                                foreach ($ogrenciler as $ogrenci){
                                                    if ($ogrenci['proje_id'] == $proje_id) {
                                                        ?>
                                                        <option value="<?=$ogrenci['ogrenci_id'];?>"><?=$ogrenci['ogrenci_isim'];?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Mesaj Başlığı</label>
                                            <input type="text" id="baslik" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Mesajınız</label>
                                            <textarea  id="mesaj" cols="30" rows="10" required class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                                        <button type="submit" class="btn btn-success">Gönder</button>
                                    </div>
                                </form>
                                </div>

                              </div>
                            </div>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="tab3primary">
                <table id="table" class="display responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID #</th>
                                <th>NO #</th>
                                <th>Konu</th>
                                <th>Öğrenciler</th>
                                <th>Durum</th>
                                <th>Gönderim Tarihi</th>
                                <th>Proje Bitirme Tarihi</th>
                                <th class="no-select">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($proje_onaylanmayanlar as $proje): extract($proje);?>

                            <tr>
                                <td><?=$proje_id;?></td>
                                <td><?=empty($proje_no) ? 'Henüz Belirlenmedi' : $proje_no;?></td>
                                <td><?=$proje_konu;?></td>
                                <td>
                                <?php 
                                    $array = array();
                                    foreach ($ogrenciler as $ogrenci){
                                        if ($ogrenci['proje_id'] == $proje_id) {
                                            $array[] = $ogrenci['ogrenci_isim'];
                                        }
                                    }
                                    echo implode(', ',$array);
                                ?>          
                                </td>
                                   
                                <td><?=$proje_uygunluk == 1 ?  '<label class="label label-success">Kabul Edildi</label>' : ($proje_uygunluk == 2 ? '<label class="label label-error">Kabul Edilmedi</label>' : '<label class="label label-warning">Henüz Belirlenmedi</label>');?></td>
                                <td><?=myDate($proje_olusturma);?></td>
                                <td><?=!empty($proje_bitirme) ? myDate($proje_bitirme,true) : 'Henüz Belirlenmedi'?></td>
                                <td class="no-select">
                                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#mesaj-<?=$proje_id;?>"><i class="fa fa-comment-o"></i> Mesaj Gönder</button>
                                    <a href="<?=url('proje&id='.$proje_id)?>" class="btn btn-primary btn-sm"><i class="fa fa-share-square-o"></i> İncele</a>
                                    <a href="<?=url('proje_duzenle&id='.$proje_id)?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Düzenle</a>
                                    <button type="button" id="proje_sil" data-id="<?=$proje_id?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div id="mesaj-<?=$proje_id;?>" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Mesaj Gönder</h4>
                                  </div>
                                  <form action="" id="mesaj_gonder">
                                    <input type="hidden" id="modal_id" value="<?=$proje_id?>">
                                    <input type="hidden" id="mesaj_gonderen_id" value="<?=getSession('ogretmen_id');?>">
                                    <p class="text-danger text-center" style="margin-top: 10px;margin-bottom: -10px;"  id="hata"></p>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Mesaj Göndermek İstediğiniz Öğrenci</label>
                                            <select class="selectpicker form-control" data-live-search="true" id="mesaj_alici_id" required>
                                                <?php 
                                                foreach ($ogrenciler as $ogrenci){
                                                    if ($ogrenci['proje_id'] == $proje_id) {
                                                        ?>
                                                        <option value="<?=$ogrenci['ogrenci_id'];?>"><?=$ogrenci['ogrenci_isim'];?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Mesaj Başlığı</label>
                                            <input type="text" id="baslik" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Mesajınız</label>
                                            <textarea  id="mesaj" cols="30" rows="10" required class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                                        <button type="submit" class="btn btn-success">Gönder</button>
                                    </div>
                                </form>
                                </div>

                              </div>
                            </div>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>