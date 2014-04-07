<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Yöneticiler');

define('TABLE_HEADING_ADMINISTRATORS', 'Yöneticiler');
define('TABLE_HEADING_HTPASSWD', 'htpasswd ile teminatlandýrýlmýþ');
define('TABLE_HEADING_ACTION', 'Hareket');

define('TEXT_INFO_INSERT_INTRO', 'Lütfen yeni yönetici ile ilgili verileri giriniz');
define('TEXT_INFO_EDIT_INTRO', 'Lütfen gerekli deðiþiklikleri yapýnýz');
define('TEXT_INFO_DELETE_INTRO', 'Bu yöneticiyi silmek istediðinize emin misiniz?');
define('TEXT_INFO_HEADING_NEW_ADMINISTRATOR', 'Yeni Yönetici');
define('TEXT_INFO_USERNAME', 'Kullanýcý Ýsmi:');
define('TEXT_INFO_NEW_PASSWORD', 'Yeni Þifre:');
define('TEXT_INFO_PASSWORD', 'Þifre:');
define('TEXT_INFO_PROTECT_WITH_HTPASSWD', 'Korumak ile htaccess/htpasswd');

define('ERROR_ADMINISTRATOR_EXISTS', 'Hata: Yönetici kayýtlarýmýzda zaten var.');

define('HTPASSWD_INFO', '<strong>htaccess ile Ek Koruma / htpasswd</strong><p>Bu osCommerce Online Merchant Yönetim Aracý yükleme ayrýca htaccess / htpasswd yollarla güvenli deðildir.</p><p>htaccess etkinleþtirilmesi / otomatik olarak yönetici þifre kayýtlarýný güncellerken bir htpasswd dosyasýnda yönetici kullanýcý adý ve þifreleri saklar htpasswd güvenlik katmaný.</p><p><strong>Lütfen dikkat</strong>, Bu ek güvenlik katmaný etkinse ve artýk aþaðýdaki deðiþiklikleri yapýn ve htaccess / htpasswd koruma saðlamak için barýndýrma saðlayýcýnýza danýþýn, Yönetim Aracý eriþebilirsiniz:</p><p><u><strong>1. Bu dosyayý düzenleyin:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htaccess</p><p>Varsa aþaðýdaki satýrlarý kaldýrýn:</p><p><i>%s</i></p><p><u><strong>2. Bu dosyayý silin:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htpasswd_oscommerce</p>');
define('HTPASSWD_SECURED', '<strong>htaccess ile Ek Koruma / htpasswd</strong><p>Bu osCommerce Online Merchant Yönetim Aracý yükleme ayrýca htaccess / htpasswd yollarla güvenli.</p>');
define('HTPASSWD_PERMISSIONS', '<strong>htaccess ile Ek Koruma / htpasswd</strong><p>Bu osCommerce Online Merchant Yönetim Aracý yükleme ayrýca htaccess / htpasswd yollarla güvenli deðildir.</p><p>Aþaðýdaki dosyalar htaccess / htpasswd güvenlik katmaný saðlamak için web sunucu tarafýndan yazýlabilir olmasý gerekir:</p><ul><li>' . DIR_FS_ADMIN . '.htaccess</li><li>' . DIR_FS_ADMIN . '.htpasswd_oscommerce</li></ul><p>doðru dosya izinlerini ayarlamak olup olmadýðýna Sayfaya sayfa onaylamak için.</p>');
?>
