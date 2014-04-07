<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Y�neticiler');

define('TABLE_HEADING_ADMINISTRATORS', 'Y�neticiler');
define('TABLE_HEADING_HTPASSWD', 'htpasswd ile teminatland�r�lm��');
define('TABLE_HEADING_ACTION', 'Hareket');

define('TEXT_INFO_INSERT_INTRO', 'L�tfen yeni y�netici ile ilgili verileri giriniz');
define('TEXT_INFO_EDIT_INTRO', 'L�tfen gerekli de�i�iklikleri yap�n�z');
define('TEXT_INFO_DELETE_INTRO', 'Bu y�neticiyi silmek istedi�inize emin misiniz?');
define('TEXT_INFO_HEADING_NEW_ADMINISTRATOR', 'Yeni Y�netici');
define('TEXT_INFO_USERNAME', 'Kullan�c� �smi:');
define('TEXT_INFO_NEW_PASSWORD', 'Yeni �ifre:');
define('TEXT_INFO_PASSWORD', '�ifre:');
define('TEXT_INFO_PROTECT_WITH_HTPASSWD', 'Korumak ile htaccess/htpasswd');

define('ERROR_ADMINISTRATOR_EXISTS', 'Hata: Y�netici kay�tlar�m�zda zaten var.');

define('HTPASSWD_INFO', '<strong>htaccess ile Ek Koruma / htpasswd</strong><p>Bu osCommerce Online Merchant Y�netim Arac� y�kleme ayr�ca htaccess / htpasswd yollarla g�venli de�ildir.</p><p>htaccess etkinle�tirilmesi / otomatik olarak y�netici �ifre kay�tlar�n� g�ncellerken bir htpasswd dosyas�nda y�netici kullan�c� ad� ve �ifreleri saklar htpasswd g�venlik katman�.</p><p><strong>L�tfen dikkat</strong>, Bu ek g�venlik katman� etkinse ve art�k a�a��daki de�i�iklikleri yap�n ve htaccess / htpasswd koruma sa�lamak i�in bar�nd�rma sa�lay�c�n�za dan���n, Y�netim Arac� eri�ebilirsiniz:</p><p><u><strong>1. Bu dosyay� d�zenleyin:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htaccess</p><p>Varsa a�a��daki sat�rlar� kald�r�n:</p><p><i>%s</i></p><p><u><strong>2. Bu dosyay� silin:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htpasswd_oscommerce</p>');
define('HTPASSWD_SECURED', '<strong>htaccess ile Ek Koruma / htpasswd</strong><p>Bu osCommerce Online Merchant Y�netim Arac� y�kleme ayr�ca htaccess / htpasswd yollarla g�venli.</p>');
define('HTPASSWD_PERMISSIONS', '<strong>htaccess ile Ek Koruma / htpasswd</strong><p>Bu osCommerce Online Merchant Y�netim Arac� y�kleme ayr�ca htaccess / htpasswd yollarla g�venli de�ildir.</p><p>A�a��daki dosyalar htaccess / htpasswd g�venlik katman� sa�lamak i�in web sunucu taraf�ndan yaz�labilir olmas� gerekir:</p><ul><li>' . DIR_FS_ADMIN . '.htaccess</li><li>' . DIR_FS_ADMIN . '.htpasswd_oscommerce</li></ul><p>do�ru dosya izinlerini ayarlamak olup olmad���na Sayfaya sayfa onaylamak i�in.</p>');
?>
