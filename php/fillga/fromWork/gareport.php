<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<?php
require_once "config.php";
?>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>
	Google Adwords Reklam Kontrol Paneli
</title>
    <script src="gareport_files/jquery-1_002.js" type="text/javascript"></script>
    <link href="gareport_files/basic.css" rel="stylesheet" type="text/css"><link href="gareport_files/gg_fb.css" rel="stylesheet" type="text/css">
    <script src="gareport_files/jquery-1.js" type="text/javascript"></script>
    <script src="gareport_files/dropdowntabs.js" type="text/javascript"></script>
    <script src="gareport_files/jquery-ui-1.js" type="text/javascript"></script>
    <script src="gareport_files/jquery.js" type="text/javascript"></script>
    <link href="gareport_files/main.css" rel="stylesheet" type="text/css"><link href="gareport_files/ddcolortabs.css" rel="stylesheet" type="text/css">
    <script src="gareport_files/jquery_003.js" type="text/javascript"></script>
    <script src="gareport_files/jquery_002.js" type="text/javascript"></script>
    <link href="gareport_files/jquery-ui-1.css" rel="stylesheet" type="text/css">
    <script src="gareport_files/NumericControl.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            renkDuzenle("Red", "redicon.jpg");
            renkDuzenle("Yellow", "yellowicon.png");
        });
        function renkDuzenle(Renk, iconAdi) {
            if ($("." + Renk) != null) {
                var yellows = $("." + Renk).length;
                for (var i = 0; i < yellows; i++) {
                    $("." + Renk + "Resim")[i].src = "App_Themes/Default/images/" + iconAdi;
                }
            }
        }
    </script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#ctl00_ContentPlaceHolder1_ddlSecim').change(function () {
                if ($('#ctl00_ContentPlaceHolder1_ddlSecim').val() == "OA") {
                    $('#divTarihAraligi').slideDown();
                }
                else {
                    $('#divTarihAraligi').slideUp();
                }
            });

            $('.abc').datepicker();
            var dateFormat = $(".abc").datepicker("option", "dateFormat");
            $(".abc").datepicker("option", "dateFormat", 'dd.mm.yy');
            $(".abc").datepicker("option", $.datepicker.regional["tr"]);
            $(".abc").datepicker($.datepicker.regional['fr']);
        });
    </script>
    <script src="gareport_files/easyTooltip.js" type="text/javascript"></script>
    <script src="gareport_files/amcharts.js" type="text/javascript"></script>
    <script src="gareport_files/Graphic.js" type="text/javascript"></script>
    <script src="gareport_files/raphael.js" type="text/javascript"></script>
    <link href="gareport_files/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        function PuanYaz(a, p) {
            $("#pAk")[0].innerHTML = a;
            $("#pKp")[0].innerHTML = p + "/10";
            if (p == -1) {
                $("#pKp")[0].innerHTML = "Alaka Düzeyi Geçersiz";
                $("#divKalitePuan").css("background-image", "none");
                $("#divKalitePuan").css("width", "100%");
                $("#pKp").css("color", "Red");
            }
            else if (p < 5) {
                $("#divKalitePuan").css("background-image", "url('App_Themes/Default/images/kalitePuani.gif')");
                $("#pKp").css("color", "Red");
            } else {
                $("#divKalitePuan").css("background-image", "url('App_Themes/Default/images/kalitePuaniYesil.gif')");
                $("#pKp").css("color", "Green");
            }
        }
    </script>
</head>
<body style="margin-bottom: 0px; cursor: auto;">
    <form name="aspnetForm" method="post" action="KeywordsPage.aspx" id="aspnetForm">
<div>
</div>
<script type="text/javascript" src="gareport_files/common.asc"></script><script type="text/javascript" src="gareport_files/adwordspanel.asc"></script>
<script type="text/javascript">
//<![CDATA[
lineChartData =[{ date: new Date(2013, 04, 02), value: 0 }];//]]>
</script>

<div>

