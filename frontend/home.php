<?php echo !defined("GUVENLIK") ? die("Geçersiz istek") : null;?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$ayar['site_baslik'];?></title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" media="screen" title="no title">
    <!-- Bootstrap -->
    <link href="<?=asset("css/bootstrap.min.css")?>" rel="stylesheet" media="screen" title="no title">
    <!-- Font Awesome -->
    <link href="<?=asset("vendor/font-awesome/css/font-awesome.min.css")?>" rel="stylesheet" media="screen" title="no title">

    <!-- Sweet Alert   -->
    <link rel="stylesheet" href="<?=asset("css/sweetalert.css");?>">

    <!-- File İnput -->
    <link href="<?=asset("vendor/fileinput/fileinput.min.css")?>" rel="stylesheet" media="screen" title="no title">
    
    <!-- Selectpicker -->
    <link rel="stylesheet" href="<?=asset('css/bootstrap-select.min.css')?>">


    <!-- Datatables -->
    <link href="<?=asset('vendor/datatable/css/jquery.dataTables.min.css');?>" rel="stylesheet">
    <link href="<?=asset('vendor/datatable/css/jquery.dataTables_themeroller.css');?>" rel="stylesheet">
    <link href="<?=asset('vendor/datatable/css/buttons.dataTables.min.css');?>" rel="stylesheet">
    <link href="<?=asset('vendor/datatable/css/responsive.dataTables.min.css');?>" rel="stylesheet">

    <!-- User CSS-->
    <link rel="stylesheet" href="<?=asset('css/user.css');?>">
    <style>
    .kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        text-align: center;
    }
    .kv-avatar .file-input {
        display: table-cell;
        max-width: 220px;
    }
    .btn-file{
        display: block;
    }
    .kv-file-zoom{
      display:none
    }

    </style>

