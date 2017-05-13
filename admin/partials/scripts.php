
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?=BACKEND_URL;?>js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?=BACKEND_URL;?>js/bootstrap.min.js"></script>

<!-- File İnput -->
<script src="<?=BACKEND_URL;?>vendor/fileinput/fileinput.min.js"></script>
<script src="<?=BACKEND_URL;?>vendor/fileinput/tr.js"></script>

<!-- Guidely JS -->
<script src="<?=BACKEND_URL;?>vendor/guidely/guidely.min.js"></script>
<?php if($do == "default"):?>
<script>
   
    $(function () {
        
        guidely.add ({
            attachTo: '#target-1'
            , anchor: 'bottom_middle'
            , title: 'Projeleri Takip Et'
            , text: 'Bu kısımdan öğrencilerin göndermiş olduğu projeleri bulabilirsiniz. Ayrıca bu bölümde projeleri düzenleyebilir, kontrol girdileri oluşturabilir ve öğrencilere mesaj gönderebilirsiniz.'
        });
        
        guidely.add ({
            attachTo: '#target-2'
            , anchor: 'bottom_middle'
            , title: 'Öğrencilere Gözat'
            , text: 'Burada sistemde kayıtlı olan öğrencileri görebilir ve onlara mesaj atabilirsiniz.'
        });
        
        guidely.add ({
            attachTo: '#target-3'
            , anchor: 'bottom_middle'
            , title: 'Yetkili Kişiler'
            , text: 'Bu kısımda ekli olan yetkili öğretmenleri görebilir ve yetkili öğretmen ekleyebilirsiniz.'
        });

        guidely.add ({
            attachTo: '#target-4'
            , anchor: 'bottom_middle'
            , title: 'Site Ayarları'
            , text: 'Sitenizin nasıl adlandırılacağını ve site ile ilgili küçük bilgilendirmede bulunabilirsiniz.'
        });

        guidely.add ({
            attachTo: '#target-5'
            , anchor: 'bottom_middle'
            , title: 'Profil Ayarları'
            , text: 'Kullanıcı adınızı ve şifrenizi bu bölümden değiştirebilirsiniz.'
        });


        guidely.add ({
            attachTo: '#target-6'
            , anchor: 'top_left'
            , title: 'Projeler'
            , text: 'Bu bölümde kaç tane projenin kayıtlı olduğunu görebilirsiniz.'
        });

        guidely.add ({
            attachTo: '#target-7'
            , anchor: 'top_left'
            , title: 'Olaylar Penceresi'
            , text: 'Bu bölümde öğrencilerin yapmış olduğu olaylar listelenmektedir.'
        });
        
        guidely.init ({
            welcomeTitle : 'Admin paneline hoş geldiniz.',
            welcomeText : 'Sisteme kısa bir göz gezdirmek için tura başlayın. Burada deneyiminizi kolaylaştırmak için önemli özellikleri ve ipuçlarını göstereksiniz.',
            showOnStart : true,
            welcome: true,
            startTrigger: false,
        });


    });
</script>
<?php endif;?>
<!-- Datatables -->
<script src="<?=BACKEND_URL;?>vendor/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?=BACKEND_URL;?>vendor/datatable/js/dataTables.jqueryui.min.js"></script>
<script src="<?=BACKEND_URL;?>vendor/datatable/js/dataTables.buttons.min.js"></script>
<script src="<?=BACKEND_URL;?>vendor/datatable/js/buttons.print.min.js"></script>
<script src="<?=BACKEND_URL;?>vendor/datatable/js/dataTables.bootstrap.min.js"></script>
<script src="<?=BACKEND_URL;?>vendor/datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("table").DataTable({
            dom: "Bfrtip",
            buttons: [
                {
                    text: '<i class="fa fa-lg fa-print"></i> Yazdır',
                    extend: 'print',
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '12pt' )

                        $(win.document.body).find( 'table tr td:not(:last-child)' )
                            .css({
                                'border-right' : '1px solid black',

                            });
                        $(win.document.body).find('table th:not(:last-child)')
                            .css({
                                'border-right' : '1px solid black',
                                'text-align' : 'center'
                            });
                    },
                    exportOptions: {
                        columns: ':not(.no-select)'
                    },
                    <?=get('do') == 'projeler' ? 'title : "Projeler"' : (get('do') == 'ogrenciler' ? 'title : "Öğrenciler"' : (get('do') == 'ogretmenler' ? 'title:"Öğretmenler"' : 'title: "Olaylar"'));?>
                },
            ],
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

<script src="<?=BACKEND_URL;?>js/moment-with-locales.js"></script>
<script src="<?=BACKEND_URL;?>js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            locale : 'tr',
            format : 'YYYY-MM-DD H:mm:ss'
        });
    });
</script>
<script src="<?=BACKEND_URL;?>js/bootstrap-select.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('.selectpicker').selectpicker();
    });
    var URL = "<?=URL;?>";
    var BACKEND_URL = "<?=BACKEND_URL;?>";
</script>
<script src="<?=BACKEND_URL;?>js/sweetalert.min.js" charset="utf-8"></script>
<script src="<?=BACKEND_URL;?>js/custom.js" charset="utf-8"></script>
