<?php
/*
  $Id: havale.php,v 1.6 2003/01/24 21:36:04 thomasamoulton Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('MODULE_PAYMENT_havale_garanti_HESAPSAHIBI', 'Hesap Sahibi');
define('MODULE_PAYMENT_havale_garanti_BANKAISMI', 'Banka Ýsmi');
define('MODULE_PAYMENT_havale_garanti_HESAPNO', 'Banka Hesap No');
define('MODULE_PAYMENT_havale_garanti_KOD', 'Þube Adý ve Kodu');


define('MODULE_PAYMENT_havale_garanti_TEXT_TITLE', 'Banka Havalesi [Garanti Bankasý]');
define('MODULE_PAYMENT_havale_garanti_TEXT_DESCRIPTION',
	'Lütfen aþaðýdaki hesap numarasýna, açýklama kýsmýna ' . '<br />'.
	'<b>Ýsminiz</b> ve <b>Sipariþ Numaranýzý</b> yazarak havalenizi yapýnýz ' . '<br /><br />'.
	'Hesap Sahibi: ' . MODULE_PAYMENT_havale_garanti_HESAPSAHIBI . '<br />'.
	'Banka Ýsmi: ' . MODULE_PAYMENT_havale_garanti_BANKAISMI . '<br />'.
	'Þube Adý ve Kodu: ' . MODULE_PAYMENT_havale_garanti_KOD . '<br />'.
	'Hesap No: ' . MODULE_PAYMENT_havale_garanti_HESAPNO . '<br /><br />'.
		
	
	'Ödeme teyidiniz alýndýðýnda, sipariþiniz istediðiniz þekilde teslim edilmek üzere iþleme konulacaktýr.' . '<br />');

define('MODULE_PAYMENT_havale_garanti_TEXT_EMAIL_FOOTER',
	'Lütfen takip eden banka hesabýna toplam miktarý transfer ediniz.' . "\n" .
	'Faturada yazýlacak isim.' . "\n\n" .
	'Hesap Sahibi: ' . MODULE_PAYMENT_havale_garanti_HESAPSAHIBI . "\n\n" .
	"Banka Ýsmi: " . MODULE_PAYMENT_havale_garanti_BANKAISMI . "\n\n" .
	"Þube Adý ve Kodu: " . MODULE_PAYMENT_havale_garanti_KOD . "\n\n" .
	"Hesap No: " . MODULE_PAYMENT_havale_garanti_HESAPNO . "\n\n" .'<br/>'.
	
	
	'Ödeme teyidiniz alýndýðýnda, sipariþiniz istediðiniz þekilde teslim edilmek üzere iþleme konulacaktýr.'. "\n\n" .
	'Ürün kargoyla gönderilir.');



?>