<?php echo !defined("GUVENLIK") ? die("Geçersiz istek") : null; ?>
<div class="content-header">
    <h3><i class="fa fa-star"></i> Projem</h3>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-lg-12">
            <?php if($projeCount > 0):?>
            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="proje" value="true">
                <input type="hidden" name="proje_id" value="<?=$proje['proje_id'];?>">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label" disabled>Proje No</label>
                        <div class="col-md-8">
                            <?php if($proje['proje_no']== null):?>
                            <?php warning('Proje numaranız henüz belirlenmemiş','0px');?>
                            <?php else:?>
                            <input disabled value="<?=$proje['proje_no']?>" class="form-control" required="" type="text">                 
                            <?php endif;?>
                        </div>
                    </div>
                    <?php if($proje['olusturan_id'] == getSession('id')):?>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Çalışma Türü</label>
                        <div class="col-md-8">
                            <select name="proje_tur" id="calisma" class="selectpicker form-control" data-live-search="true">
                                <option value="1" <?=$proje['proje_tur'] == 1 ? 'selected' : null; ?>>Bireysel Çalışma</option>
                                <option value="2" <?=$proje['proje_tur'] == 2 ? 'selected' : null; ?>>Grup Çalışması</option>  
                            </select>
                        </div>
                    </div>
                    <div class="grup-calisma hidden"> 
                        <div class="form-group">
                            <label class="col-md-4 control-label">Proje Ekibi</label>
                            <div class="col-md-8">
                                <select class="selectpicker form-control" multiple>
                                    <?php foreach($ogrenciler as $ogrenci):?>
                                          <?php if($ogrenci['ogrenci_id'] != getSession('id')): ?>
                                          <option value="<?=$ogrenci['ogrenci_id']?>" <?=$ogrenci['proje_id'] == $proje['proje_id'] ? 'selected' : null ?>><?=$ogrenci['ogrenci_isim']?></option>
                                          <?php endif;?>
                                    <?php endforeach;?> 
                                </select>
                            </div>
                        </div>  
                    </div>
                    <?php endif;?>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Proje Konusu</label>
                        <div class="col-md-8">
                            <input name="proje_konu" value="<?=$proje['proje_konu']?>" class="form-control" required="" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Proje Amacı</label>
                        <div class="col-md-8">
                            <textarea name="proje_amac" class="form-control" cols="10" rows="5" required=""><?=ss($proje['proje_amac']);?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Uygunluk</label>
                        <div class="col-md-8">
                            <?php if($proje['proje_uygunluk'] != null):?>
                            <input disabled value="<?=$proje['proje_uygunluk'] == 1 ? 'Kabul Edildi' : 'Kabul Edilmedi';?>" class="form-control"  type="text">
                            <?php else: ?>
                            <?php warning('Henuz belirlenmedi!','0px');?>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Proje Kontrolleri</label>
                        <div class="col-md-8">
                            <?php if($kontrols->rowCount() > 0):?>
                            <div class="input-group"> 
                                <select class="selectpicker form-control" data-live-search="true" id="kontrol" title="Başlık seçiniz">
                                    <?php foreach($kontrols->fetchAll(PDO::FETCH_ASSOC) as $kontrol):?>
                                        <option value="<?=$kontrol['kontrol_id'];?>"><?=$kontrol['kontrol_baslik'];?></option>
                                    <?php endforeach;?>
                                </select> 
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-git" type="button" id ="git">GİT!</button>
                                </span>
                            </div>
                            <?php else: info('Projeniz henüz kontrol edilmedi','0px'); endif;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Proje Dosyaları</label>
                        <div class="col-md-8"> 
                            <?php if($proje['proje_uygunluk'] == 1):?>
                                <input type="file" name="proje_dosya[]" multiple class="file-loading">
                            <?php else:?>
                                <?php warning('Projeniz henüz onaylanmadı. Onaylandıktan sonra dosya gönderebilirsiniz.');?>
                            <?php endif;?>
                        </div>
                    </div>

                    <?php if($proje['proje_bitirme'] != null):?>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Proje Bitirme Tarihi</label>
                        <div class="col-md-8">
                            <input type="text" disabled class="form-control" value="<?=myDate($proje['proje_bitirme'],true);?>">
                        </div>
                    </div>
                    <?php endif;?>

                    <div class="form-group">
                       <label class="col-md-4 control-label"></label>
                       <div class="col-md-8">
                          <button type="submit" class="btn btn-success" ><i class="fa fa-floppy-o"></i> Kaydet</button>
                          <?php if($proje['proje_uygunluk'] == 2 || empty($proje['proje_uygunluk'])):?>
                          <button type="button" id="proje_sil" data-id="<?=$proje['proje_id'];?>" class="btn btn-danger" ><i class="fa fa-trash-o"></i> Sil</button>
                         <?php else:?>
                          <button type="button" id="projeden_cik" data-id="<?=getSession('id');?>" data-proje="<?=$proje['proje_id']?>" class="btn btn-warning" ><i class="fa fa-sign-out"></i> Projeden Çık</button>
                         <?php endif;?>
                       </div>
                    </div>  
                </fieldset>
            </form>
            <?php else:?>
                <a href="<?=url('proje-ekle');?>" class="btn btn-success" style="margin-bottom:20px"><i class="fa fa-plus"></i> Proje Ekle</a>
                <?php warning('Projeniz bulunmuyor.');?>
            <?php endif;?>    
        </div>
    </div>
</div>