</head>
<body>
    <div class="profil">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?php require_once 'inc/user/left.php';?>
                </div>
                <div class="col-md-9">
                    <div class="panel">
                        <div class="content">
                            <?php 
                            /**
                             * Burdaki değişkenleri global olarak tüm sayfalarda kullanmak için çektik.
                             */
                            $get = proje(); // proje bilgilerini çektik

                            $proje = $get[0]->fetch(PDO::FETCH_ASSOC); // projeleri verilerini bir dizi haline getirdik.
                            $projeCount = $get[0]->rowCount(); // proje sayısını çektik. 
                            $id = $proje['proje_id'];

                            // proje nin kontrol sayısı.
                            if ($id) {
                                $kontrols = $db->query("SELECT * FROM kontrol WHERE proje_id = $id");                                
                            }else{
                                $kontrols = 0;
                            }

                            $ogrenciler = $get[1]->fetchAll(PDO::FETCH_ASSOC); // proje ekibi oluştururken kullanılacak öğrenciler değişkeni.

                            /**
                             * frontend.php kısmında oluşturulan içerik fonksiyonunu dahil ettik.
                             * Bu fonksiyon sayesinde tıkladığımız linke göre bir 'do' get isteği gönderiliyor
                             * ve bu fonksiyonda get isteğini alıp işleme tabi tutuyoruz ona göre de gerekli klasörü
                             * çağırıyor ve sistemin düzgün çalışmasını sağlıyor.
                             */
                            icerikler();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=asset('js/jquery.min.js');?>"></script>
    <script src="<?=asset('js/bootstrap.min.js');?>"></script>
    <script src="<?=asset('js/bootstrap-select.min.js')?>"></script>
    <script src="<?=asset('js/defaults-tr_TR.min.js')?>"></script>
    <script src="<?=asset('vendor/fileinput/fileinput.min.js')?>"></script>
    <script src="<?=asset('vendor/fileinput/tr.js')?>"></script>
    <script type="text/javascript">

        var URL = "<?=URL;?>";
        jQuery(document).ready(function() {
            <?php if(get('do') == 'ayarlar'):?>
            var _resim = $("#resim").attr('data-img');
            $("#resim").fileinput({
                language : "tr",
                overwriteInitial: true,
                maxFileSize: 2048,
                showClose: false,
                showCaption: false,
                defaultPreviewContent: '<img src="'+_resim+'" alt="Resim" style="width:160px">',
                layoutTemplates: {main2: '{preview} {browse}'},
                allowedFileExtensions: ["jpg", "png", "gif"]
            });            
            <?php endif;?>
            <?php if(get('do') == 'projem'):?>
            var _id = $('input[name=proje_id]').val();
            $('input[type=file]').fileinput({
                language: "tr",
                showZoom:false,
                showCaption: false,
                allowedFileExtensions: ["zip", "rar"],
                uploadUrl: URL+"/ajax/dosya_yukle.php",
                uploadAsync: true,
                overwriteInitial: false,
                maxFileSize:5242880,
                initialPreviewConfig: [
                    <?php
                        $dosyalar = dosya_listele($proje['proje_id'],true);
                        foreach ($dosyalar as $key => $value) {
                    ?>
                    {size: <?=$value['dosya_boyut']?>, filetype: "rar", caption: "<?=$value['dosya_ad']?>", filename: "<?=$value['dosya_ad']?>", url: URL+"/ajax/dosya_sil.php", key: <?=$value['dosya_id']?>},
                    <?php
                        }
                    ?>

                ],
                initialPreview: [
                    <?php
                        $dosyalar = dosya_listele($proje['proje_id']);
                        $listele = array();
                        foreach ($dosyalar as $key => $value) {
                            $listele[] = " \"$value\" ";
                        }
                        echo implode(', ', $listele);
                    ?>
                ],
                initialPreviewAsData: true, // defaults markup
                initialPreviewFileType: 'image', // image is the default and can be overridden in config below
                uploadExtraData: function () {
                    return {
                        id : _id
                    }
                },
                preferIconicPreview: true,
                previewFileIconSettings: {
                    'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
                },
                previewFileExtSettings: {
                    'zip': function(ext) {
                        return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                    },
                }
            });
            $("input[type=file]").on("filepredelete", function(jqXHR) {
                var abort = true;
                if (confirm("Bu dosya kalıcı olarak silinecektir !")) {
                    abort = false;
                }
                return abort;
            });

            <?php endif;?>
            
        });
    </script>
    <script src="<?=asset("js/sweetalert.min.js");?>"></script>
    <?php if(get('do') == 'yeni_mesajlar' || get('do') == 'mesajlar'):?>
    <!-- Datatables -->
    <script src="<?=asset('vendor/datatable/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?=asset('vendor/datatable/js/dataTables.jqueryui.min.js');?>"></script>
    <script src="<?=asset('vendor/datatable/js/dataTables.buttons.min.js');?>"></script>
    <script src="<?=asset('vendor/datatable/js/buttons.print.min.js');?>"></script>
    <script src="<?=asset('vendor/datatable/js/dataTables.bootstrap.min.js');?>"></script>
    <script src="<?=asset('vendor/datatable/js/dataTables.responsive.min.js');?>"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("table").DataTable({
            responsive: true,
            language : {
                "sDecimal": ",",
                "sEmptyTable": "Tabloda herhangi bir veri mevcut değil",
                "sInfo": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
                "sInfoEmpty": "Kayıt yok",
                "sInfoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "Sayfada _MENU_ kayıt göster",
                "sLoadingRecords": "Yükleniyor...",
                "sProcessing": "İşleniyor...",
                "sSearch": "Ara:",
                "sZeroRecords": "Eşleşen kayıt bulunamadı",
                "oPaginate": {
                    "sFirst": "İlk",
                    "sLast": "Son",
                    "sNext": "Sonraki",
                    "sPrevious": "Önceki"
                },
                "oAria": {
                    "sSortAscending": ": artan sütun sıralamasını aktifleştir",
                    "sSortDescending": ": azalan sütun soralamasını aktifleştir"
                },
                "buttons": {
                    "copyTitle": 'Kopyalama işlemi başarılı !',
                    "copySuccess": {
                        "_": '%d satır kopyalandı',
                        "1": '1 satır kopyalandı'
                    }
                }
            }
        });
    });
</script>
    <?php endif;?>
    <script src="<?=asset('js/custom.js')?>"></script>
    
</body>
</html>