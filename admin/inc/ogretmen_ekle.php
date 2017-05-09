<?php
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği?") : null;
?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Öğretmen Ekle</h3>
        </div>
        <div class="panel-body">
        <div class="container">
            <div class="col-md-12">
                <?php 
                    if (isPost()) {
                            $k_ad = post('k_ad');
                            $eposta = post('eposta');
                            $sifre = post('sifre');
                            $ad = post('ad');
                            $soyad = post('soyad');

                            $ekle = $db->prepare("INSERT INTO ogretmenler SET
                                ogretmen_kullaniciadi = :k_ad,
                                ogretmen_eposta = :eposta,
                                ogretmen_sifre = :sifre,
                                ogretmen_ad = :ad,
                                ogretmen_soyad = :soyad
                                ");
                            $sonuc = $ekle->execute(array(
                                'k_ad' => $k_ad,
                                'eposta' => $eposta,
                                'sifre' => $sifre,
                                'ad' => $ad,
                                'soyad' => $soyad
                                ));                            

                            if ($sonuc) {
                                success("Öğretmen başarıyla eklendi");
                                go(url("ogretmenler"),2);
                            }else{
                                error("Ekleme hatası".$db->errorInfo()[2]);
                            } 
                        }

                ?>
                <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-4">Kullanıcı Adı</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="k_ad"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Eposta</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="eposta"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Şifre</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="sifre" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Adı</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="ad"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Soyadı</label>
                        <div class="col-md-6">
                           <input type="text" name="soyad"  class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-4"></label>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Ekle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>