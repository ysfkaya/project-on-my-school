<?php
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği?") : null;

$id = get('id') ? get('id') : go(url('projeler'));
$query = $db->prepare("SELECT * FROM projeler INNER JOIN ogrenciler ON ogrenciler.ogrenci_id = projeler.olusturan_id WHERE projeler.proje_id = :id");
$query->execute(array(
    'id' => $id
));
if ($query->rowCount() < 1) {
    warning('Proje bulunamadı');
}else{
$proje = $query->fetch(PDO::FETCH_ASSOC);
extract($proje);

$sorgu = $db->prepare("SELECT * FROM ogrenciler WHERE proje_id = :id");
$sorgu->execute(array(
    'id' => $id
));
$ogrenciler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Proje Detayları</h3>
        </div>
        <div class="panel-body">
        <div class="container">
            <div class="col-md-12">
                <?php 
                    if (isPost()) {
                        $no = post('proje_no');
                        $konu = post('proje_konu');
                        $amac = post('proje_amac');
                        $uygunluk = empty(post('proje_uygunluk')) ? null : post('proje_uygunluk');
                        $bitirme = post('proje_bitirme');
                        $duzenleme = date('Y-m-d H:i:s');

                        $sorgu = $db->prepare("SELECT * FROM projeler WHERE proje_no = :no AND proje_id != :id");
                        $sorgu->execute(array('no'=>$no,'id' => $id));
                        if ($sorgu->rowCount() > 0) {
                            warning("Girdiğiniz proje numarası başka bir projede kullanılmaktadır. Lütfen başka bir proje numarası giriniz");
                        }else{     
                            $query = $db->prepare("UPDATE projeler SET
                                    proje_no = :no,
                                    proje_konu = :konu,
                                    proje_amac =:amac,
                                    proje_uygunluk =:uygunluk,
                                    proje_bitirme =:bitirme,
                                    proje_duzenleme = :duzenleme
                                    WHERE proje_id = :id
                                ");
                            $sonuc = $query->execute(array(
                                'no' => $no,
                                'konu' => $konu,
                                'amac' => $amac,
                                'uygunluk' => $uygunluk,
                                'bitirme' => $bitirme,
                                'duzenleme' => $duzenleme,
                                'id' => $id
                                ));

                            if ($sonuc) {
                                success("Proje başarıyla güncellendi");
                                go(url("proje_duzenle&id=".$id),2);
                            }else{
                                error("Güncelleme hatası".$db->errorInfo()[2]);
                            } 
                        }

                    }

                ?>
                <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-4">Proje Numarası</label>
                        <div class="col-md-6">
                            <input type="number" min="1" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control" placeholder="<?=$proje_no == null ? 'Henüz Belirtilmemiş' : null?>" name="proje_no" value="<?=$proje_no?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Proje Konu</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="proje_konu" value="<?=$proje_konu?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Proje Amacı</label>
                        <div class="col-md-6">
                            <textarea name="proje_amac" class="form-control" cols="30" rows="10"><?=nl2br(ss($proje_amac))?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Proje Uygunluk</label>
                        <div class="col-md-6">
                            <select name="proje_uygunluk" class="selectpicker form-control" title="<?=$proje_uygunluk == null ? 'Henüz Belirtilmedi' : null?>">
                                <option value="1" <?=$proje_uygunluk == 1 ? 'selected' : null?>>Kabul Edildi</option>
                                <option value="2" <?=$proje_uygunluk == 2 ? 'selected' : null?>>Kabul Edilmedi</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Proje Oluşturma Tarihi</label>
                        <div class="col-md-6">
                           <input type="text" value="<?=$proje_olusturma;?>" disabled class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Proje Bitirme Tarihi</label>
                        <div class="col-md-6">
                            <input type="text" id="datetimepicker" class="form-control" name="proje_bitirme" value="<?=$proje['proje_bitirme']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-4"></label>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Kaydet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
<?php }?>