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
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script> 
<script src="ajax.js" type="text/javascript" charset="utf-8"></script> 
<script src="client.js" type="text/javascript" charset="utf-8"></script> 
    <link href="gareport_files/main.css" rel="stylesheet" type="text/css"><link href="gareport_files/ddcolortabs.css" rel="stylesheet" type="text/css">
    
<link href="gareport_files/style.css" rel="stylesheet" type="text/css">
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
                    <li class=" selected default" id="ctl00_liyardim"><a href="muhasebe.php" title="Hesap Dökümü" rel="dropmenu_destek">
                        <span>Hesap Dökümü</span></a></li>
                    <?php
@session_start();

if(isset($_SESSION['username']) and $_SESSION['username']=='admin'){

echo ' 
                    <li class=" selected default" id="adminli"><a href="upload.php" title="destek/yardım" rel="admin_upload">
                        <span>Rapor Yükle</span></a></li>';
echo ' 
                    <li class=" selected default" id="adminli"><a href="users.php" title="destek/yardım" rel="admin_upload">
                        <span>Kullanicilar</span></a></li>';
}
                    ?>
                    
                </ul>

        <div style="float: right; color:white;padding-top:5px;width=400px">
</div>
            </div>
            <div id="ctl00_divBakiye" style="float: right; color: White; margin-right: 5px;
                padding-top: 2px;">
<?php
$dapi=new Dapi();
$userRow=$dapi->select("select * from users where customerId=$_SESSION[customerId]")[0];
echo "<b>Bakiye: $userRow[bakiye] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kupon Bakiyesi: $userRow[kbakiye] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kupon Tipi: %$userRow[kupontype]00</b>";
?>
            </div>
        </div>
    </div>
    <div id="center">
        
