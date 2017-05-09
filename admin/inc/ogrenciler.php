<?php
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği?") : null;

$ogrenciler = $db->query("SELECT * FROM ogrenciler LEFT JOIN projeler ON ogrenciler.proje_id = projeler.proje_id")->fetchAll(PDO::FETCH_ASSOC);
?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel with-nav-tabs panel-default">
        <div class="panel-body">
            <table id="table" class="display responsive" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID #</th>
                    <th>Okul Numarası</th>
                    <th>İsim</th>
                    <th>Eposta</th>
                    <th>Proje</th>
                    <th>Kayıt Tarihi</th>
                    <th>Son Giriş</th>
                    <th class="no-select" width="10%">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                
                    <?php foreach($ogrenciler as $ogrenci): extract($ogrenci);?>

                        <tr>
                            <td><?=$ogrenci_id;?></td>
                            <td><?=$ogrenci_no;?></td>
                            <td><?=$ogrenci_isim;?></td>
                            <td><?=$ogrenci_eposta;?></td>
                            <td><a href="<?=url('proje&id='.$proje_id);?>"><?=$proje_konu;?></a></td>
                            <td><?=myDate($ogrenci_kayit);?></td>
                            <td><?=!empty($ogrenci_giris) ? myDate($ogrenci_giris,true) : 'Henüz Giriş Yapılmamış'?></td>
                            <td class="no-select">
                                <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#mesaj-<?=$ogrenci_id;?>"><i class="fa fa-comment-o"></i> Mesaj Gönder</button>
                                <button type="button" id="ogrenci_sil" data-id="<?=$ogrenci_id?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div id="mesaj-<?=$ogrenci_id;?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Mesaj Gönder</h4>
                              </div>
                              <form action="" id="mesaj_gonder">
                                <input type="hidden" id="modal_id" value="<?=$ogrenci_id?>">
                                <input type="hidden" id="mesaj_gonderen_id" value="<?=getSession('ogretmen_id');?>">
                                <p class="text-danger text-center" style="margin-top: 10px;margin-bottom: -10px;"  id="hata"></p>
                                <div class="modal-body">
                                    <input type="hidden" id="mesaj_alici_id" value="<?=$ogrenci_id?>">
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