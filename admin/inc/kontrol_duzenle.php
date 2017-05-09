<?php
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği?") : null;

$id = get('id') ? get('id') : go("javascript:history.go(-1)");
$query = $db->prepare("SELECT * FROM kontrol WHERE kontrol_id = :id");
$query->execute(array(
    'id' => $id
));
if ($query->rowCount() < 1) {
    warning('Proje bulunamadı');
}else{
$kontrol = $query->fetch(PDO::FETCH_ASSOC);
?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Proje Kontrol Düzenle</h3>
        </div>
        <div class="panel-body">
           <div class="container">
                  <div class="container">
            <div class="col-md-12">
                <?php 
                    if (isPost()) {
                            $baslik = post('baslik');
                            $not = post('not');
                            $yuzde = post('yuzde');

                            $guncelle = $db->prepare("UPDATE kontrol SET
                                kontrol_baslik = :baslik,
                                kontrol_not = :not,
                                proje_yuzde = :yuzde
                                WHERE kontrol_id = :id");
                            $sonuc = $guncelle->execute(array(
                                'baslik' => $baslik,
                                'not' => $not,
                                'yuzde' => $yuzde,
                                'id' => $id
                                ));                            

                            if ($sonuc) {
                                success("Kontrol Düzenleme başarıyla gerçekleştirildi.");
                                go(url("proje&id=".$kontrol['proje_id']),2);
                            }else{
                                error("Ekleme hatası".$db->errorInfo()[2]);
                            } 
                        }

                ?>
                <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-4">Kontrol Başlık</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="baslik"  value="<?=$kontrol['kontrol_baslik']?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Kontrol Notu</label>
                        <div class="col-md-6">
                            <textarea required name="not" cols="30" class="form-control" rows="10" placeholder="Proje kontrolunü gerçekleştirdikten sonra alınacak notunuzu buraya giriniz."><?=$kontrol['kontrol_not']?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Proje'nin Bitirme Yüzdesi</label>
                        <div class="col-md-6">
                            <div class="input-group" > 
                                <span class="input-group-addon"  style="background: transparent !important">
                                    <i class="fa fa-percent"></i>
                                </span>
                                <input value="<?=$kontrol['proje_yuzde']?>" style="background: transparent !important" type="number" name="yuzde" min="1" maxlength="3" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1'); javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);javascript: if (this.value > 100) this.value = 100;" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-4"></label>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Kontrol Düzenle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
           </div>
        </div>
      </div>
    </div>
  </div>
<?php }?>