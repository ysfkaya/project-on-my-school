<?php
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği?") : null;

$id = getSession('ogretmen_id');
$query = $db->prepare("SELECT * FROM ogretmenler WHERE ogretmen_id = :id");
$query->execute(array(
    'id' => $id
));
$ogretmen = $query->fetch(PDO::FETCH_ASSOC);
extract($ogretmen);
?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Profil</h3>
        </div>
        <div class="panel-body">
        <div class="container">
            <div class="col-md-12">
                <?php 
                    if (isPost()) {
                            $k_ad = post('k_ad');
                            $eposta = post('eposta');
                            $sifre = empty(post('sifre')) ? $ogretmen_sifre : md5(post('sifre'));
                            $ad = post('ad');
                            $soyad = post('soyad');

                            $guncelle = $db->prepare("UPDATE ogretmenler SET
                                ogretmen_kullaniciadi = :k_ad,
                                ogretmen_eposta = :eposta,
                                ogretmen_sifre = :sifre,
                                ogretmen_ad = :ad,
                                ogretmen_soyad = :soyad
                                WHERE ogretmen_id = :id
                                ");
                            $sonuc = $guncelle->execute(array(
                                'k_ad' => $k_ad,
                                'eposta' => $eposta,
                                'sifre' => $sifre,
                                'ad' => $ad,
                                'soyad' => $soyad,
                                'id' => $id
                                ));                            

                            if ($sonuc) {
                                success("Öğretmen başarıyla güncellendi");
                                go(url("ogretmen_duzenle&id=".$id),2);
                            }else{
                                error("Güncelleme hatası".$db->errorInfo()[2]);
                            } 
                        }

                ?>
                <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-4">Kullanıcı Adı</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="k_ad" value="<?=$ogretmen_kullaniciadi;?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Eposta</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="eposta" value="<?=$ogretmen_eposta;?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Şifre</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="sifre" placeholder="Boş bırakılırsa değiştirilmez.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Adı</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="ad" value="<?=$ogretmen_ad;?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Soyadı</label>
                        <div class="col-md-6">
                           <input type="text" name="soyad" value="<?=$ogretmen_soyad;?>" class="form-control" required>
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