</div>
    <div id="header" style="height: 50px; padding: 5px 10px 5px 10px;">
        <div style="float: left">
            <img src="gareport_files/adwords_logo.jpg">
        </div>
        <div id="loading" style="display: none; width: 75%; height: 51px; float: left; text-align: center">
            <img style="" src="gareport_files/loading.gif" width="40px"><strong style="vertical-align: middle"> Yükleniyor...</strong>
        </div>
        <div style="float: right; height: 40px; padding-top: 5px; line-height: 20px;">
            <strong id="ctl00_stMailAdresi">oxfordstreetdilokulu.com Filiz Deniz</strong>|<a id="ctl00_btnCikis" href="javascript:__doPostBack('ctl00$btnCikis','')">Çıkış</a>
            <br>
            <strong id="ctl00_stEmail" style="display: none">1256106053</strong>
        </div>
    </div>
    <div id="menu" style="background-color: #008844; height: 28px; padding-top: 7px;
        padding-left: 10px;">
        <div>
            <div id="colortab" class="ddcolortabs" style="float: left; width: 50%">
                <ul>
                    <li id="ctl00_lianasayfa"><a href="http://www.destexreklampanel.com/Default.aspx" title="Ana Sayfa"><span>Ana
                        Sayfa</span></a></li>
                    <li id="ctl00_likampanyalar"><a href="http://www.destexreklampanel.com/Kampanyalar.aspx" title="Raporlar/Değişiklikle">
                        <span>Raporlar/Değişiklikler</span></a></li>
                    <li class="" id="ctl00_liodemeler"><a href="#" title="Bütçe Ödeme" rel="dropmenu_odeme">
                        <span>Bütçe/Ödeme</span></a></li>
                    <li class=" selected default" id="ctl00_liyardim"><a href="#" title="Destek/Yardım" rel="dropmenu_destek">
                        <span>Destek/Yardım</span></a></li>
                    
                    
                </ul>
            </div>
            <div id="ctl00_divBakiye" style="float: right; color: White; margin-right: 5px;
                padding-top: 2px;">
                Bugün Harcanan :<strong><span id="ctl00_stHarcananTutar">0 TL</span></strong>
                | Kalan Bütçe :<strong><span id="ctl00_stBakiye">-45,86 TL</span></strong>
            </div>
        </div>
    </div>
    <!--2nd drop down menu -->
    <div id="dropmenu_araclar" class="dropmenudiv_a">
        <a href="#">Resim Reklam Başvurusu</a> <a href="#">Arama Motoru Optimizasyonu</a>
        <a href="#">Google Geri Dönüşüm Tahmini</a> <a href="#">Google Analytics</a> <a href="#">
            Google Haritaları</a>
    </div>
    <div style="top: 95px; left: 250px; visibility: hidden;" id="dropmenu_odeme" class="dropmenudiv_a">
        <a style="border-top-width: 0px;" target="_blank" href="http://www.destexreklam.com/odeme.aspx">Kredi Kartı İle Ödeme</a> <a href="http://www.destexreklampanel.com/Havale-Ile-Odeme.aspx">
            Havale/Eft İle Ödeme</a> <a href="http://www.destexreklampanel.com/Gecmis-Odemeler.aspx">Geçmiş Ödemeler</a>
    </div>
    <div id="dropmenu_destek" class="dropmenudiv_a">
        <a href="http://www.destexreklampanel.com/OnlineDestek.aspx">Online Destek/Yardım</a> <a href="http://www.destexreklampanel.com/Bize-Ulasin.aspx">Bize
            Ulaşın</a> <a href="http://www.destexreklampanel.com/Kullanici-Islemleri.aspx">Kullanıcı İşlemleri</a>
    </div>
    <script type="text/javascript">
        //SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
        tabdropdown.init("colortab", 3)
    </script>
    <div id="center">
        
        <table width="100%" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <td style="padding: 10px 0px 10px 5px; width: 12%; min-width: 200px" valign="top">
                    <div style="border: 1px solid #b0b0b0; background-color: White; padding: 10px; -moz-border-radius: 4px;
                        border-radius: 4px;">
                        <h1 class="anasayfa_baslik" style="margin: 0px; padding-bottom: 4px">
                            Tüm Kampanyalar</h1>
                        <table style="border-collapse: collapse; border: none; width: 100%" cellpadding="3" cellspacing="3">
                            
                                    <tbody><tr>
                                        <td style="width: 14px">
                                            <img src="gareport_files/klasor.gif">
                                        </td>
                                        <td>
                                            <a style="color: #0066cc" href="http://www.destexreklampanel.com/AdGroupsPage.aspx?cid=128045108">
                                                menu entry</a>
                                        </td>
                                    </tr>
                                
                        </tbody></table>
                    </div>
                </td>
                <td style="width: 85%; vertical-align: top">
                    
    <table width="100%">
        <tbody><tr>
            <td style="padding: 10px 5px 10px 5px;" valign="top">
                <div style="border: 1px solid #b0b0b0; background-color: White; padding: 10px; -moz-border-radius: 4px;
                    border-radius: 4px;">
                    <div style="height: 50px">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tbody><tr>
                                <td style="vertical-align: top">
                                    <span class="anasayfa_baslik">Tüm Çevrimiçi Kampanyalar</span><br>
                                    <strong id="ctl00_ContentPlaceHolder1_stTarihBilgisi" style="color: Red; font-weight: bold">
                                    </strong>
                                </td>
                                <td>
                                    <div style="border: 1px solid #b0b0b0; background-color: White; padding: 2px; -moz-border-radius: 4px;
                                        border-radius: 4px; float: right">
                                        <div style="padding: 5px; width: 324px; height: 27px;">
                                            <div style="width: 319px">
                                                <div style="width: 237px; float: left">
                                                    <div id="divDropDown" style="border: solid 1px Gray; height: 23px; width: 100%">
                                                        <select name="ctl00$ContentPlaceHolder1$ddlSecim" id="ctl00_ContentPlaceHolder1_ddlSecim" style="width:100%;border: none; height: 100%">
	<option selected="selected" value="BG">Bugün</option>
	<option value="D">Dün</option>
	<option value="S7G">Son 7 Gün</option>
	<option value="BA">Bu Ay</option>
	<option value="GA">Geçen Ay</option>
	<option value="SDG">Son 90 Gün</option>
	<option value="OA">Özel Tarih Aralığı</option>

