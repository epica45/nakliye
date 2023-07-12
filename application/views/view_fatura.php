<!-- page content -->
<div class="right_col" role="main">
<?php /*<label class="alert alert-danger no-print">Test çalışmasında olduğumuz için lütfen değerleri kontrol ederek çıktı alınız.</label>*/ ?>
<button class="btn btn-primary no-print" id="view_fatura_yazdir">Yazdır</button>
<button class="btn btn-primary no-print" id="alanEkle">Alan Ekle</button>
<button class="btn btn-primary no-print" id="veriGuncelle">Güncelle</button>
<button class="btn btn-primary no-print" id="yenidenHesapla">Toplam Hesapla</button>
<button class="btn btn-primary no-print" id="silineni_geri_al">Silineni Geri Al(<span id="kurtarilacak_satir">0</span>)</button>
<?php if($data[0]->port == "IZMIR") { ?>
<button class="btn btn-primary no-print hide" id="useful_info_reset">Useful Info Sıfırla</button>
<button class="btn btn-primary no-print" id="editable_useful_info">Useful Info Düzenle</button>
<button class="btn btn-primary no-print" id="hide_useful_info">Useful Info Kaldır</button>
<?php } ?>
<style type="text/css">
    .degerler, .toplam{text-align: right;}
    .ust_baslik {border-bottom:2px solid #000;}
    .ust_baslik > .left, .alt_baslik > .left {padding-left: 10px;}
    .alt_baslik {border-top:2px solid #000;border-bottom:2px solid #000;}
    .right{text-align: right;}
    .left{text-align: left;}
    .bilgiler tr td {padding: 0px 10px;}
    .padding{padding-left:10px;}
    .degerlerinIsimleri{text-align: left;width:500px;margin-left: 10px;}
    .alt_bilgi{position: absolute;bottom: 0;}
    .antet, .alt_bilgi, .hideShow{display: none;}
    .red{color:#ff0000!important;-webkit-print-color-adjust: exact;}
    .bilgiler input[type=text]{width: 600px;height: 19px;}
    #useful_info {page-break-before: always;}
    input:read-only {
        background-color: #E3E3E3;
        color: #888;
        cursor: not-allowed;
    }
    @media print {
        *{font-family: 'Times New Roman';font-size: 12px;}
        .no-print, .no-print * {display: none !important;}
        input[type=text]{border:none;height: 20px;}
        textarea{border:none;resize: none;overflow: hidden;}
        .antet, .alt_bilgi, .hideShow{display: block;}
        .red{color:#ff0000!important;-webkit-print-color-adjust: exact;}
        .tarih{position: absolute;right: 0;}
        input:read-only {
            background-color: unset;
            color: unset;
            cursor: not-allowed;
        }
        #useful_info {page-break-before: always;}
    }
</style>
<?php
    $attributes = array('method'=>'post','name'=>'hesapla_form','id'=>'sonucForm');
        echo form_open('Nakliye/sonucGuncelle', $attributes);
   ?>
   <input type="hidden" name="id" value="<?php echo $data[0]->id; ?>">
   <input type="hidden" name="duration" value="<?php echo $data[0]->duration; ?>">
   <input type="hidden" name="cargoton" value="<?php echo $data[0]->cargoton; ?>">
   <input type="hidden" name="cargotype" value="<?php echo $data[0]->cargotype; ?>">
   <input type="hidden" name="supervisioneuro" value="<?php echo $data[0]->supervisioneuro; ?>">
   <input type="hidden" name="agencyeuro" value="<?php echo $data[0]->agencyeuro; ?>">
   <input type="hidden" name="agencyovertimeeuro" value="<?php echo $data[0]->agencyovertimeeuro; ?>">
   <input type="hidden" name="port" value="<?php echo $data[0]->port; ?>">
   <input type="hidden" name="useful_info" id="useful_info_textbox">
   <?php echo $headinfo; ?>
    <br>
    <div class="no-print"><span>Güncelleyen : </span><input type="text" name="guncelleyen" value="<?php echo $data["user_name"]; ?>" readonly></div>
    <br>
    <div class="tarih"><span class="no-print">Tarih : </span><input type="text" name="tarih" value="<?php echo $data[0]->tarih; ?>"></div><br>
    <table class="bilgiler">
        <tr>
            <td>VESSEL NAME</td>
            <td><input type="text" name="vesselname" id="printVessel" value="<?php echo $data[0]->vesselname; ?>"></td>
        </tr>
        <tr>
            <td>FLAG</td>
            <td><input type="text" name="flagname" value="<?php echo $data[0]->flagname; ?>"></td>
        </tr>
        <tr>
            <td>NRT</td>
            <td><input type="text" name="nrt" value="<?php echo $data[0]->nrt; ?>"></td>
        </tr>
        <tr>
            <td>GRT</td>
            <td><input type="text" name="grt" value="<?php echo $data[0]->grt; ?>"></td>
        </tr>
        <tr>
            <td>CARGO</td>
            <td><input type="text" name="cargo" id="printCargo" value="<?php echo $data[0]->cargo; ?>"></td>
        </tr>
    </table>
   <br>
    <table class="sonuclar">
        <tr class="ust_baslik">
            <td class="right">USD</td>
            <td class="left">EXPLAINATION</td>
            <td></td>
        </tr>
        
        <?php
        $adimlar = json_decode($data[0]->jsondata, true);
        $say = count($adimlar);
        $keys = array_keys($adimlar);
        //print_r($adimlar);
        for ($i=0; $i < $say; $i++) {
            if($keys[$i] == "tugovertime" || $keys[$i] == "tugovertime_2"){$red = "red";}
            
            echo '
            <tr data-satir="'.$i.'">
            <td><input type="text" name="'.$keys[$i].'" class="degerler kirmizi'.$i.' '.@$red.'" value="'.$adimlar[$keys[$i]].'"></td>';
            $i = $i + 1;
            echo'
            <td><input type="text" name="'.$keys[$i].'" class="degerlerinIsimleri kirmizi'.($i-1).' '.@$red.'" value="'.$adimlar[$keys[$i]].'"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap('.($i-1).');"><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a>
                <a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></a></td>
            </tr>
            ';
            $red = "";
        }
        ?>


        <?php /*if (isset($data[0]->customFiyat)):
            $customFiyat = json_decode($data[0]->customFiyat);
            $customAciklama = json_decode($data[0]->customAciklama);
            for ($i=0; $i < count($customFiyat); $i++) {
                $rand = rand(100, 200);
                ?>
            <tr>
                <td><input type="text" name="customFiyat[]" class="degerler kirmizi<?php echo $rand; ?>" value="<?php echo $customFiyat[$i]; ?>"></td>
                <td><input type="text" name="customAciklama[]" class="degerlerinIsimleri kirmizi<?php echo $rand; ?>" value="<?php echo $customAciklama[$i]; ?>"></td>
                <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(<?php echo $rand; ?>);"></td>
                <td><a href="javascript:;" class="up"><img src="http://www.nakliye.com.tr/wp-content/uploads/up-arrow.png" class="upDown no-print" width="20" height="20"></a><a href="javascript:;" class="down no-print"><img width="20" class="upDown" height="20" src="http://www.nakliye.com.tr/wp-content/uploads/down-arrow.png"></a></td>
                <td><a href="javascript:;" class="delRow"><img src="http://www.nakliye.com.tr/wp-content/uploads/red-cross.png" class="upDown no-print" width="20" height="20"></a></a></td>
            </tr>
                <?php
            }
        endif; */?>
        <tr class="alt_baslik">
            <td class="right"><input type="text" name="total" class="toplam" value="<?php echo $data[0]->total; ?>"></td>
            <?php if ($data[0]->expImp == "Export"){ ?>
            <td class="left">TOTAL D/A <input type="text" name="totalPlus" class="kirmizi99 red" value="<?php echo $data[0]->totalPlus; ?>"><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(99);"></td>
            <?php } else { ?>
            <td class="left">TOTAL D/A <input type="text" name="totalPlus" class="kirmizi99" value="<?php echo $data[0]->totalPlus; ?>"><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(99);"></td>
            <?php } ?>
            <td></td>
        </tr>
    </table>
    <br>
    <textarea name="aciklama1" id="aciklama1" style="width: 650px; height: 55px;" class="red" placeholder="Kırmızı açıklamaları buraya giriniz"><?php echo $data[0]->aciklama1; ?></textarea>
    <br>
    <textarea name="aciklama2" id="aciklama2" style="width: 650px; height: 150px;" placeholder="Normal açıklamaları buraya giriniz"><?php echo $data[0]->aciklama2; ?></textarea>
    <?php echo form_close(); ?>
    <?php echo $fooinfo; ?>
    <?php /*<div class="alt_bilgi"></div>*/ ?>
    <br>
    <?php if($data[0]->port == "IZMIR") { ?>
   
    <br>
    <?php } ?>
</div>
<!-- /page content -->

<script type="text/javascript">

    function kirmiziyap(hangisi) {
        element = document.getElementsByClassName("kirmizi"+hangisi)[0];
        element2 = document.getElementsByClassName("kirmizi"+hangisi)[1];
        var sinif = element.className;
        var varmi = sinif.search("red");
        if (varmi > 0) {element.classList.remove("red");element2.classList.remove("red");}else{element.classList.add("red");element2.classList.add("red");}
        return true;
    }
    function yazdir() {
        var title = document.getElementById('printVessel').value+' '+document.getElementById('printCargo').value;
        var aciklama1 = document.getElementById("aciklama1").value;
        var aciklama2 = document.getElementById("aciklama2").value;
        if (aciklama1 == "") {document.getElementById("aciklama1").value = " "}
        if (aciklama2 == "") {document.getElementById("aciklama2").value = " "}
        //title = title.replace(/\s/g, '-');
        document.title = title;
        window.print();
    }
</script>