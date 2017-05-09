<?php echo !defined("GUVENLIK") ? die("Geçersiz istek") : null;?>
<div class="content-header">
    <h3><i class="fa fa-cog"></i> Profil Ayarları</h3>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-lg-12">
            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="ayarlar" value="true">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Okul Numarası</label>
                        <div class="col-md-6">
                            <div class="input-group"> 
                                <span class="input-group-addon">
                                    <i class="fa fa-graduation-cap"></i>
                                </span>
                                <input type="number" value="<?=$ogrenci['ogrenci_no'];?>" name="ogrenci_no" min="0" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">İsim</label>
                        <div class="col-md-6">
                            <div class="input-group"> 
                                <span class="input-group-addon">
                                    <i class="fa fa-user-circle-o"></i>
                                </span>
                                <input class="form-control" name="ogrenci_isim" value="<?=$ogrenci['ogrenci_isim'];?>" required type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Eposta Adresi</label>
                        <div class="col-md-6">
                            <div class="input-group"> 
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input class="form-control" disabled value="<?=$ogrenci['ogrenci_eposta'];?>" required type="text">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#eposta_goster">Değiştir</button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Şifre</label>
                        <div class="col-md-6">
                            <div class="input-group"> 
                                <span class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input class="form-control" disabled value="********" required type="password">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sifre">Değiştir</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Profil Resim</label>
                        <div class="col-md-6">
                        <div class="kv-avatar" style="width:45%">
                            <input type="file" data-img ="<?=$ogrenci['resim'];?>" name="resim" id="resim" class="file-loading">
                        </div>
                        </div>
                    </div>
                     <div class="form-group">
                       <label class="col-md-4 control-label"></label>
                       <div class="col-md-8">
                          <button type="submit" class="btn btn-success">Kaydet</button>
                       </div>
                    </div>    
                </fieldset>
            </form>
            <!-- Modal -->
            <div id="sifre" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <form class="form-horizontal" id="degis">
                    <input type="hidden" id="user_id" value="<?=getSession('id');?>">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Şifre Değiştir</h4>
                          </div>
                          <div class="modal-body">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Mevcut Şifre</label>
                                        <div class="col-md-6 mevcut">
                                            <p class="hep-block hata-mevcut"></p>
                                            <input type="password" id="m_sifre" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Yeni Şifre</label>
                                        <div class="col-md-6 yeni">
                                            <input type="password" id="y_sifre" class="form-control" required>
                                            <p class="hep-block hata-yeni"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Yeni Şifre Tekrar</label>
                                        <div class="col-md-6 tekrar">
                                            <input type="password" id="t_sifre" class="form-control" required>
                                            <p class="hep-block hata-tekrar"></p>
                                        </div>
                                    </div>
                                </fieldset>
                         </div>
                         <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                                <button type="submit" name="test" class="btn btn-success">Değiştir</button>
                         </div>
                    </form>
                </div>
              </div>
            </div>
            <!-- Modal -->
            <div id="eposta_goster" class="modal fade" role="dialog">
              <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <form class="form-horizontal" id="eposta">
                    <input type="hidden" id="user_id" value="<?=getSession('id');?>">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Eposta Değiştir</h4>
                          </div>
                          <div class="modal-body">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Yeni Eposta Adresi</label>
                                        <div class="col-md-6 eposta">
                                            <p class="hep-block hata-eposta"></p>
                                            <input type="email" id="y_eposta" class="form-control" required>
                                        </div>
                                    </div>
                                </fieldset>
                         </div>
                         <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                                <button type="submit" name="test" class="btn btn-success">Değiştir</button>
                         </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>