</select>
                                                    </div>
                                                    <div id="divTarihAraligi" style="background-color: White; text-align: center; float: left;
                                                        display: none; padding: 5px; border: solid 1px gray; border-top: none; width: 226px;">
                                                        <input name="ctl00$ContentPlaceHolder1$txtBaslangicTarihi" id="ctl00_ContentPlaceHolder1_txtBaslangicTarihi" class="abc hasDatepicker" style="height:21px;width:100px;" type="text">
                                                        <input name="ctl00$ContentPlaceHolder1$txtBitisTarihi" id="ctl00_ContentPlaceHolder1_txtBitisTarihi" class="abc hasDatepicker" style="height:21px;width:100px;" type="text">
                                                    </div>
                                                </div>
                                                <div style="width: 72px; float: right">
                                                    <input name="ctl00$ContentPlaceHolder1$Button3" value="Getir" id="ctl00_ContentPlaceHolder1_Button3" class="inputButon yenileButon" type="submit">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div style="width: 99%">
                    </div>
                    <div id="ddcolortabsalt" class="ddcolortabsalt">
                        <ul>
                            <li><a href="http://www.destexreklampanel.com/Kampanyalar.aspx" title="Kampanyalar"><span>Kampanyalar</span></a></li>
                            <li><a href="http://www.destexreklampanel.com/AdGroupsPage.aspx" title="Reklam Grupları"><span>Reklam Grupları</span></a></li>
                            <li><a href="http://www.destexreklampanel.com/AdsPage.aspx" title="Reklamlar"><span>Reklamlar</span></a></li>
                            <li><a href="http://www.destexreklampanel.com/KeywordsPage.aspx" title="Anahtar Kelimeler" style="background-color: #00592c;
                                color: #fff"><span>Anahtar Kelimeler</span></a></li>
                            <li><a href="http://www.destexreklampanel.com/KampanyaRapor.aspx" title="Raporlar"><span>Raporlar</span></a></li>
                        </ul>
                    </div>
                    <div id="ctl00_ContentPlaceHolder1_divKampanyalar">
                        <div id="basic-modal">
                            <input id="btnAnahtarKelimeEkle" style="width: 190px; display: none;" class="inputButon ekleButon" onclick="AnahtarKelimeEklePopupAc('PK')" value="Yeni Anahtar Kelime Ekle" type="button">
                            <input name="ctl00$ContentPlaceHolder1$btnWord" value="Word'e aktar" id="ctl00_ContentPlaceHolder1_btnWord" class="inputButon wordButon" type="submit">
                            <input name="ctl00$ContentPlaceHolder1$btnExcel" value="Excel'e aktar" id="ctl00_ContentPlaceHolder1_btnExcel" class="inputButon excelButon" type="submit">
                            <input id="btnPrint" class="inputButon printButon" onclick="CallPrint()" value="Yazdır" type="button">
                        </div>
                    </div>
                    <div id="ctl00_ContentPlaceHolder1_divAnahtarKelimeIcerik" style="background-color: #f9f9f9;">
                        <table width="100%" cellpadding="3" cellspacing="0">
                            <thead class="tabloBaslik">
                                <tr>
                                    <th class="sol">
                                        Anahtar Kelime
                                    </th>
                                    <th class="sol">
                                        Kampanya
                                    </th>
                                    <th class="sag">
                                        Max. TBM
                                    </th>
                                    <th class="sag">
                                        Tıklamalar
                                    </th>
                                    <th class="sag">
                                        Gösterim
                                    </th>
                                    <th class="sag">
                                        Ort.TBM
                                    </th>
                                    <th class="sag">
                                        Maliyet
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody class="tabloIcerik">
<?php 
$dapi=new Dapi();
$res=$dapi->select("select * from adwords where campaign='www.tel-bant.com'");
foreach ($res as $row) {

 echo "<tr>
                                            <td style='width:100px;'>
                                        $row[keyword]
                                            </td>
                                            <td class='sol'>
						    <span style='vertical-align: middle; color: #0066cc' class='sol'>$row[campaign]</span>
                                            </td>
                                            <td class='sag maxTBM' onclick='SetKeywordMTBM(1123196476)'>
                                                
                                              $row[maxCPC] <span style='font-size:7pt'> TL</span>
                                            </td>
                                            <td class='sag'>
                                                
                                            $row[clicks]  
                                            </td>
                                            <td class='sag'>
                                          $row[impressions] 
                                                
                                            </td>
                                            <td class='sag'>
                                            
                                               $row[avgCPC]<span class='para'> TL</span>
                                            </td>
                                            <td class='sag'>
                                                $row[cost]<span class='para'> TL</span>
                                            </td>
                                           
                                        </tr>

					";
}
?>

                            </tbody>
                            <tfoot class="tabloFooter">
                                <tr>
                                    <td class="merkez durum" style="border-left: 1px solid #CCCCCC">
                                        Toplam:
                                    </td>
                                    <td class="sol" colspan="4">
                                        <span id="ctl00_ContentPlaceHolder1_lblAnahtarKelime"></span><br>
                                    </td>
                                    <td class="sag">
                                        <span id="ctl00_ContentPlaceHolder1_lblMTBM"></span><span style="font-size:7pt"> TL</span>
                                    </td>
                                    <td class="sag">
                                        <span id="ctl00_ContentPlaceHolder1_lblTiklamaOrani"></span>
                                    </td>
                                    <td class="sag">
                                        <span id="ctl00_ContentPlaceHolder1_lblTiklama">0</span>
                                    </td>
                                    <td class="sag">
                                        <span id="ctl00_ContentPlaceHolder1_lblGosterim">0</span>
                                    </td>
                                    <td class="sag">
                                        <span id="ctl00_ContentPlaceHolder1_lblOTBM"></span><span style="font-size:7pt"> TL</span>
                                    </td>
                                    <td class="sag">
                                        <span id="ctl00_ContentPlaceHolder1_lblMaliyet">0,00</span><span style="font-size:7pt"> TL</span>
                                    </td>
                                    <td class="merkez">
                                        <span id="ctl00_ContentPlaceHolder1_lblKalitePuan"></span>
                                    </td>
                                    <td class="sag">
                                        -
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div style="text-align: left; width: 100%; padding-top: 5px; padding-bottom: 8px">
                    </div>
                    <div id="divNegatifAnahtarKelimeler" style="width: 50%; display: none">
                        <div id="basic-modal" style="width: 100%; padding: 5px 0px 5px 0px">
                            <input style="display: none;" id="btnNegatifKelimeEkle" class="inputButon ekleButon" onclick="AnahtarKelimeEklePopupAc('NK')" value="Yeni Ekle" type="button">
                            
                            
                            <input id="Button7" class="inputButon printButon" onclick="CallPrintNegatif()" value="Yazdır" type="button">
                        </div>
                        <div id="ctl00_ContentPlaceHolder1_divNegatifKelimelerIcerik">
                            <table width="100%" cellpadding="3" cellspacing="0">
                                <thead class="tabloBaslik">
                                    <tr>
                                        <th class="solKenar sol">
                                            Negatif Anahtar Kelime
                                        </th>
                                        <th class="sol">
                                            Kampanya
                                        </th>
                                        <th class="sol" colspan="2">
                                            Reklam Grubu
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="tabloIcerik" id="tblNegatif">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody></table>
    <hr>
    <script type="text/javascript">
        function DurumDegistirPopupAc(obj) {
            if ($("#ctl00_AKD").val() == "True") {
                var kelimeId = obj.getAttribute("id");
                var reklamGrubuId = obj.getAttribute("name");

                $("#kelimeId").val(kelimeId);
                $("#reklamGrubuId").val(reklamGrubuId);
                $("#divKampanyaDurumDegistir").modal();
            }
        }
        function DurumDuzenle() {
            var kelimeId = $("#kelimeId").val();
            var reklamGrubuId = $("#reklamGrubuId").val();
            var durum = $("#ddlKampanyaDurum").val();
            var cevap = KeywordsPage.KeywordsDurumDegistir(kelimeId, reklamGrubuId, durum);
            location.reload();
        }
        function CallPrintNegatif() {
            var div = $('#ctl00_ContentPlaceHolder1_divNegatifKelimelerIcerik');
            var icerik = div.html();
            var WinPrint = window.open('', '', 'left=0,top=0, width=800px,toolbar=0,scrol lbars=0,status=0');
            WinPrint.document.write("<link href='App_Themes/Default/main.css' rel='stylesheet' type='text/css' />");
            WinPrint.document.write(icerik);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }
        function CallPrint() {
            var div = $('#ctl00_ContentPlaceHolder1_divAnahtarKelimeIcerik');
            var icerik = div.html();
            var WinPrint = window.open('', '', 'left=0,top=0, width=800px,toolbar=0,scrol lbars=0,status=0');
            WinPrint.document.write("<link href='App_Themes/Default/main.css' rel='stylesheet' type='text/css' />");
            WinPrint.document.write(icerik);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }
    </script>
    <script type="text/javascript">
        function KampanyalariDoldur() {
            var kampanyalar = KeywordsPage.KampanyalariGetir();
            $('#ddlKampanyalar').find('option').remove()
            $("#ddlKampanyalar").append("<option value='-1'>Kampanya Seçiniz</option>");
            for (var i = 0; i < kampanyalar.value.length; i++) {
                $("#ddlKampanyalar").append("<option value=" + kampanyalar.value[i].id + ">" + kampanyalar.value[i].name + "</option>");
            };
        }

        function NegatifPanelAc() {
            if ($("#btnPanelAc")[0].className == "on") {
                $("#btnPanelAc").attr("class", "off");
                $("#btnPanelAc").attr("src", "App_Themes/Default/images/off.png");
                var nkeys = KeywordsPage.GetNegatif();
                $('#tblNegatif').find('tr').remove()
                for (var i = 0; i < nkeys.value.length; i++) {
                    var negcrit = nkeys.value[i];
                    var td1 = "<tr><td class='sol' style='border-left: 1px solid #e4e4e4'>" + negcrit.criterion.text + "</td>";
                    var td2 = "<td class='sol'>" + negcrit.AdGroupCriterionType + "</td>";
                    var td3 = "<td class='sol'>" + negcrit.criterion.CriterionType + "</td>";
                    var td4 = "<td class='merkez' onClick='OnemliKapatSetReklamAc(" + negcrit.criterion.id + "," + negcrit.adGroupId + ")' style='vertical-align:middle'><img style='cursor:pointer'  src='App_Themes/Default/images/del1.png' /></td></tr>";
                    $('#tblNegatif').append(td1 + td2 + td3 + td4);
                }
                $("#divNegatifAnahtarKelimeler").slideDown();
                $("#imgNegatif").hide();
            }
            else {
                $("#btnPanelAc").attr("class", "on");
                $("#btnPanelAc").attr("src", "App_Themes/Default/images/on.png");
                $("#divNegatifAnahtarKelimeler").slideUp();
            }

        }
        function ReklamGruplariniDoldur() {
            $("#img").show();
            var kampanyaId = $("#ddlKampanyalar").val();
            $('#ddlReklamGruplari').find('option').remove()
            var reklamGruplari = KeywordsPage.ReklamGruplariniGetir(kampanyaId);
            for (var i = 0; i < reklamGruplari.value.length; i++) {
                $("#ddlReklamGruplari").append("<option value=" + reklamGruplari.value[i].id + ">" + reklamGruplari.value[i].name + "</option>");
            };
            $("#img").hide();
        }
        function AnahtarKelimeEklePopupAc(tip) {
            if ($('#ctl00_AKE').val() == "True") {
                $("#img").show();
                KampanyalariDoldur();
                if (tip == "NK") {
                    $("#popupBaslik").val("Yeni Negatif Anahtar Kelime Ekle");
                    $("#popupBaslik").text("Yeni Negatif Anahtar Kelime Ekle");
                    $("#spnKelimelerBaslik").text("Negatif Anahtar Kelimeler");
                    $("#spnKelimelerBaslik").val("Negatif Anahtar Kelimeler");
                    $("#ddlDurum").attr("disabled", "disabled");
                }
                else {
                    $("#popupBaslik").val("Yeni Anahtar Kelime Ekle");
                    $("#popupBaslik").text("Yeni Anahtar Kelime Ekle");
                    $("#spnKelimelerBaslik").text("Anahtar Kelimeler");
                    $("#spnKelimelerBaslik").val("Anahtar Kelimeler");
                    $("#ddlDurum").attr("disabled", "");
                }
                $("#img").hide();
                $('#divYeniAnahtarKelime').modal({ overlayClose: false, escClose: false });
            }
        }
        function OnemliKapatSetReklamAc(keywId, rgId) {
            var keywId = $("#keywordId").val(keywId);
            var keywId = $("#rgId").val(rgId);
            $('#divOnemli').modal({ overlayClose: false, escClose: false });
        }
        function SetKeywordMTBM(reklamId) {
            if ($('#ctl00_AKMTBMD').val() == "True") {
                $('#divMTBMDegistir').modal({ overlayClose: false, escClose: false });
                var reklam = KeywordsPage.GetKeyword(reklamId);
                $("#keywordId").val(reklam.value.entries[0].criterion.id);
                $("#rgId").val(reklam.value.entries[0].adGroupId);
                $("#txtDuzenlenenKelime").val(reklam.value.entries[0].criterion.text);
                $("#txtMaxTbm").mask("99,99", { placeholder: " " });
                $("#txtMaxTbm").val(reklam.value.PageType);
            }
        }

        function AnahtarKelimeKaydet() {
            var reklamGrubuId = $("#ddlReklamGruplari").val();
            var kampanyaId = $("#ddlKampanyalar").val();
            var durum = $("#ddlDurum").val();
            var eslesme = $("#ddlEslesme").val();
            var ak = $("#txtAnahtarKelime").val();
            var cevap;

            if (reklamGrubuId == "-1" | kampanyaId == "-1") {
                alert("Önce reklam grubu seçiniz!");
            }
            else if ($("#txtAnahtarKelime").val() == "") {
                alert("Hiç bir anahtar kelime eklenmemiş!");
            }
            else {
                if ($("#spnKelimelerBaslik").val() == "Negatif Anahtar Kelimeler")
                    cevap = KeywordsPage.AnahtarKelimeEkle(reklamGrubuId, ak, eslesme, "NK");
                else
                    cevap = KeywordsPage.AnahtarKelimeEkle(reklamGrubuId, ak, eslesme, "PK");

                if (cevap.value == "OK" || cevap.value == null)
                    location.reload();
                else
                    alert(cevap.value);
            }
        }

        function DuzenleneniKaydet() {
            var kelimeId = $("#keywordId").val();
            var grupId = $("#rgId").val();
            var stext = $("#txtDuzenlenenKelime").val();
            var teklif = $("#txtMaxTbm").val();
            var cevap;
            cevap = KeywordsPage.ChangeKeywordStatus(kelimeId, grupId, stext, teklif)
            if (cevap.value == true)
                location.reload();
            else
                alert("Lütfen geçerli bir değer girin");
        }
        function AnahtarKelimeSil() {
            var keywId = $("#keywordId").val();
            var rgId = $("#rgId").val();
            var cevap = KeywordsPage.KeywordSil(keywId, rgId);
            if (cevap.value != null)
                location.reload();
        }
    </script>
    
    <div id="divKampanyaDurumDegistir" style="width: 400px; display: none">
        <input id="reklamGrubuId" value="" type="hidden">
        <input id="kelimeId" value="" type="hidden">
        <table width="100%" cellpadding="0" cellspacing="0">
            <thead class="tabloBaslik">
                <tr>
                    <th colspan="2" class="solKenar">
                        Anahtar Kelime Durumunu Değiştir
                    </th>
                </tr>
            </thead>
            <tbody class="tabloIcerik">
                <tr>
                    <td class="sag" style="border-left: 1px solid #e4e4e4">
                        Yeni Durumu Seçiniz:
                    </td>
                    <td>
                        <select class="textBox" id="ddlKampanyaDurum">
                            <option selected="selected" value="A">Başlat</option>
                            <option value="D">Durdur</option>
                        </select>
                    </td>
                </tr>
            </tbody>
            <tfoot class="tabloFooter">
                <tr>
                    <td colspan="2" class="merkez" style="border-left: 1px solid #CCCCCC">
                        <input id="Button4" class="inputButon tamamButon" onclick="DurumDuzenle()" value="Yeni Durumu Kaydet" type="button">
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <div id="divYeniAnahtarKelime" style="width: 500px; display: none">
        <table width="100%" cellpadding="0" cellspacing="0">
            <thead class="tabloBaslik">
                <tr>
                    <th colspan="2" class="solKenar">
                        <span id="popupBaslik">Yeni Anahtar Kelime Ekle</span>
                    </th>
                </tr>
            </thead>
            <tbody class="tabloIcerik">
                <tr>
                    <td class="sag" style="border-left: 1px solid #e4e4e4">
                        Kampanya Seçiniz:
                    </td>
                    <td>
                        <select class="textBox" onchange="ReklamGruplariniDoldur()" id="ddlKampanyalar">
                            <option selected="selected" value="-1">Kampanya Seçiniz!</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="sag" style="border-left: 1px solid #e4e4e4">
                        Reklam Grubu Seçiniz:
                    </td>
                    <td>
                        <select class="textBox" id="ddlReklamGruplari">
                            <option selected="selected" value="-1">Önce Kampanya Seçiniz!</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="sag" style="border-left: 1px solid #e4e4e4">
                        Eşleşme Türü:
                    </td>
                    <td>
                        <select class="textBox" id="ddlEslesme">
                            <option selected="selected" value="EX">Tam Eşleşme</option>
                            <option value="BR">Geniş Eşleşme</option>
                            <option value="PH">Öbek Eşleşme</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td id="tdYayinBaslik" class="sag" style="border-left: 1px solid #e4e4e4">
                        Yayınlanma durumu:
                    </td>
                    <td id="tdYayinIcerik">
                        <select class="textBox" id="ddlDurum">
                            <option selected="selected" value="A">Yayınla</option>
                            <option value="P">Yayınlama</option>
                        </select>
                    </td>
                </tr>
            </tbody>
            <thead class="tabloBaslik">
                <tr>
                    <th colspan="2" class="solKenar">
                        <span id="spnKelimelerBaslik">Anahtar Kelimeler</span>
                    </th>
                </tr>
            </thead>
            <tbody class="tabloIcerik">
                <tr style="background-color: #e4e4e4">
                    <td style="border-left: 1px solid #e4e4e4; font-family: Tahoma; font-size: 8pt; text-align: left">
                        <span>Birden fazla kelime eklemek için her satıra bir kelime giriniz. Bir alt satıra
                            geçmek için "Enter" tuşunu kullanın.</span>
                        <br>
                        <br>
                        <i style="color: Red">Örnek:</i>
                        <div class="textBox" style="height: 100px; padding: 3px">
                            kelime 1<br>
                            kelime 2<br>
                            kelime 3</div>
                    </td>
                    <td>
                        <textarea id="txtAnahtarKelime" style="width: 241px; height: 200px" class="textBox"></textarea>
                    </td>
                </tr>
            </tbody>
            <tfoot class="tabloFooter">
                <tr>
                    <td colspan="2" class="merkez" style="border-left: 1px solid #CCCCCC; vertical-align: middle">
                        <input id="btnReklamKaydet" onclick="AnahtarKelimeKaydet()" class="inputButon tamamButon" value="Kaydet" type="button">
                        <img id="img" style="display: none; vertical-align: middle; height: 25px" src="gareport_files/al_loading.gif">
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <div id="divMTBMDegistir" style="width: 400px; display: none">
        <table width="100%" cellpadding="0" cellspacing="0">
            <thead class="tabloBaslik">
                <tr>
                    <th colspan="2" class="solKenar">
                        Maximum TBM Düzenle
                    </th>
                </tr>
            </thead>
            <tbody class="tabloIcerik">
                <tr>
                    <td class="sag" style="border-left: 1px solid #e4e4e4">
                        Anahtar Kelime:
                    </td>
                    <td>
                        <input id="txtDuzenlenenKelime" readonly="readonly" class="textBox" type="text">
                    </td>
                </tr>
                <tr>
                    <td class="sag" style="border-left: 1px solid #e4e4e4">
                        Max. TBM:
                    </td>
                    <td>
                        <input id="txtMaxTbm" class="textBox sag" type="text">
                        TL
                    </td>
                </tr>
            </tbody>
            <tfoot class="tabloFooter">
                <tr>
                    <td colspan="2" class="merkez" style="border-left: 1px solid #CCCCCC">
                        <input id="Button5" class="inputButon tamamButon" onclick="DuzenleneniKaydet()" value="Kaydet" type="button">
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <div id="divOnemli" class="oval4" style="font-weight: normal; text-align: center;
        display: none; color: Black; width: 264px;">
        Silmek istediğinize emin misiniz?<br>
        <br>
        <div style="border-style: none; padding: 5px; width: 128px; margin: auto;">
            <input onclick="AnahtarKelimeSil()" style="height: 27px; width: 60px" id="btnKapatAc" class="inputButon tamamButon" value="Evet" type="button">
            <input style="height: 27px; width: 62px" id="Button1" title="Close" class="modalCloseImg simplemodal-close inputButon hayirButon" value="Hayır" type="button">
        </div>
    </div>
    <input id="keywordId" value=" " type="hidden">
    <input id="rgId" value=" " type="hidden">

                </td>
            </tr>
        </tbody></table>
    </div>
    <div style="clear: both; height: 2px; width: 100%">
    </div>
    <div id="footer">
        <a href="http:///" target="_blank"></a>
        <br>
        All Right Reserved 2011
    </div>
    </form>

    </body>
    </html>

