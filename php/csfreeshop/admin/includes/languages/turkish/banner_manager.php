<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Reklam Y�neticisi');

define('TABLE_HEADING_BANNERS', 'Reklamlar');
define('TABLE_HEADING_GROUPS', 'Gruplar');
define('TABLE_HEADING_STATISTICS', 'G�sterim / T�klama');
define('TABLE_HEADING_STATUS', 'Durum');
define('TABLE_HEADING_ACTION', 'Hareket');

define('TEXT_BANNERS_TITLE', 'Reklam Ba�l���:');
define('TEXT_BANNERS_URL', 'Reklam URL:');
define('TEXT_BANNERS_GROUP', 'Reklam Grubu:');
define('TEXT_BANNERS_NEW_GROUP', ', veya a�a��ya yeni bir reklam grubu giriniz');
define('TEXT_BANNERS_IMAGE', 'Resim:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', veya a�a��ya yerel dosyay� giriniz');
define('TEXT_BANNERS_IMAGE_TARGET', 'Resim Hedefi (Kaydet):');
define('TEXT_BANNERS_HTML_TEXT', 'HTML Text:');
define('TEXT_BANNERS_EXPIRES_ON', 'Biti� Tarihi:');
define('TEXT_BANNERS_OR_AT', ', veya ');
define('TEXT_BANNERS_IMPRESSIONS', 't�klama/g�rme.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Ba�lama Tarihi:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Reklam Notlar�:</b><ul><li>Reklam i�in resim veya HTML texti kullan�n - ikisini beraber kullanmay�n.</li><li>HTML Textin resme g�re �nceli�i vard�r.</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Resim Notlar�:</b><ul><li>Geri y�kleme dizinlerinin uygun kullan�c�(yazma) izinleri ayarlanmal�!</li><li>E�er web sunucusuna resim y�klemiyorsan�z \'Kaydet\' bo�lu�unu doldurmay�n�z (�rne�in yerel (sunucu tarafl�) resim kullan�m�nda).</li><li> \'Kaydet\' bo�lu�una girdi�iniz de�er var olan bir dizini g�stermeli ve sonunda b�l� i�areti olmal� (�rne�in, reklamlar/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Biti� Tarihi Notlar�:</b><ul><li>�ki bo�luktan sadece biri dolu olmal�</li><li>E�er reklam s�resi otamatik olarak dolmayacaksa, bu bo�luklar� bo� b�rak�n�z.</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Ba�lama Tarihi Notlar�:</b><ul><li>E�er ba�lama tarihini ayarlad�ysan�z, reklam o tarihte aktif olacakt�r.</li><li>Ba�lang�� tarihleri ayarlanm�� t�m reklamlar o g�n gelene kadar aktif olarak g�z�kmezler. Ba�lama tarihine gelenler ise aktif olarak g�z�k�r.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Eklenme Tarihi:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Ba�lama Tarihi: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Biti� Tarihi: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Biti� Tarihi: <b>%s</b> g�sterim');
define('TEXT_BANNERS_STATUS_CHANGE', 'Durum De�i�imi: %s');

define('TEXT_BANNERS_DATA', 'B<br>�<br>L<br>G<br>�');
define('TEXT_BANNERS_LAST_3_DAYS', 'Son 3 G�n');
define('TEXT_BANNERS_BANNER_VIEWS', 'Reklam G�sterim');
define('TEXT_BANNERS_BANNER_CLICKS', 'Reklam T�klama');

define('TEXT_INFO_DELETE_INTRO', 'Reklam� silmeye istedi�inize emin misiniz?');
define('TEXT_INFO_DELETE_IMAGE', 'Reklam resmini sil');

define('SUCCESS_BANNER_INSERTED', 'Ba�ar�l�: Reklam eklendi.');
define('SUCCESS_BANNER_UPDATED', 'Ba�ar�l�: Reklam g�ncellendi.');
define('SUCCESS_BANNER_REMOVED', 'Ba�ar�l�: Reklam kald�r�ld�.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Ba�ar�l�: Reklam durumu g�ncellendi.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Hata: Reklam ba�l��� gereklidir.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Hata: Reklam grubu gereklidir.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Hata: Hedef dizini bulunamad�.');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Hata: Hedef dizinine yaz�lam�yor.');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Hata: Resim bulunam�yor.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Hata: Resim kald�r�lam�yor.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Hata: Bilinmeyen durum i�areti.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Hata: Graphs dizini bulunamad�. L�tfen  \'images\' dizini i�inde bir \'graphs\' dizini olu�turunuz.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Hata: Graphs dizini yaz�labilir de�il.');
?>
