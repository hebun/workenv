<?php
/*
  $Id: havale.php,v 1.6 2003/01/24 21:36:04 thomasamoulton Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('MODULE_PAYMENT_havale_finans_HESAPSAHIBI', 'Hesap Sahibi');
define('MODULE_PAYMENT_havale_finans_BANKABANKAISMI', 'Banka Ýsmi');
define('MODULE_PAYMENT_havale_finans_HESAPNO', 'Banka Hesap No');
define('MODULE_PAYMENT_havale_finans_KOD', 'Þube Adý ve Kodu');


define('MODULE_PAYMENT_havale_finans_TEXT_TITLE', 'Banka Havalesi [Finansbank]');
define('MODULE_PAYMENT_havale_finans_TEXT_DESCRIPTION',
	'Lütfen aþaðýdaki hesap numarasýna, açýklama kýsmýna ' . '<br />'.
	'<b>Ýsminiz</b> ve <b>Sipariþ Numaranýzý</b> yazarak havalenizi yapýnýz ' . '<br /><br />'.
	'Hesap Sahibi: ' . MODULE_PAYMENT_havale_finans_HESAPSAHIBI . '<br />'.
	'Banka Ýsmi: ' . MODULE_PAYMENT_havale_finans_BANKAISMI . '<br />'.
	'Þube Adý ve Kodu: ' . MODULE_PAYMENT_havale_finans_KOD . '<br />'.
	'Hesap No: ' . MODULE_PAYMENT_havale_finans_HESAPNO . '<br /><br />'.
		
	
	'Ödeme teyidiniz alýndýðýnda, sipariþiniz istediðiniz þekilde teslim edilmek üzere iþleme konulacaktýr.' . '<br />');

define('MODULE_PAYMENT_havale_finans_TEXT_EMAIL_FOOTER',
	'Lütfen takip eden banka hesabýna toplam miktarý transfer ediniz.' . "\n" .
	'Faturada yazýlacak isim.' . "\n\n" .
	'Hesap Sahibi: ' . MODULE_PAYMENT_havale_finans_HESAPSAHIBI . "\n\n" .
	"Banka Ýsmi: " . MODULE_PAYMENT_havale_finans_BANKAISMI . "\n\n" .
	"Þube Adý ve Kodu: " . MODULE_PAYMENT_havale_finans_KOD . "\n\n" .
	"Hesap No: " . MODULE_PAYMENT_havale_finans_HESAPNO . "\n\n" .'<br/>'.
	
	
	'Ödeme teyidiniz alýndýðýnda, sipariþiniz istediðiniz þekilde teslim edilmek üzere iþleme konulacaktýr.'. "\n\n" .
	'Ürün kargoyla gönderilir.');



?>