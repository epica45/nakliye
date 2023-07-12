<!-- page content -->
<div class="right_col" role="main">
<button class="btn btn-primary no-print" id="veriKaydet">Kaydet</button>
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
    input:read-only {
        background-color: #E3E3E3;
        color: #888;
        cursor: not-allowed;
    }
    @media print {
        *{font-family: 'Times New Roman';font-size: 10px;}
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
    }
</style>
<?php
    $attributes = array('method'=>'post','name'=>'hesapla_form','id'=>'sonucForm');
        echo form_open('Nakliye/sonucKaydet', $attributes);
   ?>
   <input type="hidden" name="id" id="dataid">
   <input type="hidden" name="duration" value="<?php echo $duration; ?>">
   <input type="hidden" name="cargoton" value="<?php echo $cargo; ?>">
   <input type="hidden" name="cargotype" value="<?php echo $cargotype; ?>">
   <input type="hidden" name="supervisioneuro" value="<?php echo $supervisioneuro; ?>">
   <input type="hidden" name="agencyeuro" value="<?php echo $agencyeuro; ?>">
   <input type="hidden" name="agencyovertimeeuro" value="<?php echo $agencyovertime; ?>">
   <input type="hidden" name="port" value="<?php echo $port; ?>">
   <input type="hidden" name="expImp" value="<?php echo $expImp; ?>">
   <?php echo $headinfo; ?>
    <br>
    <div class="no-print"><span>Ekleyen : </span><input type="text" name="ekleyen" value="<?php echo $user_name; ?>" readonly></div>
    <br>
    <div class="tarih"><span class="no-print">Tarih : </span><input type="text" name="tarih" value="<?php echo date('d.m.Y'); ?>"></div>
    <br>
    <table class="bilgiler">
        <tr>
            <td>VESSEL NAME</td>
            <td><input type="text" name="vesselname" id="printVessel" value="<?php echo $vesselname; ?>"></td>
        </tr>
        <tr>
            <td>FLAG</td>
            <td><input type="text" name="flagname" value="<?php echo $flagname." - ".$flagtype; ?>"></td>
        </tr>
        <tr>
            <td>NRT</td>
            <td><input type="text" name="nrt" value="<?php echo $nrt; ?>"></td>
        </tr>
        <tr>
            <td>GRT</td>
            <td><input type="text" name="grt" value="<?php echo $grt; ?>"></td>
        </tr>
        <tr>
            <td>CARGO</td>
            <td><input type="text" name="cargo" id="printCargo" value="<?php echo $cargo.' MT '.$cargotype.' '.$cargoText.' AT '.$port.' PORT'; ?>"></td>
        </tr>
    </table>
   <br>
    <table class="sonuclar">
        <tr class="ust_baslik">
            <td class="right">USD</td>
            <td class="left">EXPLAINATION</td>
            <td></td>
        </tr>
        <tr>
            <td><input type="text" name="portdues" class="degerler kirmizi1" value="<?php echo $portdues; ?>"></td>
            <td><input type="text" name="portdues_2" class="degerlerinIsimleri kirmizi1" value="PORT DUES"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(1);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="sanitarydues" class="degerler kirmizi2" value="<?php echo $sanitarydues; ?>"></td>
            <td><input type="text" name="sanitarydues_2" class="degerlerinIsimleri kirmizi2" value="SANITARY DUES"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(2);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="lightdues" class="degerler kirmizi3" value="<?php echo $lightdues; ?>"></td>
            <td><input type="text" name="lightdues_2" class="degerlerinIsimleri kirmizi3" value="LIGHT DUES"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(3);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="gtf_fee" class="degerler kirmizi86" value="<?php echo $gtf_fee; ?>"></td>
            <td><input type="text" name="gtf_fee_2" class="degerlerinIsimleri kirmizi86" value="VESSEL TRAFFIC SYSTEM FEE IN&OUT"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(86);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="pilotaj" class="degerler kirmizi4" value="<?php echo $pilotaj; ?>"></td>
            <td><input type="text" name="pilotaj_2" class="degerlerinIsimleri kirmizi4" value="PILOTAGE IN / OUT"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(4);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="tugboat" class="degerler kirmizi5" value="<?php echo $tugboat; ?>"></td>
            <td><input type="text" name="tugboat_2" class="degerlerinIsimleri kirmizi5" value="TUGBOATS IN / OUT"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(5);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <?php if($port == "IZMIR"){ ?>
        <tr>
            <td><input type="text" name="tugovertime" class="degerler kirmizi98 red" value="<?php echo $tugovertime; ?>"></td>
            <td><input type="text" name="tugovertime_2" class="degerlerinIsimleri kirmizi98 red" value="PILOTAGE AND TUGS OVERTIME (1)INCASE (BERTH & UNBERTH)"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(98);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <?php } ?>
        <tr>
            <td><input type="text" name="mooring" class="degerler kirmizi6" value="<?php echo $mooring; ?>"></td>
            <td><input type="text" name="mooring_2" class="degerlerinIsimleri kirmizi6" value="MOORING"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(6);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="warfage" class="degerler kirmizi96" value="<?php echo $warfage; ?>"></td>
            <td><input type="text" name="warfage_2" class="degerlerinIsimleri kirmizi96" value="QUAY FEES FOR <?php echo $duration; ?> DAYS"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(96);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="garbage" class="degerler kirmizi7" value="<?php echo $garbage; ?>"></td>
            <td><input type="text" name="garbage_2" class="degerlerinIsimleri kirmizi7" value="GARBAGE"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(7);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="notarial" class="degerler kirmizi8" value="<?php echo $notarialFees; ?>"></td>
            <td><input type="text" name="notarial_2" class="degerlerinIsimleri kirmizi8" value="NOTARIAL FEES"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(8);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>  
        <tr>
            <td><input type="text" name="custom_overtime" class="degerler kirmizi9" value="<?php echo $custom_overtime; ?>"></td>
            <td><input type="text" name="custom_overtime_2" class="degerlerinIsimleri kirmizi9" value="CUSTOM OVERTIME"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(9);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <?php if($port == "ALIAGA"): ?>
        <tr>
            <td><input type="text" name="immigration" class="degerler kirmizi89" value="<?php echo $immigration; ?>"></td>
            <td><input type="text" name="immigration_2" class="degerlerinIsimleri kirmizi89" value="IMMIGRATION FEES"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(89);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td><input type="text" name="chamber" class="degerler kirmizi10" value="<?php echo $chamber; ?>"></td>
            <td><input type="text" name="chamber_2" class="degerlerinIsimleri kirmizi10" value="CHAMBER OF SHIPPING FEES"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(10);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="assosiation" class="degerler kirmizi11" value="<?php echo $assosiation; ?>"></td>
            <td><input type="text" name="assosiation_2" class="degerlerinIsimleri kirmizi11" value="ASSOSIATION FEES IN CONCERNING FREIGHT FOR <?php echo $cargo; ?> MT"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(11);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <?php if($port == "ALIAGA"): ?>
        <tr>
            <td><input type="text" name="motorlunch" class="degerler kirmizi88" value="<?php echo $motorlunch; ?>"></td>
            <td><input type="text" name="motorlunch_2" class="degerlerinIsimleri kirmizi88" value="MOTORLUNCH ON ARRIVAL CONTROLS"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(88);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td><input type="text" name="petties" class="degerler kirmizi94" value="<?php echo $petties; ?>"></td>
            <td><input type="text" name="petties_2"  class="degerlerinIsimleri kirmizi94" value="PETTIES AND FORMALITIES"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(94);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="taxihire" class="degerler kirmizi93" value="<?php echo $taxihire; ?>"></td>
            <td><input type="text" name="taxihire_2" class="degerlerinIsimleri kirmizi93" value="TAXIHIRE FOR SHIP'S FORMALITES ARRIVAL / DEPARTURE"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyapi(93);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="phonecalls" class="degerler kirmizi92" value="<?php echo $phone_calls; ?>"></td>
            <td><input type="text" name="phonecalls_2" class="degerlerinIsimleri kirmizi92" value="PHONE CALLS AND FISCALS"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(92);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="fotocopies" class="degerler kirmizi91" value="<?php echo $fotocopies; ?>"></td>
            <td><input type="text" name="fotocopies_2" class="degerlerinIsimleri kirmizi91" value="FOTOCOPIES AND MISCENCELLUS"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(91);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <?php if ($port == "ALIAGA"): ?>
        <tr>
            <td><input type="text" name="anchorage" class="degerler kirmizi87" value="<?php echo $anchorage; ?>"></td>
            <td><input type="text" name="anchorage_2" class="degerlerinIsimleri kirmizi87" value="ANCHORAGE FEES IF VESSEL STAY AT ANCHORAGE MORE THAN 3 DAY"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(87);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td><input type="text" name="supervision" class="degerler kirmizi95" value="<?php echo $supervision; ?>"></td>
            <td><input type="text" name="supervision_2" class="degerlerinIsimleri kirmizi95" value="SUPERVISING FEES A/P TARIF FOR <?php echo $cargo; ?> MT <?php echo $cargotype ?> ( <?php echo $supervisioneuro;?>.-EURO) "></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(95);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <tr>
            <td><input type="text" name="agency" class="degerler kirmizi97" value="<?php echo $agency; ?>"></td>
            <td><input type="text" name="agency_2" class="degerlerinIsimleri kirmizi97" value="AGENCY FEES AS PER TARIFF UPTO 5 DAYS AT PORT ( <?php echo $agencyeuro;?>.-EURO )"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(97);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <?php 
        if ($agencyovertime != 0):
        ?>
        <tr>
            <td><input type="text" name="agencyovertime" class="degerler kirmizi90" value="<?php echo $agencyovertimedolar; ?>"></td>
            <td><input type="text" name="agencyovertime_2" class="degerlerinIsimleri kirmizi90" value="AGENCY FEES AS PER TARIFF OVER <?php echo $agencyovertimeText; ?> AT PORT ( <?php echo $agencyovertime;?>.-EURO )"></td>
            <td><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(90);"></td>
            <td><a href="javascript:;" class="handle no-print"><img width="20" class="upDown" height="20" src="https://mesutersoy.com/nakliye/drag.png"></a><a href="javascript:;" class="delRow"><img src="https://mesutersoy.com/nakliye/red-cross.png" class="upDown no-print" width="20" height="20"></a></td>
        </tr>
        <?php
        endif;
        ?>
        <tr class="alt_baslik">
            <td class="right"><input type="text" name="total" class="toplam" value="<?php echo $total; ?>"></td>
            <?php if ($expImp == "Export"){ ?>
            <td class="left">TOTAL D/A <input type="text" name="totalPlus" class="kirmizi99 red" value="+ Freight Tax"><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(99);"></td>
            <?php } else { ?>
            <td class="left">TOTAL D/A <input type="text" name="totalPlus" class="kirmizi99"><input type="button" class="no-print" value="Kırmızı Yap" onclick="kirmiziyap(99);"></td>
            <?php } ?>
            <td></td>
        </tr>
    </table>
    <br>
    <?php if ($port == "ALIAGA") { ?>
        <textarea name="aciklama1" id="aciklama1" style="width: 650px; height: 55px;" class="red" placeholder="Kırmızı açıklamaları buraya giriniz"></textarea>
        <br>
        <textarea name="aciklama2" id="aciklama2" style="width: 650px; height: 150px;" placeholder="Normal açıklamaları buraya giriniz"></textarea>
    <?php } else { ?>
        <textarea name="aciklama1" id="aciklama1" style="width: 650px; height: 55px;" class="red" placeholder="Kırmızı açıklamaları buraya giriniz">1) PILOTAGE AND TUGS OVERTIME WILL CHARGE IF VSL BERTH OR UNBERTH ON SUNDAY AND HOLIDAY FOR BERTH AND UNBERTH OPERATION <?php echo $tugovertime; ?>.-USD.</textarea>
    <br>
    <textarea name="aciklama2" id="aciklama2" style="width: 650px; height: 150px;" placeholder="Normal açıklamaları buraya giriniz">2)IF VESSEL STAY AT ANCHORAGE MORE THAN 3 DAYS <?php echo $anchorage; ?>.-USD. ANCHORAGE FEES WILL  CHARGE
3)IF VESSEL STAY AT ANCHORAGE MORE THAN 24 HRS. FOR CUSTOM CLEARANCE MOTORLUNCH WILL BE USE WHICH COST IS 250.-USD.
4) ENTERENCE OF IZMIR BAY THERE IS A CHANNEL CALLING YENIKALE PELIKAN BANK THERE IS A PILOT STATION BUT THIS PILOT IS NOT COMPUSORY AND NOT CHARGED IF MASTER USE COST WILL CHARGE SAME
</textarea>
    <?php } ?>  
<?php echo form_close(); ?>  
<?php echo $fooinfo; ?>
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