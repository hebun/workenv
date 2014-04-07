<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head id="Head1" runat="server">
    <title>Yönetici Girişi</title>
    <link href="style1.css" rel="stylesheet" type="text/css" />
<style type="text/css">
td img {display: block;}body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(images/back.jpg);
	background-color: #013157;
	background-repeat: repeat-x;
}
</style>

<link rel="stylesheet" type="text/css" href="http://www.atakmail.com/dialog/css/dialog.css">
	<link rel="stylesheet" type="text/css" href="http://www.atakmail.com/dialog/css/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.atakmail.com/dialog/css/linkbutton.css">
	<link rel="stylesheet" type="text/css" href="http://www.atakmail.com/dialog/css/shadow.css">
	<script type="text/javascript" src="http://www.atakmail.com/dialog/js/jquery-1.2.6.js"></script>
	<script type="text/javascript" src="http://www.atakmail.com/dialog/js/jquery.draggable.js"></script>
	<script type="text/javascript" src="http://www.atakmail.com/dialog/js/jquery.resizable.js"></script>
	<script type="text/javascript" src="http://www.atakmail.com/dialog/js/jquery.linkbutton.js"></script>
	<script type="text/javascript" src="http://www.atakmail.com/dialog/js/jquery.shadow.js"></script>
	<script type="text/javascript" src="http://www.atakmail.com/dialog/js/jquery.dialog.js"></script>


</head>
<body bgcolor="#ffffff">

    <form id="form1" runat="server">
    <div>
