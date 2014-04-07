<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Veritaban� Yedekleme Y�neticisi');

define('TABLE_HEADING_TITLE', 'Ba�l�k');
define('TABLE_HEADING_FILE_DATE', 'Tarih');
define('TABLE_HEADING_FILE_SIZE', 'Boyut');
define('TABLE_HEADING_ACTION', 'Hareket');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Yeni Yedekleme');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Yerelden Geri Y�kle');
define('TEXT_INFO_NEW_BACKUP', 'Yedekleme i�lemi birka� dakika alabilece�inden i�lemi yar�da kesmeyiniz.');
define('TEXT_INFO_UNPACK', '<br /><br />(ar�ivden dosyay� ��kard�ktan sonra)');
define('TEXT_INFO_RESTORE', 'Geri y�kleme i�lemini yar�da kesmeyiniz.<br><br>Yede�in boyutuna g�re i�lem s�resi uzamaktad�r!<br><br>E�er m�mk�nse mysql istemcisi kullan�n.<br><br>�rne�in:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Geri y�kleme i�lemini yar�da kesmeyiniz.<br><br>Bu i�lem yedeklemeden daha fazla zaman almaktad�r!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Geri y�klenecek dosya sql (text) dosyas� olmal�.');
define('TEXT_INFO_DATE', 'Tarih:');
define('TEXT_INFO_SIZE', 'Boyut:');
define('TEXT_INFO_COMPRESSION', 'S�k��t�rma:');
define('TEXT_INFO_USE_GZIP', 'GZIP Kullan');
define('TEXT_INFO_USE_ZIP', 'ZIP Kullan');
define('TEXT_INFO_USE_NO_COMPRESSION', 'S�k��t�rma Yok (Sadece SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Sadece Y�kle (sunucu taraf�nda depolama)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'En iyisi HTTPS ba�lant�s�yla yapmak');
define('TEXT_DELETE_INTRO', 'Bu yedeklemeyi silmek istiyor musunuz?');
define('TEXT_NO_EXTENSION', 'Hi�biri');
define('TEXT_BACKUP_DIRECTORY', 'Yedekleme  Dizini:');
define('TEXT_LAST_RESTORATION', 'Son Geri Y�kleme:');
define('TEXT_FORGET', '(<u>unut</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Hata: Yedekleme dizini yok. L�tfen configure.php dosyas� i�erisinden bunu ayarlay�n.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Hata: Yedekleme dizinine yazma hakk� tan�nmam��.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Hata: Y�kleme ba�lant�s� kabul edilmiyor.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Ba�ar�l�: Son geri alma tarihi temizlendi.');
define('SUCCESS_DATABASE_SAVED', 'Ba�ar�l�: Veritaban� kaydedildi.');
define('SUCCESS_DATABASE_RESTORED', 'Ba�ar�l�: Veritaban� yeniden y�klendi.');
define('SUCCESS_BACKUP_DELETED', 'Ba�ar�l�: Yedekleme kald�r�ld�.');
?>
