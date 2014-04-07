<?php
require_once "config.php";
require_once "top.php";

@session_start();

if(!isset($_SESSION['username']) or $_SESSION['username']!='admin'){
header("location:index.php");
}
if(isset($_POST['submit'])){

	$allowedExts = array("xml","gif", "jpeg", "jpg", "png");
	$inter=explode(".", $_FILES["file"]["name"]);
	$extension = end($inter);

	if (($_FILES["file"]["size"] < 20000000)
		&& in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Hata : " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
				move_uploaded_file($_FILES["file"]["tmp_name"],
					"upload/$_POST[type].xml");
				require_once 'parse.php';
				fillDb($_POST['type']);
		}
	}
	else
	{
		echo "gecersiz dosya";
	}
}
?>
        <table width="100%" cellpadding="0" cellspacing="0">
            <tbody><tr>
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
                                    <span class="anasayfa_baslik">Rapor Yükle</span><br>
                                    <strong id="ctl00_ContentPlaceHolder1_stTarihBilgisi" style="color: Red; font-weight: bold">
                                    </strong>
                                </td>
                                <td>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div style="width: 99%">
                    </div>
                    <div style="text-align: left; width: 100%; padding-top: 5px; padding-bottom: 8px">

<form action="upload.php" method="post"
enctype="multipart/form-data">
<table cellpadding=3><tr><td valign='top'>
<strong>Rapor türü:</strong>
</td>
<td>
<input type='radio' name='type' checked value='keyword'>Anahtar kelime<br>
<input type='radio' name='type' value='gorsel'>Görsel ağ raporu <br>
<input type='radio' name='type' value='hesap'>Hesap raporu <br>
</td>
</tr>
<tr>
<td>
<label for="file"><strong>Dosya adı:</strong></label>
</td>
<td>
<input type="file" name="file" id="file"><br>
</td>
</tr>
<tr><td colspan='2'>
<input type="submit" name="submit" value="Yükle">
</td>
</tr></table>
</form>

                    </div>
                </div>
            </td>
        </tr>
    </tbody></table>
    <hr>
    
    <div style="clear: both; height: 2px; width: 100%">
    </div>
    <div id="footer">
        <a href="http:///" target="_blank"></a>
        <br>
        All Right Reserved 2011
    </div>

    </body>
    </html>

