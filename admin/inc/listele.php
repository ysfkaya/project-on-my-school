<?php
echo !defined("ADMIN") ? die("İzinsiz Giriş İsteği?") : null;

$id = get('id') ? get('id') : go("javascript:history.go(-1)");
$kontrol = $db->prepare("SELECT * FROM kontrol WHERE proje_id = :id Order By kontrol_tarih desc");
$kontrol->execute(array('id' => $id));
if ($kontrol->rowCount() < 1) {
   warning("Kontrol bulunamadı."); 
}else{    
?>
<div class="row">
    <div class="col-md-12">
      <div class="panel with-nav-tabs panel-default">
        <div class="panel-body">
            <table id="table" class="display responsive" cellspacing="0" width="100%">
            <a href="<?=url('kontrol&id='.$id)?>" class="btn btn-success pull-right"><i class="fa fa-plus-circle"></i> Kontrol Ekle</a>
                <thead>
                <tr>
                    <th>ID #</th>
                    <th>Başlık</th>
                    <th>Not</th>
                    <th>Proje Yüzdesi</th>
                    <th>Tarih</th>
                    <th class="no-select" width="10%">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($kontrol->fetchAll(PDO::FETCH_ASSOC) as $kon): extract($kon);?>
                    <tr>
                        <td><?=$kontrol_id;?></td>
                        <td><?=$kontrol_baslik;?></td>
                        <td><?=$kontrol_not;?></td>
                        <td><?=$proje_yuzde;?></td>
                        <td><?=myDate($kontrol_tarih);?></td>
                        <td class="no-select">
                            <a href="<?=url('kontrol_duzenle&id='.$kontrol_id)?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Düzenle</a>
                            <button type="button" id="kontrol_sil" data-id="<?=$kontrol_id?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</button>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>
<?php }?>
