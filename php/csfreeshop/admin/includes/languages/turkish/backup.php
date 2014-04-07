<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Veritabaný Yedekleme Yöneticisi');

define('TABLE_HEADING_TITLE', 'Baþlýk');
define('TABLE_HEADING_FILE_DATE', 'Tarih');
define('TABLE_HEADING_FILE_SIZE', 'Boyut');
define('TABLE_HEADING_ACTION', 'Hareket');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Yeni Yedekleme');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Yerelden Geri Yükle');
define('TEXT_INFO_NEW_BACKUP', 'Yedekleme iþlemi birkaç dakika alabileceðinden iþlemi yarýda kesmeyiniz.');
define('TEXT_INFO_UNPACK', '<br /><br />(arþivden dosyayý çýkardýktan sonra)');
define('TEXT_INFO_RESTORE', 'Geri yükleme iþlemini yarýda kesmeyiniz.<br><br>Yedeðin boyutuna göre iþlem süresi uzamaktadýr!<br><br>Eðer mümkünse mysql istemcisi kullanýn.<br><br>Örneðin:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Geri yükleme iþlemini yarýda kesmeyiniz.<br><br>Bu iþlem yedeklemeden daha fazla zaman almaktadýr!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Geri yüklenecek dosya sql (text) dosyasý olmalý.');
define('TEXT_INFO_DATE', 'Tarih:');
define('TEXT_INFO_SIZE', 'Boyut:');
define('TEXT_INFO_COMPRESSION', 'Sýkýþtýrma:');
define('TEXT_INFO_USE_GZIP', 'GZIP Kullan');
define('TEXT_INFO_USE_ZIP', 'ZIP Kullan');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Sýkýþtýrma Yok (Sadece SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Sadece Yükle (sunucu tarafýnda depolama)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'En iyisi HTTPS baðlantýsýyla yapmak');
define('TEXT_DELETE_INTRO', 'Bu yedeklemeyi silmek istiyor musunuz?');
define('TEXT_NO_EXTENSION', 'Hiçbiri');
define('TEXT_BACKUP_DIRECTORY', 'Yedekleme  Dizini:');
define('TEXT_LAST_RESTORATION', 'Son Geri Yükleme:');
define('TEXT_FORGET', '(<u>unut</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Hata: Yedekleme dizini yok. Lütfen configure.php dosyasý içerisinden bunu ayarlayýn.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Hata: Yedekleme dizinine yazma hakký tanýnmamýþ.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Hata: Yükleme baðlantýsý kabul edilmiyor.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Baþarýlý: Son geri alma tarihi temizlendi.');
define('SUCCESS_DATABASE_SAVED', 'Baþarýlý: Veritabaný kaydedildi.');
define('SUCCESS_DATABASE_RESTORED', 'Baþarýlý: Veritabaný yeniden yüklendi.');
define('SUCCESS_BACKUP_DELETED', 'Baþarýlý: Yedekleme kaldýrýldý.');
?>
