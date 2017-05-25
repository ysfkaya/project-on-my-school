$(document).ready(function(){

    // Navbar
    var _smallScroll = 105;
    $(window).scroll(function() {
      var _scroll = getCurrentScroll();
          if ( _scroll >= _smallScroll ) {
             $('.p-nav').addClass('effect-nav');
          }
          else {
              $('.p-nav').removeClass('effect-nav');
          }
    });


    function getCurrentScroll() {
        return window.pageYOffset || document.documentElement.scrollTop;
    }

    // Link tıklaması - navbar
    $(document).on('click', 'a.page-scroll', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1000, 'easeInOutExpo');
        event.preventDefault();
    });


    // kontrol sayfasına git
    var git = "";
    $("#kontrol").change(function(event) {
        git = $(this).val();
    });
    $("#git").click(function(event) {
        if (git == ""){
            return false;
        }else{
            window.location.href = URL+"?do=kontrol&id="+git;
        }
    });


    //mesaj sil
     $("body").on('click','#mesaj_sil',function(event) {
            var _id = $(this).attr("data-id");
            swal({
                title : "Bu mesaj silinecektir !",
                type : "warning",
                text: "Bu mesajı kalıcı olarak silmek istediğinize emin misiniz ?",
                confirmButtonText : 'Evet, sil',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Hayır, silme!",
                closeOnConfirm: false,
                closeOnCancel: false
            },function(isConfirm){
                if (isConfirm){
                    $.ajax({
                    url: URL+'/ajax/mesaj_sil.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {id: _id},
                    success : function(data) {
                        if (data.silindi){
                            swal({
                                title : "Başarılı !",
                                text: "Mesaj başarıyla silindi",
                                type : 'success',
                                confirmButtonText : 'Tamam',
                                closeOnConfirm : false,
                            },function(){
                                location.reload();
                            });
                        }else{
                            swal({
                                title: 'Hata',
                                type : 'error',
                                text : data.hata,
                                confirmButtonText : 'Tamam',
                                closeOnConfirm : true
                            }) 
                        }
                    }
                });
                }
            });
            
        });

    // mesaj oku 
    $("body").on('click','#mesaj_oku',function(event) {
        event.preventDefault();
        var _id = $(this).attr("data-id");
        $.ajax({
            url: URL+'/ajax/mesaj_oku.php',
            type: 'POST',
            dataType: 'json',
            data: {id: _id},
            success : function(data) {
                if (data.okundu){
                    swal({
                        title : data.baslik,
                        text: data.mesaj,
                        confirmButtonText : 'Anlaşıldı',
                        closeOnConfirm : true,
                        html: true
                    });
                }else{
                    swal({
                        title: 'Hata',
                        type : 'error',
                        text : data.hata,
                        confirmButtonText : 'Tamam',
                        closeOnConfirm : true
                    }) 
                }
            }
        });
        
    });


    //sifre değiştir
    $("body").on('submit', '#degis', function(event) {
        event.preventDefault();
        
        var y_sifre = $("#y_sifre"),
            t_sifre = $("#t_sifre"),
            m_sifre = $("#m_sifre"),
            id = $("#user_id").val();
        if (y_sifre.val() != t_sifre.val()){

            y_sifre.addClass('has-danger');
            y_sifre.parent().parent().find('.yeni').addClass('has-error');
            y_sifre.parent().find('.hata-yeni').html('Şifreler uyuşmuyor.');


            t_sifre.addClass('has-danger');
            t_sifre.parent().parent().find('.tekrar').addClass('has-error');
            t_sifre.parent().find('.hata-tekrar').html('Şifreler uyuşmuyor.');

        }else{
            if (y_sifre.hasClass('has-danger') || t_sifre.hasClass('has-danger')){
                y_sifre.removeClass('has-danger');
                t_sifre.removeClass('has-danger');

                $('.yeni').removeClass('has-error');
                $('.tekrar').removeClass('has-error');

                $('.hata-tekrar').html('');
                $('.hata-yeni').html('');
            }
            $.ajax({
                url: URL+'/ajax/sifre_degis.php',
                type: 'POST',
                dataType: 'json',
                data: {yeni_sifre:y_sifre.val(),mevcut_sifre:m_sifre.val(),id:id},
                success : function(data) {
                    if (data.basarili){
                        swal({
                        title:'Başarılı !',
                        text:data.basarili,
                        type:'success',
                        timer:1800,
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        showConfirmButton : false
                        });
                        setTimeout(function() {
                            window.location.href = URL+"?do=ayarlar";
                        },2000);
                    }else{
                        swal({
                            title:'Hata !',
                            text:data.hata,
                            type:'error',
                            closeOnConfirm: true,
                            animation: "slide-from-top",
                            showCancelButton: false,
                            cancelButtonText:'Tamam'
                        });
                    }
                    
                }
            });            
            
        }
    });

    // eposta değiştir
     $("body").on('submit', '#eposta', function(event)  {
        event.preventDefault();
        $('#eposta_goster').modal('hide');
        $("#loading").removeClass('hidden');
        var $eposta = $("#y_eposta").val();
        $.ajax({
            type:'POST',
            url:URL+'/ajax/eposta_degis.php',
            data:{eposta:$eposta},
            dataType:'json',
            success: function (data) {
                $('#loading').addClass('hidden');
                if(data.var){
                    swal("Uyarı !",data.var,"warning");
                }else if(data.gonderildi){
                    swal({
                            title: "Onay Kodu Gönderildi!",
                            text: 'Doğru bir eposta adresini girdiğinizden emin olmak için lütfen onay kodunu giriniz.',
                            type: "input",
                            closeOnConfirm: false,
                            animation: "slide-from-top",
                            inputPlaceholder: "Onay kodunu buraya giriniz."
                        },
                        function(inputValue){
                            $.trim(inputValue);
                            if (inputValue === false) return false;

                            if (inputValue === "") {
                                swal.showInputError("Lütfen boş bırakmayınız!");
                                return false;
                            }
                            if (data.kod == inputValue){
                                $.ajax({
                                    type:'POST',
                                    url:URL+'/ajax/eposta_degis.php',
                                    data:{eposta:$eposta,eposta_degis:true},
                                    dataType:'json',
                                    success : function (dat) {
                                        if (dat.basarili){
                                            swal({
                                                title:'Başarılı !',
                                                text:dat.basarili,
                                                type:'success'
                                            },function () {
                                                window.location.href = URL+"?do=ayarlar";
                                            });
                                        }else{
                                            swal("Hata !",dat.hata,"error");
                                        }
                                    }
                                });
                            }else{
                                swal.showInputError("Girdiğiniz kod hatalı!");
                            }
                        });

                }else{
                    swal("Hata !",data.hata,'error');
                }
                $('#eposta')[0].reset();
                
            }
        });

    });

    // kayit form
    $("#kayit").on('submit',function (e) {
        e.preventDefault(); // submit işlemini geçersiz kılıyoruz.
        $("#loading").removeClass('hidden'); // animasyon gif div'ini görünür yapıyoruz.
        /* Değerleri alıyoruz. */
        var $no = $("#okul_no");
        var $ad = $("#adiniz").val();
        var $eposta = $("#eposta").val();
        $.ajax({ // ilk ajax isteğimiz mail gönderme kısmıdır.
            type:'POST', // post işlemine tabi tutuyoruz.
            url:URL+'/ajax/kayit.php', // ajax dosyamızı belirliyoruz.
            data:{ad:$ad,no:$no.val(),eposta:$eposta}, // gönderilecek verilerimizi belirliyoruz
            dataType:'json', // veri türünü belirliyoruz. 
            success: function (data) { // işlem başarılı ise çalıcak kısım.
                if(data.var){
                    $("#loading").addClass('hidden');
                    swal("Uyarı !",data.var,"warning");
                }else if(data.onay){
                    $("#loading").addClass('hidden');
                    swal({
                            title: "Onay Kodu!",
                            text: 'Doğru bir eposta adresini girdiğinizden emin olmak için lütfen onay kodunu giriniz.',
                            type: "input",
                            closeOnConfirm: false,
                            animation: "slide-from-top",
                            inputPlaceholder: "Onay kodunu buraya giriniz."
                        },
                        function(inputValue){
                            inputValue = $.trim(inputValue);
                            if (inputValue === false) return false;

                            if (inputValue === "") {
                                swal.showInputError("Lütfen boş bırakmayınız!");
                                return false;
                            }
                            if (data.kod == inputValue){
                                $.ajax({ // bu ajax isteğimizde mail adresinden girilen kod doğru ise veritabanına kaydetmek içindir.
                                    type:'POST',
                                    url:URL+'/ajax/kayit.php',
                                    data:{kayit:data.kayit,kayityap:true},
                                    dataType:'json',
                                    success : function (dat) {
                                        if (dat.basarili){
                                            swal({
                                                title:'Başarılı !',
                                                text:dat.basarili,
                                                type:'success'
                                            },function () {
                                                window.location.href = URL;
                                            });
                                        }else{
                                            swal("Hata !",dat.hata,"error");
                                        }
                                    }
                                });
                            }else{
                                swal.showInputError("Girdiğiniz kod hatalı!");
                            }
                        });

                }else{
                    $("#loading").addClass('hidden');
                    swal("Hata !",data.hata,'error');
                }
            }
        });

    });

    // giris form
    $("#giris").on('submit',function(e) {
        e.preventDefault(); // submit işlemini geçersiz kılıyoruz.
        
        //değerleri alıyoruz.
        var $no = $("#g_okul_no").val();
        var $sifre = $("#g_sifre").val();

        $.ajax({ // ajax isteğini başlatıyoruz.
            type:'POST',
            url:URL+'/ajax/giris.php',
            data:{okul_no:$no,sifre:$sifre},
            dataType:'json',
            success: function (data) {
                if(data.uyari){
                    $("#hata").html(data.uyari);
                }else if(data.basarili){
                    $("#hata").html('');
                     swal({
                        title:'Başarılı !',
                        text:data.basarili,
                        type:'success',
                        timer:1800,
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        showConfirmButton : false
                    });
                    setTimeout(function() {
                        window.location.href = URL;
                    },2000);
                }else{
                    swal("Zaman Aşımı !","İşlem zaman aşımına uğradı. Lütfen daha sonra tekrar deneyiniz.",'error');
                }
            }
        });


    });

    //proje ekleme
    $("#calisma").change(function(event) {
        var value = $(this).val();
        if (value == 2){
            $('.grup-calisma').removeClass('hidden');
            $('.grup-calisma select').attr('name', 'proje_ekip[]');
        }else{
            $('.grup-calisma').addClass('hidden');
            $('.grup-calisma select').removeAttr('name');            
        } 
    });
    var calisma = $("#calisma").val();
    if (calisma == 2){
        $('.grup-calisma').removeClass('hidden');
        $('.grup-calisma select').attr('name', 'proje_ekip[]');

    }


    //projeden çık
    $("#projeden_cik").click(function(event) {
        var _this = $(this);
        swal({
            title:'Projeden Çık',
            type:'warning',
            text:'Projeden çıkmak istediğinizden emin misiniz?',
            showCancelButton: true,
            confirmButtonText: "Evet, eminim!",
            cancelButtonText: "Hayır",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
                var id = _this.attr('data-id');
                var proje = _this.attr('data-proje');
                $.ajax({
                    url: URL+'/ajax/projeden_cik.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {id: id,proje_id:proje},
                    success : function(data) {
                        if(data.basarili){
                            swal({
                                title:'Başarılı !',
                                text:data.basarili,
                                type:'success',
                                timer:1800,
                                closeOnConfirm: false,
                                animation: "slide-from-top",
                                showConfirmButton : false
                            });
                            setTimeout(function() {
                                window.location.href = URL+"?do=projem";
                            },2000);
                        }else{
                            swal({
                                title:'Hata !',
                                text:data.hata,
                                type:'success',
                                closeOnConfirm: true,
                                animation: "slide-from-top",
                                showConfirmButton : true,
                                confirmButtonText:'Tamam'

                            });
                        }
                    }
                });                
            }
        });

    });

    //proje sil
    $("#proje_sil").click(function(event) {
        var _this = $(this);
        swal({
            title:'Proje Sil',
            type:'warning',
            text:'Bu projeyi kalıcı olarak silmek istediğinizden emin misiniz?',
            showCancelButton: true,
            confirmButtonText: "Evet, eminim!",
            cancelButtonText: "Hayır",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
                var id = _this.attr('data-id');
                $.ajax({
                    url: URL+'/ajax/proje_sil.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {id: id},
                    success : function(data) {
                        if(data.basarili){
                            swal({
                                title:'Başarılı !',
                                text:data.basarili,
                                type:'success',
                                timer:1800,
                                closeOnConfirm: false,
                                animation: "slide-from-top",
                                showConfirmButton : false
                            });
                            setTimeout(function() {
                                window.location.href = URL+"?do=projem";
                            },2000);
                        }else{
                            swal({
                                title:'Hata !',
                                text:data.hata,
                                type:'success',
                                closeOnConfirm: true,
                                animation: "slide-from-top",
                                showConfirmButton : true,
                                confirmButtonText:'Tamam'

                            });
                        }
                    }
                });                
            }
        });

    });

    setInterval(function(){ 
        if ($('#modal-video').hasClass('in') == false){
            $('video')[0].pause();
        }
     }, 500);


});