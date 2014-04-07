<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Reklam Yöneticisi');

define('TABLE_HEADING_BANNERS', 'Reklamlar');
define('TABLE_HEADING_GROUPS', 'Gruplar');
define('TABLE_HEADING_STATISTICS', 'Gösterim / Týklama');
define('TABLE_HEADING_STATUS', 'Durum');
define('TABLE_HEADING_ACTION', 'Hareket');

define('TEXT_BANNERS_TITLE', 'Reklam Baþlýðý:');
define('TEXT_BANNERS_URL', 'Reklam URL:');
define('TEXT_BANNERS_GROUP', 'Reklam Grubu:');
define('TEXT_BANNERS_NEW_GROUP', ', veya aþaðýya yeni bir reklam grubu giriniz');
define('TEXT_BANNERS_IMAGE', 'Resim:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', veya aþaðýya yerel dosyayý giriniz');
define('TEXT_BANNERS_IMAGE_TARGET', 'Resim Hedefi (Kaydet):');
define('TEXT_BANNERS_HTML_TEXT', 'HTML Text:');
define('TEXT_BANNERS_EXPIRES_ON', 'Bitiþ Tarihi:');
define('TEXT_BANNERS_OR_AT', ', veya ');
define('TEXT_BANNERS_IMPRESSIONS', 'týklama/görme.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Baþlama Tarihi:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Reklam Notlarý:</b><ul><li>Reklam için resim veya HTML texti kullanýn - ikisini beraber kullanmayýn.</li><li>HTML Textin resme göre önceliði vardýr.</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Resim Notlarý:</b><ul><li>Geri yükleme dizinlerinin uygun kullanýcý(yazma) izinleri ayarlanmalý!</li><li>Eðer web sunucusuna resim yüklemiyorsanýz \'Kaydet\' boþluðunu doldurmayýnýz (örneðin yerel (sunucu taraflý) resim kullanýmýnda).</li><li> \'Kaydet\' boþluðuna girdiðiniz deðer var olan bir dizini göstermeli ve sonunda bölü iþareti olmalý (örneðin, reklamlar/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Bitiþ Tarihi Notlarý:</b><ul><li>Ýki boþluktan sadece biri dolu olmalý</li><li>Eðer reklam süresi otamatik olarak dolmayacaksa, bu boþluklarý boþ býrakýnýz.</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Baþlama Tarihi Notlarý:</b><ul><li>Eðer baþlama tarihini ayarladýysanýz, reklam o tarihte aktif olacaktýr.</li><li>Baþlangýç tarihleri ayarlanmýþ tüm reklamlar o gün gelene kadar aktif olarak gözükmezler. Baþlama tarihine gelenler ise aktif olarak gözükür.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Eklenme Tarihi:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Baþlama Tarihi: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Bitiþ Tarihi: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Bitiþ Tarihi: <b>%s</b> gösterim');
define('TEXT_BANNERS_STATUS_CHANGE', 'Durum Deðiþimi: %s');

define('TEXT_BANNERS_DATA', 'B<br>Ý<br>L<br>G<br>Ý');
define('TEXT_BANNERS_LAST_3_DAYS', 'Son 3 Gün');
define('TEXT_BANNERS_BANNER_VIEWS', 'Reklam Gösterim');
define('TEXT_BANNERS_BANNER_CLICKS', 'Reklam Týklama');

define('TEXT_INFO_DELETE_INTRO', 'Reklamý silmeye istediðinize emin misiniz?');
define('TEXT_INFO_DELETE_IMAGE', 'Reklam resmini sil');

define('SUCCESS_BANNER_INSERTED', 'Baþarýlý: Reklam eklendi.');
define('SUCCESS_BANNER_UPDATED', 'Baþarýlý: Reklam güncellendi.');
define('SUCCESS_BANNER_REMOVED', 'Baþarýlý: Reklam kaldýrýldý.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Baþarýlý: Reklam durumu güncellendi.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Hata: Reklam baþlýðý gereklidir.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Hata: Reklam grubu gereklidir.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Hata: Hedef dizini bulunamadý.');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Hata: Hedef dizinine yazýlamýyor.');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Hata: Resim bulunamýyor.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Hata: Resim kaldýrýlamýyor.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Hata: Bilinmeyen durum iþareti.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Hata: Graphs dizini bulunamadý. Lütfen  \'images\' dizini içinde bir \'graphs\' dizini oluþturunuz.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Hata: Graphs dizini yazýlabilir deðil.');
?>
