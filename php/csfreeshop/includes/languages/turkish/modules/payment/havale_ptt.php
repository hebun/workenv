<?php
/*
  $Id: havale.php,v 1.6 2003/01/24 21:36:04 thomasamoulton Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('MODULE_PAYMENT_havale_ptt_HESAPSAHIBI', 'Hesap Sahibi');
define('MODULE_PAYMENT_havale_ptt_BANKAISMI', 'Banka �smi');
define('MODULE_PAYMENT_havale_ptt_HESAPNO', 'Banka Hesap No');
define('MODULE_PAYMENT_havale_ptt_KOD', 'Banka Kod');


define('MODULE_PAYMENT_havale_ptt_TEXT_TITLE', 'Banka Havalesi [Posta �eki]');
define('MODULE_PAYMENT_havale_ptt_TEXT_DESCRIPTION',
	'L�tfen a�a��daki hesap numaras�na, a��klama k�sm�na ' . '<br />'.
	'<b>�sminiz</b> ve <b>Sipari� Numaran�z�</b> yazarak havalenizi yap�n�z ' . '<br /><br />'.
	'Hesap Sahibi: ' . MODULE_PAYMENT_havale_ptt_HESAPSAHIBI . '<br />'.
	'Banka �smi: ' . MODULE_PAYMENT_havale_ptt_BANKAISMI . '<br />'.
	'�ube Ad� ve Kodu: ' . MODULE_PAYMENT_havale_ptt_KOD . '<br />'.
	'Hesap No: ' . MODULE_PAYMENT_havale_ptt_HESAPNO . '<br /><br />'.
		
	
	'�deme teyidiniz al�nd���nda, sipari�iniz istedi�iniz �ekilde teslim edilmek �zere i�leme konulacakt�r.' . '<br />');

define('MODULE_PAYMENT_havale_ptt_TEXT_EMAIL_FOOTER',
	'L�tfen takip eden banka hesab�na toplam miktar� transfer ediniz.' . "\n" .
	'Faturada yaz�lacak isim.' . "\n\n" .
	'Hesap Sahibi: ' . MODULE_PAYMENT_havale_ptt_HESAPSAHIBI . "\n\n" .
	"Banka �smi: " . MODULE_PAYMENT_havale_ptt_BANKAISMI . "\n\n" .
	"�ube Ad� ve Kodu: " . MODULE_PAYMENT_havale_ptt_KOD . "\n\n" .
	"Hesap No: " . MODULE_PAYMENT_havale_ptt_HESAPNO . "\n\n" .'<br/>'.
	
	
	'�deme teyidiniz al�nd���nda, sipari�iniz istedi�iniz �ekilde teslim edilmek �zere i�leme konulacakt�r.'. "\n\n" .
	'�r�n kargoyla g�nderilir.');



?>