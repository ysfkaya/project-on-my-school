<?php echo !defined("GUVENLIK") ? die("Geçersiz istek") : null; ?>
<div class="content-header">
    <h3><i class="fa fa-star-o"></i> Proje Ekle</h3>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-lg-12">
            <form action="<?=url('proje-ekle')?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="proje_ekle" value="true">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Çalışma Türü</label>
                        <div class="col-md-8">
                            <select name="proje_tur" class="selectpicker form-control" id="calisma">
                                <option value="1">Bireysel Çalışma</option>
                                <option value="2">Grup Çalışması</option>  
                            </select>
                        </div>
                    </div>  
                    <div class="grup-calisma hidden">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Proje Ekibi</label>
                            <div class="col-md-8">
                                <?php if(count($ogrenciler) > 1): // kayıtlı başka öğrenci varsa öğrencileri seçebilir.?>
                                <select name="proje_ekip[]" class="selectpicker form-control" multiple>
                                    <?php foreach($ogrenciler as $ogrenci):?>
                                          <?php if($ogrenci['ogrenci_id'] != getSession('id')): ?>
                                                <option 
                                                    <?=$ogrenci['proje_id'] != null ? 'disabled' : null;?>
                                                    value="<?=$ogrenci['proje_id'] != null ? null : $ogrenci['ogrenci_id'];?>"
                                                >
                                                <?=$ogrenci['ogrenci_isim']?>
                                                </option>
                                          <?php endif;?>
                                    <?php endforeach;?> 
                                </select>
                                <?php else:?>
                                    <?php warning('Kayıtlı başka öğrenci bulunmuyor. Yinede çalışma türünü seçebilirsiniz.','0px');?>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Proje Konusu</label>
                        <div class="col-md-8">
                            <input name="proje_konu" class="form-control" required type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Proje Amacı</label>
                        <div class="col-md-8">
                            <textarea name="proje_amac" class="form-control" cols="10" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                       <label class="col-md-4 control-label"></label>
                       <div class="col-md-8">
                          <button type="submit" class="btn btn-success">Gönder</button>
                       </div>
                    </div>  
                </fieldset>
            </form>   
        </div>
    </div>
</div>