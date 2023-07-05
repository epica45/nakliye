        <!-- footer content -->

        <footer class="no-print">

          <div class="pull-right">

            Nakliye Sorgulama - Designed by <a href="https://nakliye.com">Nakliye</a>

          </div>

          <div class="clearfix"></div>

        </footer>

        <!-- /footer content -->

      </div>

    </div>



    <!-- jQuery -->

    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

    <!-- jQuery Validate -->

    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>

    <!-- Bootstrap -->

    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- FastClick -->

    <script src="<?php echo base_url(); ?>assets/fastclick/lib/fastclick.js"></script>

    <!-- NProgress -->

    <script src="<?php echo base_url(); ?>assets/nprogress/nprogress.js"></script>

    <!-- Chart.js -->

    <script src="<?php echo base_url(); ?>assets/Chart.js/dist/Chart.min.js"></script>

    <!-- gauge.js -->

    <script src="<?php echo base_url(); ?>assets/gauge.js/dist/gauge.min.js"></script>

    <!-- bootstrap-progressbar -->

    <script src="<?php echo base_url(); ?>assets/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

    <!-- iCheck -->

    <script src="<?php echo base_url(); ?>assets/iCheck/icheck.min.js"></script>

    <!-- Skycons -->

    <script src="<?php echo base_url(); ?>assets/skycons/skycons.js"></script>

    <!-- Flot -->

    <script src="<?php echo base_url(); ?>assets/Flot/jquery.flot.js"></script>

    <script src="<?php echo base_url(); ?>assets/Flot/jquery.flot.pie.js"></script>

    <script src="<?php echo base_url(); ?>assets/Flot/jquery.flot.time.js"></script>

    <script src="<?php echo base_url(); ?>assets/Flot/jquery.flot.stack.js"></script>

    <script src="<?php echo base_url(); ?>assets/Flot/jquery.flot.resize.js"></script>

    <!-- Flot plugins -->

    <script src="<?php echo base_url(); ?>assets/flot.orderbars/js/jquery.flot.orderBars.js"></script>

    <script src="<?php echo base_url(); ?>assets/flot-spline/js/jquery.flot.spline.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/flot.curvedlines/curvedLines.js"></script>

    <!-- DateJS -->

    <script src="<?php echo base_url(); ?>assets/DateJS/build/date.js"></script>

    <!-- JQVMap -->

    <script src="<?php echo base_url(); ?>assets/jqvmap/dist/jquery.vmap.js"></script>

    <script src="<?php echo base_url(); ?>assets/jqvmap/dist/maps/jquery.vmap.world.js"></script>

    <script src="<?php echo base_url(); ?>assets/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>

    <!-- bootstrap-daterangepicker -->

    <script src="<?php echo base_url(); ?>assets/moment/min/moment.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->

    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>

    <!-- Sweatalert -->

    <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>

    <!-- Mask Money -->

    <script src="<?php echo base_url(); ?>assets/js/jquery.maskMoney.min.js"></script>

    <!-- Login JS  -->

    <script src="<?php echo base_url(); ?>assets/js/login.js"></script>

    <!-- SummerNote JS  -->

    <script src="<?php echo base_url(); ?>assets/summernote/summernote.js"></script>
    <script src="<?php echo base_url(); ?>assets/summernote/lang/summernote-tr-TR.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/Sortable.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://unpkg.com/@shopify/draggable"></script>
    
    
    <script type="text/javascript">

            var ilk_mail;
            var silinen_veri = [];
            var silinen_satir_sayisi = []; 
            var kurtarilacak_satir = 0;           

            $(document).ready(function(){

                
                const sortable = new Draggable.Sortable(document.querySelectorAll('.sonuclar tbody'), {
                  draggable: 'tr',
                  handle: '.handle', // Handle seçicisi
                });
                /*const sortable = new Draggable.Sortable(document.querySelectorAll('.sonuclar tbody'), {
                  draggable: 'tr',
                });*/

                $('#kullaniciGuncelleBtn').hide();

                $('#headinfo').summernote({

                    lang: 'tr-TR',

                    height: 500,

                });

                $('#defaultusefulinfo').summernote({

                    lang: 'tr-TR',

                    height: 500,

                });

                $("#headinfobutton").click(function() {

                    var markupStr = $('#headinfo').summernote('code');

                    var dataVars = {

                        headinfo: markupStr,

                    };

                    $.ajax({

                        type: "POST",

                        url: "/sorgula/index.php/Nakliye/headinfo_update",

                        data: dataVars, 

                        success: function(data) {

                            swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                        }

                    });

                    return false;

                });

                $('#fooinfo').summernote({

                    lang: 'tr-TR',

                    height: 500,

                });

                $("#fooinfobutton").click(function() {

                    var markupStr = $('#fooinfo').summernote('code');

                    var dataVars = {

                        fooinfo: markupStr,

                    };

                    $.ajax({

                        type: "POST",

                        url: "/sorgula/index.php/Nakliye/fooinfo_update",

                        data: dataVars, 

                        success: function(data) {

                            swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                        }

                    });

                    return false;

                });

                $("#headandfooinforeset").click(function() {

                    var ctrlheadfooreset1 = 0;

                    var ctrlheadfooreset2 = 0;

                    var headinfo =  '<table class="antet">'+

                                    '<tr>'+

                                    '<td style="width:50%;"><img src="http://www.nakliye.com.tr/wp-content/uploads/2018/03/logo.png" /></td>'+

                                    '<td style="width:50%;padding-left: 10px;"><span style="color: #467080;"><b style="color: #467080;">GEMI ACENTELIGI</b><br>SHIP AGENCY</span><br>Alsancak Mah. Atatürk Caddesi No: 378/31-32 Konak İZMİR 35220<br>Tel: +90 (232) 422 72 03 - 04 Fax: +90 (232) 463 08 30<br>www.nakliye.com.tr<br>e-mail: nakliye@nakliye.com.tr</td>'+

                                    '</tr>'+

                                    '</table>'+

                                    '<div class="hideShow" style="border-bottom: 3px solid #d26a02;width: 100%;margin: 0px auto;margin-top:5px;"></div>'+

                                    '<div class="hideShow" style="border-bottom: 3px solid #467080;width: 90%;margin: 0px auto;margin-top:5px;"></div>';

                    var fooinfo = '<div class="alt_bilgi">OUR BANK AS FOLLOW<br><b>BANK NAME : </div>';

                    var dataVars = {

                        headinfo: headinfo,

                        fooinfo: fooinfo,

                    };

                    $.ajax({

                        type: "POST",

                        url: "/sorgula/index.php/Nakliye/fooinfo_update",

                        data: dataVars, 

                        success: function(data) {

                            //console.log(data);

                        }

                    });

                    $.ajax({

                        type: "POST",

                        url: "/sorgula/index.php/Nakliye/headinfo_update",

                        data: dataVars, 

                        success: function(data) {

                            //console.log(data);

                        }

                    });

                    swal("Değerler başarıyla sıfırlandı.", "Kullanıma hazır! Sayfa yenilenecek.", "success");

                    setTimeout(function(){location.reload()},1250);

                    return false;

                });

                $('#useful_info').summernote({

                    lang: 'tr-TR',                    

                });



                $("#editable_useful_info").click(function() {
                    $("#useful_info").css("display", "none");
                    $(".note-editor").css("display", "block");            
                  $('#useful_info').summernote({focus: true});

                });



                $("#hide_useful_info").click(function() {
                    $("#useful_info").css("display", "none");
                    $(".note-editor").css("display", "none");
                    //$('#useful_info').remove();
                    //$('.note-editor').remove();
                    $(".right_col").css("min-height", "max-content");

                });



                $("#useful_info_reset").click(function() {

                    $.get('/sorgula/assets/useful_info_default.txt', function(data) {

                        $('#useful_info').summernote('code',data);

                    }, 'text');

                });



                $("#view_fatura_yazdir").click(function() {
                    var status_useful_info = $('.note-editor').css('display');
                    if (status_useful_info != "none") {
                        $('#useful_info').summernote('destroy'); 
                    }

                    var title = document.getElementById('printVessel').value+' '+document.getElementById('printCargo').value;

                    var aciklama1 = document.getElementById("aciklama1").value;

                    var aciklama2 = document.getElementById("aciklama2").value;

                    if (aciklama1 == "") {document.getElementById("aciklama1").value = " "}

                    if (aciklama2 == "") {document.getElementById("aciklama2").value = " "}

                    //title = title.replace(/\s/g, '-');

                    document.title = title;

                    window.print();

                });



                $("#alanEkle").click(function(){

                    var rowCount = $('.sonuclar tr').length - 2;

                    rowCount = rowCount + 99;

                    var kirmizi = 'kirmizi'+rowCount;

                    var markup = '<tr><td><input type="text" name="customFiyat'+rowCount+'" class="degerler '+kirmizi+'"></td><td><input type="text" name="customAciklama'+rowCount+'" class="degerlerinIsimleri '+kirmizi+'"></td><td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap('+rowCount+');"><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://www.nakliye.com/sorgula/assets/images/drag.png"></a><a href="javascript:;" id="sil"><img src="http://www.nakliye.com.tr/wp-content/uploads/red-cross.png" class="upDown no-print" width="20" height="20"></a></td></tr>';

                    $(".alt_baslik").closest('tr').before(markup);

                });

            });

           

            $('body').on('click', '#yukari', function() {

                var row = $(this).parents("tr:first");

                row.insertBefore(row.prev());

            });

            $('body').on('click', '#assagi', function() {

                var row = $(this).parents("tr:first");

                row.insertAfter(row.next());

            });

            $('body').on('click', '#sil', function() {

                var row = $(this).parents("tr:first");

                row.remove();

            });

            $(".up,.down").click(function(){

                var row = $(this).parents("tr:first");

                if ($(this).is(".up")) {

                    row.insertBefore(row.prev());

                } else {

                    row.insertAfter(row.next());

                }

            });

            
            $("#silineni_geri_al").click(function(){
                if (silinen_veri.length != 0) {
                    var son_silinen_satir_sayisi = silinen_satir_sayisi[silinen_satir_sayisi.length - 1];
                    var son_silinen_veri = silinen_veri[silinen_veri.length - 1];
                    var markup = '<tr data-satir="'+son_silinen_satir_sayisi+'">'+son_silinen_veri+'</tr>';
                    if (son_silinen_satir_sayisi == 0) {
                        $('table tr[class="ust_baslik"]').closest('tr').after(markup);
                    } else {
                        var aranan_satir = $('table tr[data-satir="'+(son_silinen_satir_sayisi-2)+'"]');
                        $(aranan_satir).closest('tr').after(markup);
                    }                    
                    swal("Kurtarıldı", "Silinen satır geri yüklendi", "success");
                    silinen_veri.pop();
                    silinen_satir_sayisi.pop();
                    kurtarilacak_satir = kurtarilacak_satir - 1;
                    $('#kurtarilacak_satir').text(kurtarilacak_satir);
                } else {
                    swal("İşlem Yok", "Kurtarılacak satır yok","warning");
                }
                
            });

            $('#yenidenHesapla').click(function() {

                var toplam = 0;

                var hesabakatilacaklar = $('.degerler').length;

                for (i=0; i<hesabakatilacaklar; i++) {

                    toplam = toplam + parseInt($('.degerler').eq(i).val());

                }

                $('.toplam').val(toplam);

            });

            $('#veriKaydet').click(function(){

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/sonucKaydet",

                    dataType: "json",

                    data: $("#sonucForm").serialize(), 

                    success: function(data) {

                        //console.log(data);

                        //$("#veriKaydet").hide();

                        //$("#veriGuncelle").show();

                        //$("#dataid").val(data);

                        swal("Değerler başarıyla kaydedildi.", "Yönlendiriliyorsunuz...", "success");

                        setTimeout(function(){$(location).attr('href', '/sorgula/index.php/Nakliye/view_fatura?id='+data)},1250);

                    }

                });

                return false;

            });

            $('#veriGuncelle').click(function(){

                var useful_info_data = $('#useful_info').summernote('code');                

                $("#useful_info_textbox").val(useful_info_data);

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/sonucGuncelle",

                    data: $("#sonucForm").serialize(),

                    success: function(data) {

                        //console.log(data);

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#editDues").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/dues_series_update",

                    data: $("#editDuesForm").serialize(), 

                    success: function(data) {

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#editBulkCargoType").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/bulk_cargo_type_update",

                    data: $("#editBulkCargoTypeForm").serialize(), 

                    success: function(data) {

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#editGarbage").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/garbage_update",

                    data: $("#editGarbageForm").serialize(), 

                    success: function(data) {

                        swal("Garbage değerleri başarıyla güncellendi.", "Kullanıma hazır!", "success");
                        setTimeout(function(){location.reload()},1250);

                    }

                });

                return false;

            });

            $("#editWarfage").click(function() {
                console.log($("#editWarfageForm").serialize());
                $.ajax({
                    type: "POST",
                    url: "/sorgula/index.php/Nakliye/warfage_update",
                    data: $("#editWarfageForm").serialize(),
                    success: function(result) {
                        swal("Warfage değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");
                        setTimeout(function(){location.reload()},1250);
                    }
                });
                return false;

            });

            $("#editNotariel").click(function() {

                var defaultusefulinfo_textbox = $('#defaultusefulinfo').summernote('code');

                $("#defaultusefulinfo_textbox").val(defaultusefulinfo_textbox);

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/update_notariel",

                    data: $("#notarielForm").serialize(), 

                    success: function(data) {

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#editTrfreight").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/tr_freight_chamber_update",

                    data: $("#editTrfreightForm").serialize(), 

                    success: function(data) {

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#editforeignfreight").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/foreign_freight_chamber_update",

                    data: $("#editforeignfreightForm").serialize(), 

                    success: function(data) {

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#editforeignpass").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/foreign_pass_update",

                    data: $("#editforeignpassForm").serialize(), 

                    success: function(data) {

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#editAssosiation").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/assosiation_update",

                    data: $("#editAssosiationForm").serialize(), 

                    success: function(data) {

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#editimpCovertime").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/impcovertime_update",

                    data: $("#editimpCovertimeForm").serialize(), 

                    success: function(data) {

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#editexpCovertime").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/expcovertime_update",

                    data: $("#editexpCovertimeForm").serialize(), 

                    success: function(data) {

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#editAgency").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/agency_update",

                    data: $("#editAgencyForm").serialize(), 

                    success: function(data) {

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#login-button").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/giris_yap",

                    data: $("#login-form").serialize(),

                    success: function(data) {

                        //console.log(data);

                        if (data == "true") {

                            swal("Giriş başarıyla yapıldı.", "Yönlendiriliyorsunuz!", "success");

                            $(location).attr('href', '/sorgula/')

                        } else {

                            swal("Kullanıcı bilgileriniz hatalı.", "Tekrar deneyin!", "error");

                        }

                    }

                });

                return false;

            });

            $("#kullaniciOlusturBtn").click(function() {

                var user_pw1 = $("#user_pw1").val();

                var user_pw2 = $("#user_pw2").val();

                var user_mail = $("#user_email").val();

                var mail_bos = "";

                if (user_pw1 == user_pw2) {

                    $.ajax({

                        type: "POST",

                        url: "/sorgula/index.php/Nakliye/mail_kontrol",

                        data: {email : user_mail}, 

                        success: function(data) {

                            if (data == 0) {

                                $.ajax({

                                    type: "POST",

                                    url: "/sorgula/index.php/Nakliye/create_users",

                                    data: $("#create_usersForm").serialize(), 

                                    success: function(data) {

                                        swal("Kullanıcı başarıyla oluşturuldu.", "Kullanıma hazır! Sayfa yenilenecek.", "success");

                                        setTimeout(function(){location.reload()},1250);

                                    }

                                });

                            } else {

                                swal("Bu eposta adresi zaten kayıtlı.", "Kontrol ediniz.", "warning");

                            }

                        }

                    });                    

                } else {

                    swal("Parolalar uyuşmuyor.", "Kontrol ediniz.", "warning");

                }

                return false;

            });

            $('body').on('click', '#kullanici_sil', function() {

                swal({

                    title: "Emin misiniz?",

                    text: "İlgili kullanıcı silinecek ve geri dönüşü yoktur!",

                    icon: "warning",

                    buttons: true,

                    dangerMode: true,

                })

                .then((willDelete) => {

                    if (willDelete) {

                        var elem = $(this).attr('data-id');

                        $.ajax({

                            type: "POST",

                            url: "/sorgula/index.php/Nakliye/delete_users",

                            data: {id : elem},

                            success: function(data) {

                                swal("Kullanıcı başarıyla silindi.", "Kullanıma hazır! Sayfa yenilenecek.", "success");

                                setTimeout(function(){location.reload()},1250);

                            }

                        });

                    } else {

                        swal("Kullanıcı silinmedi! Korunuyor.");

                    }

                });

                return false;

            });

            $('body').on('click', '#kullanici_duzenle', function() {

                var elem = $(this).attr('data-id');

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/get_single_user",

                    data: {id : elem},

                    dataType: "json",

                    success: function(data) {

                        $('#user_id').val(data.id);

                        $('#user_name').val(data.name);

                        $('#user_email').val(data.email);

                        $('#user_role').val(data.role);

                        $('#kullaniciOlusturBtn').hide();

                        $('#kullaniciGuncelleBtn').show();

                        //console.log(data);

                        ilk_mail = data.email;

                    }

                });                

                return false;

            });

            $("#kullaniciGuncelleBtn").click(function() {

                var user_pw1 = $("#user_pw1").val();

                var user_pw2 = $("#user_pw2").val();

                var user_mail = $("#user_email").val();

                var mail_bos = "";

                if (user_pw1 == user_pw2) {

                    if (ilk_mail != user_mail) {

                       $.ajax({

                            type: "POST",

                            url: "/sorgula/index.php/Nakliye/mail_kontrol",

                            data: {email : user_mail}, 

                            success: function(data) {

                                if (data == 0) {

                                    $.ajax({

                                        type: "POST",

                                        url: "/sorgula/index.php/Nakliye/update_users",

                                        data: $("#create_usersForm").serialize(), 

                                        success: function(data) {

                                            swal("Kullanıcı başarıyla güncellendi.", "Kullanıma hazır! Sayfa yenilenecek.", "success");

                                            setTimeout(function(){location.reload()},1250);

                                        }

                                    });

                                } else {

                                    swal("Bu eposta adresi zaten kayıtlı.", "Kontrol ediniz.", "warning");

                                }

                            }

                        }); 

                   } else {

                        $.ajax({

                            type: "POST",

                            url: "/sorgula/index.php/Nakliye/update_users",

                            data: $("#create_usersForm").serialize(), 

                            success: function(data) {

                                swal("Kullanıcı başarıyla güncellendi.", "Kullanıma hazır! Sayfa yenilenecek.", "success");

                                setTimeout(function(){location.reload()},1250);

                            }

                       });

                   }

                    

                } else {

                    swal("Parolalar uyuşmuyor.", "Kontrol ediniz.", "warning");

                }

                return false;

            });

            $("#editaliagatarife").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/update_aliagatarife",

                    data: $("#aliagatarifeForm").serialize(), 

                    success: function(data) {

                        console.log(data);

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#editizmirtarife").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/update_izmirtarife",

                    data: $("#izmirtarifeForm").serialize(), 

                    success: function(data) {

                        console.log(data);

                        swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");

                    }

                });

                return false;

            });

            $("#editGtf_series").click(function() {

                $.ajax({

                    type: "POST",

                    url: "/sorgula/index.php/Nakliye/gtf_series_update",

                    data: $("#editGtf_seriesForm").serialize(), 

                    success: function(data) {
                        if (data == "true") {
                         swal("Değerler başarıyla güncellendi.", "Kullanıma hazır!", "success");
                        } else {
                        swal("Değerler başarıyla güncellenmedi.", "Kontrol ediniz!", "danger");
                        }

                    }

                });

                return false;

            });

            $('body').on('click', '#fatura_sil', function() {

                swal({

                    title: "Emin misiniz?",

                    text: "İlgili fatura silinecek ve geri dönüşü yoktur!",

                    icon: "warning",

                    buttons: true,

                    dangerMode: true,

                })

                .then((willDelete) => {

                    if (willDelete) {

                        var elem = $(this).attr('data-id');

                        $.ajax({

                            type: "POST",

                            url: "/sorgula/index.php/Nakliye/delete_fatura",

                            data: {id : elem},

                            success: function(data) {
                                console.log(data);

                                swal("Fatura başarıyla silindi.", "Kullanıma hazır! Sayfa yenilenecek.", "success");

                                //setTimeout(function(){location.reload()},1250);

                            }

                        });

                    } else {

                        swal("Fatura silinmedi! Korunuyor.");

                    }

                });

                return false;

            });

            jQuery(document).bind("keyup keydown", function(e){

                if(e.ctrlKey && e.keyCode == 80){

                    $('#useful_info').summernote('destroy'); 

                    var title = document.getElementById('printVessel').value+' '+document.getElementById('printCargo').value;

                    var aciklama1 = document.getElementById("aciklama1").value;

                    var aciklama2 = document.getElementById("aciklama2").value;

                    if (aciklama1 == "") {document.getElementById("aciklama1").value = " "}

                    if (aciklama2 == "") {document.getElementById("aciklama2").value = " "}

                    //title = title.replace(/\s/g, '-');

                    document.title = title;

                }

            });

            $('body').on('click', '.delRow', function() {
                var row = $(this).parents("tr:first");
                silinen_satir_sayisi.push($(this).parents("tr:first").attr("data-satir"));
                silinen_veri.push(row.html());
                row.remove();
                kurtarilacak_satir = kurtarilacak_satir + 1;
                $('#kurtarilacak_satir').text(kurtarilacak_satir);
            });

            $('body').on('click', '#toplu_fatura_sil', function() {

                var selected_fatura = [];

                swal({

                    title: "Emin misiniz?",

                    text: "Seçilen faturalar silinecek ve geri dönüşü yoktur!",

                    icon: "warning",

                    buttons: true,

                    dangerMode: true,

                })

                .then((willDelete) => {

                    if (willDelete) {

                        $('.fatura_select').each(function() {

                           if ($(this).is(":checked")) {

                               selected_fatura.push($(this).attr('value'));

                           }

                        });

                        $.ajax({

                            type: "POST",

                            url: "/sorgula/index.php/Nakliye/delete_fatura",

                            data: {id : selected_fatura},

                            success: function(data) {

                                console.log(data);

                                swal("Faturalar başarıyla silindi.", "Kullanıma hazır! Sayfa yenilenecek.", "success");

                                //setTimeout(function(){location.reload()},1250);

                            }

                        });

                    } else {

                        swal("Faturalar silinmedi! Korunuyor.");

                    }

                });

                return false;

                

                

            });

    </script>

</body>

</html>