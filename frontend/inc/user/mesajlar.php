<?php echo !defined("GUVENLIK") ? die("Geçersiz istek") : null;?>
<div class="content-header">
    <h3><i class="fa fa-envelope"></i> Mesajlar</h3>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-responsive">
              <thead>
                <th>Mesaj ID #</th>
                <th>Mesaj Gönderen Öğretmen</th>
                <th>Mesaj Başlığı</th>
                <th>Mesaj Gönderim Tarihi</th>
                <th width="15%">İşlemler</th>
              </thead>
              <tbody>
                <?php foreach($mesajlar as $mesaj): extract($mesaj);?>
                  <tr>
                    <td><?=$mesaj_id;?></td>
                    <td><?=$ogretmen_ad." ".$ogretmen_soyad;?></td>
                    <td><?=$baslik;?></td>
                    <td><?=myDate($tarih,true);?></td>
                    <td>
                      <button type="button" data-id="<?=$mesaj_id;?>" id="mesaj_oku" class="btn btn-success btn-xs"><i class="fa fa-envelope-open"></i> Oku</button>
                      <button type="button" data-id="<?=$mesaj_id;?>" id="mesaj_sil" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Sil</button>
                    </td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
        </div>
    </div>
</div>
