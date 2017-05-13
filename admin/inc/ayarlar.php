<?php
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği?") : null;
?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Ayarlar</h3>
        </div>
        <div class="panel-body">
        <div class="container">
            <div class="col-md-12">
                <?php 
                    if (isPost()) {
                        $baslik = post('baslik');
                        $hakkimizda = post('hakkimizda');
                        $eposta = post('eposta');
                        $dosya1 = dosya('site_logo');
                        $dosya2 = dosya('site_anasayfa_logo');

                        if ($dosya1) {
                            $logo = dosyaYukle(LOGO,$dosya1,LOGO_URL,'logo');
                        }else{
                            $logo = $ayar['site_logo'];
                        }

                        if ($dosya2) {
                            $anasayfa_logo = dosyaYukle(LOGO,$dosya2,LOGO_URL,'anasayfa_logo');
                        }else{
                            $anasayfa_logo = $ayar['site_anasayfa_logo'];
                        }


                        $guncelle = $db->prepare("UPDATE ayarlar SET
                            site_baslik = :baslik,
                            site_hakkimizda = :hakkimizda,
                            site_iletisim_eposta = :eposta,
                            site_logo = :logo,
                            site_anasayfa_logo = :anasayfa_logo
                            WHERE ayar_id = :id
                            ");
                        $sonuc = $guncelle->execute(array(
                            'baslik' => $baslik,
                            'hakkimizda' => $hakkimizda,
                            'eposta' => $eposta,
                            'logo' => $logo,
                            'anasayfa_logo' => $anasayfa_logo,
                            'id' => 1
                            ));                            

                        if ($sonuc) {
                            success("Ayarlar başarıyla güncellendi");
                            go(url("ayarlar"),2);
                        }else{
                            error("Güncelleme hatası".$db->errorInfo()[2]);
                        } 
                    }

                ?>
                <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-4">Site Başlığı</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="baslik" value="<?=$ayar['site_baslik'];?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Hakkımızda İçeriği</label>
                        <div class="col-md-6">
                            <textarea name="hakkimizda" cols="30" rows="10" class="form-control"><?=$ayar['site_hakkimizda'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">İletişim Eposta</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="eposta" value="<?=$ayar['site_iletisim_eposta'];?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Anasayfa Logo</label>
                        <div class="col-md-6">
                            <div class="kv-avatar" style="width:45%">
                                <input type="file" name="site_anasayfa_logo" id="resim2" data-img="<?=$ayar['site_anasayfa_logo'];?>" class="file-loading">
                            </div>
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