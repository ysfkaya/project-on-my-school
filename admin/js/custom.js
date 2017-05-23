$(document).ready(function () {

    var _url = document.URL;
    var _tab = _url.split("#")[1];
    var _bool = _url.indexOf(_tab);

    if (_bool > 0){
        $('.nav-tabs a[href="#' + _tab + '"]').tab('show');
    }


   // file input
    var _resim1 = $("#resim1").attr('data-img');
    $("#resim1").fileinput({
        language : "tr",
        overwriteInitial: true,
        maxFileSize: 2048,
        showClose: false,
        showCaption: false,
        defaultPreviewContent: '<img src="'+_resim1+'" alt="Resim" style="width:160px">',
        layoutTemplates: {main2: '{preview} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });
    var _resim2 = $("#resim2").attr('data-img');
    $("#resim2").fileinput({
        language : "tr",
        overwriteInitial: true,
        maxFileSize: 2048,
        showClose: false,
        showCaption: false,
        defaultPreviewContent: '<img src="'+_resim2+'" alt="Resim" style="width:160px">',
        layoutTemplates: {main2: '{preview} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });  


    // olay sil
    $("body").on('click','#olay_sil',function(event){
        event.preventDefault();
        var _id = $(this).attr('data-id');
        swal({
          title: "Olay Sil",
          text: "Seçtiğiniz olay kalıcı olarak silinecektir. Bu olayı silmek istediğinize emin misiniz ?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Evet, sil!",
          cancelButtonText: "İptal",
          closeOnConfirm: false
        },
        function(){
            $.ajax({
                url: URL+'/ajax/olay_sil.php',
                type: 'POST',
                dataType: 'json',
                data: {id:_id},
                success : function(data) {
                    if(data.silindi){
                        swal({
                            title:'Başarılı !',
                            text:'Olay silindi',
                            type:'success',
                            timer:1800,
                            closeOnConfirm: false,
                            animation: "slide-from-top",
                            showConfirmButton : false
                        });
                        setTimeout(function() {
                            window.location.href = BACKEND_URL;
                        },2000);
                    }else{
                        swal({
                            title:'Hata !',
                            text:data.hata,
                            type:'error',
                            closeOnConfirm: true,
                            animation: "slide-from-top",
                            showConfirmButton : true,
                            confirmButtonText:'Tamam'

                        });
                    }
                }
            });
            
        });
    });


    // ogretmen sil
    $("body").on('click','#ogretmen_sil',function(event){
        event.preventDefault();
        var _id = $(this).attr('data-id');
        swal({
          title: "Öğretmen Sil",
          text: "Seçtiğiniz öğretmen kalıcı olarak silinecektir. Bu öğretmeni silmek istediğinize emin misiniz ?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Evet, sil!",
          cancelButtonText: "İptal",
          closeOnConfirm: false
        },
        function(){
            $.ajax({
                url: URL+'/ajax/ogretmen_sil.php',
                type: 'POST',
                dataType: 'json',
                data: {id:_id},
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
                            window.location.href = BACKEND_URL+"index.php?do=ogretmenler";
                        },2000);
                    }else{
                        swal({
                            title:'Hata !',
                            text:data.hata,
                            type:'error',
                            closeOnConfirm: true,
                            animation: "slide-from-top",
                            showConfirmButton : true,
                            confirmButtonText:'Tamam'

                        });
                    }
                }
            });
            
        });
    });

    // ogrenci sil
    $("body").on('click','#ogrenci_sil',function(event){
        event.preventDefault();
        var _id = $(this).attr('data-id');
        swal({
          title: "Öğrenciyi Sil",
          text: "Seçtiğiniz öğrenci kalıcı olarak silinecektir. Bu öğrenciyi silmek istediğinize emin misiniz ?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Evet, sil!",
          cancelButtonText: "İptal",
          closeOnConfirm: false
        },
        function(){
            $.ajax({
                url: URL+'/ajax/ogrenci_sil.php',
                type: 'POST',
                dataType: 'json',
                data: {id:_id},
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
                            window.location.href = BACKEND_URL+"index.php?do=ogrenciler";
                        },2000);
                    }else{
                        swal({
                            title:'Hata !',
                            text:data.hata,
                            type:'error',
                            closeOnConfirm: true,
                            animation: "slide-from-top",
                            showConfirmButton : true,
                            confirmButtonText:'Tamam'

                        });
                    }
                }
            });
            
        });
    });


    // proje sil
    $("body").on('click','#proje_sil',function(event){
    	event.preventDefault();
    	var _id = $(this).attr('data-id');
    	swal({
		  title: "Projeyi Sil",
		  text: "Seçtiğiniz proje kalıcı olarak silinecektir. Bu projeyi silmek istediğinize emin misiniz ?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Evet, sil!",
		  cancelButtonText: "İptal",
		  closeOnConfirm: false
		},
		function(){
		  	$.ajax({
		  		url: URL+'/ajax/proje_sil.php',
		  		type: 'POST',
		  		dataType: 'json',
		  		data: {id:_id},
		  		success : function(data) {
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
                            window.location.href = BACKEND_URL+"index.php?do=projeler";
                        },2000);
                },
                error : function (data) {
                    swal({
                        title:'Hata !',
                        text:data.hata,
                        type:'error',
                        closeOnConfirm: true,
                        animation: "slide-from-top",
                        showConfirmButton : true,
                        confirmButtonText:'Tamam'

                    });
                }
		  	});
		  	
		});
    });

    // mesaj gonder
    $("body").on('submit','#mesaj_gonder',function(e) {
        e.preventDefault();
        var _gonderen = $(this).parent().find("#mesaj_gonderen_id").val();
        var _alici = $(this).parent().find('#mesaj_alici_id').val();
        var _mesaj = $(this).parent().find('#mesaj');
        var _baslik = $(this).parent().find('#baslik');


        var _id = $(this).parent().find("#modal_id").val();

        $.ajax({
            url: URL+'/ajax/mesaj_gonder.php',
            type: 'POST',
            dataType: 'json',
            data: {gonderen: _gonderen,alici:_alici,mesaj:_mesaj.val(),baslik:_baslik.val()},
            success : function(data) {
                if(data.basarili){
                    swal({
                        title:'Başarılı !',
                        text:data.basarili,
                        type:'success',
                        closeOnConfirm: true,
                        animation: "slide-from-top",
                        showConfirmButton : true,
                        confirmButtonText: 'Tamam',
                        confirmButtonColor: '#22BB42'
                    },
                    function() {
                        _mesaj.val('');
                        _baslik.val('');
                        $("#mesaj-"+_id).modal("hide");
                    });
                }else{
                    swal({
                        title:'Hata !',
                        text:data.hata,
                        type:'error',
                        closeOnConfirm: true,
                        animation: "slide-from-top",
                        showConfirmButton : true,
                        confirmButtonText:'Tamam'
                    });
                }
            }
        });
    });

});