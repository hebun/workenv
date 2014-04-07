<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
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
            <strong id="ctl00_stMailAdresi"><?php
@session_start();
            echo $_SESSION['username'];
            ?></strong>|<a id="ctl00_btnCikis" href="logout.php">Çıkış</a>
            <br>
            <strong id="ctl00_stEmail" style="display: none">1256106053</strong>
        </div>
    </div>
    <div id="menu" style="background-color: #008844; height: 28px; padding-top: 7px;
        padding-left: 10px;">
        <div>
            <div id="colortab" class="ddcolortabs" style="float: left; width: 50%">
                <ul>
                    <li id="ctl00_lianasayfa"><a href="campaigns.php" title="Ana Sayfa"><span>Ana
                        Sayfa</span></a></li>
                    <li class="" id="ctl00_liodemeler"><a href="#" title="Bütçe Ödeme" rel="dropmenu_odeme">
                        <span>Bütçe/Ödeme</span></a></li>
                    <li class=" selected default" id="ctl00_liyardim"><a href="#" title="Destek/Yardım" rel="dropmenu_destek">
                        <span>Destek/Yardım</span></a></li>
                    
                    
                </ul>
            </div>
            <div id="ctl00_divBakiye" style="float: right; color: White; margin-right: 5px;
                padding-top: 2px;">
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
	<a style="border-top-width: 0px;"  href="#">Kredi Kartı İle Ödeme</a>
 <a href="#">
            Havale/Eft İle Ödeme</a> <a href="#">Geçmiş Ödemeler</a>
    </div>
    <div id="dropmenu_destek" class="dropmenudiv_a">
        <a href="#">Online Destek/Yardım</a> <a href="#">Bize
            Ulaşın</a> <a href="#">Kullanıcı İşlemleri</a>
    </div>
    <script type="text/javascript">
        //SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
        tabdropdown.init("colortab", 3)
    </script>
    <div id="center">
        
