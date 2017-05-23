<?php echo !defined("GUVENLIK") ? die("Geçersiz istek") : null;

$id = get('id') ? get('id') : null;

?>

<div class="content-header">
    <h3><i class="fa fa-bookmark"></i> Proje Kontrolleri</h3>
</div>
<?php
if(!empty($id)){

$sorgu = $db->prepare("SELECT * FROM kontrol WHERE kontrol_id = :id AND proje_id = :proje_id");
$sorgu->execute(array('id' => $id,'proje_id' => $proje_id));

  if ($sorgu->rowCount() > 0) {
  $row = $sorgu->fetch(PDO::FETCH_ASSOC);  


  ?>
  <div class="content-body">
      <div class="row">
          <div class="col-lg-12">
                <form class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Kontrol Başlık</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" disabled value="<?=$row['kontrol_baslik'];?>">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Kontrol Eden Öğretmen Notu</label>
                        <div class="col-md-8">
                          <textarea disabled class="form-control" cols="10" rows="5"><?=$row['kontrol_not'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Proje Bitrime Yüzdesi</label>
                        <div class="col-md-8">
                            <div class="progress progress-striped active m-b-sm">
                                <div style="width: <?=$row['proje_yuzde']?>%;" class="progress-bar"></div>
                            </div>
                            <p>Proje <strong>% <?=$row['proje_yuzde'];?></strong> tamamlandı.</p>
                        </div>
                    </div>
                    <div class="form-group">
                       <label class="col-md-4 control-label"></label>
                       <div class="col-md-8">
                          <a href="<?=url('kontrol');?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                       </div>
                    </div>  
                </fieldset>
                </form>
          </div>
      </div>
  </div>
  <?php  
  }else{
    warning("Proje kontrolü bulunamadı.");
  }

?>


<?php    
}else{

?>
<div class="content-body">
    <div class="row">
        <div class="col-lg-12">
        <?php if($kontrols > 0):?>
            <table class="table table-responsive">
              <thead>
                <th>ID #</th>
                <th>Başlık</th>
                <th>Kontrol Tarihi</th>
                <th width="15%">İşlemler</th>
              </thead>
              <tbody>
                <?php foreach($kontrols->fetchAll(PDO::FETCH_ASSOC) as $kontrol): extract($kontrol);?>

                  <tr>
                    <td><?=$kontrol_id;?></td>
                    <td><?=$kontrol_baslik;?></td>
                    <td><?=myDate($kontrol_tarih,true);?></td>
                    <td>
                      <a href="<?=url("kontrol&id=".$kontrol_id);?>" class="btn btn-success btn-xs"><i class="fa fa-sign-in"></i> İncele</a>
                    </td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          <?php else:?>
              <?php warning("Projeniz henüz kontrol edilmemiş.");?>
          <?php endif; ?>
        </div>
    </div>
</div>

<?php }?>