<table border="0" cellpadding="0" cellspacing="0" width="650">
  <!-- fwtable fwsrc="adminlogin.png" fwbase="adminlogin.jpg" fwstyle="Dreamweaver" fwdocid = "131683008" fwnested="0" -->
  <tr>
    <td><img src="images/spacer.gif" width="80" height="1" border="0" alt="" /></td>
    <td><img src="images/spacer.gif" width="110" height="1" border="0" alt="" /></td>
    <td><img src="images/spacer.gif" width="82" height="1" border="0" alt="" /></td>
    <td><img src="images/spacer.gif" width="72" height="1" border="0" alt="" /></td>
    <td><img src="images/spacer.gif" width="23" height="1" border="0" alt="" /></td>
    <td><img src="images/spacer.gif" width="279" height="1" border="0" alt="" /></td>
    <td><img src="images/spacer.gif" width="4" height="1" border="0" alt="" /></td>
    <td><img src="images/spacer.gif" width="1" height="1" border="0" alt="" /></td>
  </tr>
  <tr>
    <td colspan="6">
    <div id="uyarisistemi" style="width:450px;" runat="server">
        </div>
        <uc1:UyariSistemi ID="UyariSistemi1" runat="server" />
    </td>
    <td rowspan="10"><img name="adminlogin_r1_c7" src="images/adminlogin_r1_c7.jpg" width="4" height="468" border="0" id="adminlogin_r1_c7" alt="" /></td>
    <td><img src="images/spacer.gif" width="1" height="91" border="0" alt="" /></td>
  </tr>
  <tr>
    <td rowspan="8"><img name="adminlogin_r2_c1" src="images/adminlogin_r2_c1.jpg" width="80" height="235" border="0" id="adminlogin_r2_c1" alt="" /></td>
    <td colspan="4"><img name="adminlogin_r2_c2" src="images/adminlogin_r2_c2.jpg" width="287" height="51" border="0" id="adminlogin_r2_c2" alt="" /></td>
    <td rowspan="8"><img name="adminlogin_r2_c6" src="images/adminlogin_r2_c6.jpg" width="279" height="235" border="0" id="adminlogin_r2_c6" alt="" /></td>
    <td><img src="images/spacer.gif" width="1" height="51" border="0" alt="" /></td>
  </tr>
  <tr>
    <td colspan="4"><img name="adminlogin_r3_c2" src="images/adminlogin_r3_c2.jpg" width="287" height="7" border="0" id="adminlogin_r3_c2" alt="" /></td>
    <td><img src="images/spacer.gif" width="1" height="7" border="0" alt="" /></td>
  </tr>
  <tr>
    <td><img name="adminlogin_r4_c2" src="images/adminlogin_r4_c2.jpg" width="110" height="20" border="0" id="adminlogin_r4_c2" alt="" /></td>
    <td colspan="2" bgcolor="#FFFFFF">
        <asp:TextBox ID="txtKulad" runat="server" CssClass="form_ana"></asp:TextBox></td>
    <td><img name="adminlogin_r4_c5" src="images/adminlogin_r4_c5.jpg" width="23" height="20" border="0" id="adminlogin_r4_c5" alt="" /></td>
    <td><img src="images/spacer.gif" width="1" height="20" border="0" alt="" /></td>
  </tr>
  <tr>
    <td colspan="4"><img name="adminlogin_r5_c2" src="images/adminlogin_r5_c2.jpg" width="287" height="17" border="0" id="adminlogin_r5_c2" alt="" /></td>
    <td><img src="images/spacer.gif" width="1" height="17" border="0" alt="" /></td>
  </tr>
  <tr>
    <td><img name="adminlogin_r6_c2" src="images/adminlogin_r6_c2.jpg" width="110" height="19" border="0" id="adminlogin_r6_c2" alt="" /></td>
    <td colspan="2" bgcolor="#FFFFFF">
        <asp:TextBox ID="txtSifre" runat="server" CssClass="form_ana" TextMode="Password"></asp:TextBox></td>
    <td><img name="adminlogin_r6_c5" src="images/adminlogin_r6_c5.jpg" width="23" height="19" border="0" id="adminlogin_r6_c5" alt="" /></td>
    <td><img src="images/spacer.gif" width="1" height="19" border="0" alt="" /></td>
  </tr>
  <tr>
    <td colspan="4"><img name="adminlogin_r7_c2" src="images/adminlogin_r7_c2.jpg" width="287" height="11" border="0" id="adminlogin_r7_c2" alt="" /></td>
    <td><img src="images/spacer.gif" width="1" height="11" border="0" alt="" /></td>
  </tr>
  <tr>
    <td><img name="adminlogin_r8_c2" src="images/adminlogin_r8_c2.jpg" width="110" height="26" border="0" id="adminlogin_r8_c2" alt="" /></td>
    <td>
        <asp:ImageButton ID="ImageButton1" ImageUrl="images/adminlogin_r8_c3.jpg" width="82" height="26" border="0" runat="server" OnClick="ImageButton1_Click" /></td>
    <td colspan="2"><img name="adminlogin_r8_c4" src="images/adminlogin_r8_c4.jpg" width="95" height="26" border="0" id="adminlogin_r8_c4" alt="" /></td>
    <td><img src="images/spacer.gif" width="1" height="26" border="0" alt="" /></td>
  </tr>
  <tr>
    <td><img name="adminlogin_r9_c2" src="images/adminlogin_r9_c2.jpg" width="110" height="84" border="0" id="adminlogin_r9_c2" alt="" /></td>
    <td><img name="adminlogin_r9_c3" src="images/adminlogin_r9_c3.jpg" width="82" height="84" border="0" id="adminlogin_r9_c3" alt="" /></td>
    <td colspan="2"><img name="adminlogin_r9_c4" src="images/adminlogin_r9_c4.jpg" width="95" height="84" border="0" id="adminlogin_r9_c4" alt="" /></td>
    <td><img src="images/spacer.gif" width="1" height="84" border="0" alt="" /></td>
  </tr>
  <tr>
    <td><img name="adminlogin_r10_c1" src="images/adminlogin_r10_c1.jpg" width="80" height="142" border="0" id="adminlogin_r10_c1" alt="" /></td>
    <td colspan="4"><img name="adminlogin_r10_c2" src="images/adminlogin_r10_c2.jpg" width="287" height="142" border="0" id="adminlogin_r10_c2" alt="" /></td>
    <td><img name="adminlogin_r10_c6" src="images/adminlogin_r10_c6.jpg" width="279" height="142" border="0" id="adminlogin_r10_c6" alt="" /></td>
    <td><img src="images/spacer.gif" width="1" height="142" border="0" alt="" /></td>
  </tr>
</table></div>
    </form>
</body>
</html>
