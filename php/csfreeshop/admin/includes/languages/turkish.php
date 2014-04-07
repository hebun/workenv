<?php

/*

  $Id$



  osCommerce, Open Source E-Commerce Solutions

  http://www.oscommerce.com



  Copyright (c) 2007 osCommerce



  Released under the GNU General Public License

*/



// look in your $PATH_LOCALE/locale directory for available locales..

// on RedHat6.0 I used 'tr_TR'

// on FreeBSD 4.0 I use 'tr_TR.ISO_8859-9'

// this may not work under win32 environments..

setlocale(LC_TIME, 'tr_TR.ISO_8859-9');

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()

define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()

define('DATE_FORMAT', 'd/m/Y'); // this is used for date()

define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()

define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

define('JQUERY_DATEPICKER_I18N_CODE', ''); // leave empty for tr_TR; see http://jqueryui.com/demos/datepicker/#localization

define('JQUERY_DATEPICKER_FORMAT', 'dd/mm/yy'); // see http://docs.jquery.com/UI/Datepicker/formatDate



////

// Return date in raw format

// $date should be in format dd/mm/yyyy

// raw date is in format DDMMYYYY, or YYYYMMDD

function tep_date_raw($date, $reverse = false) {

  if ($reverse) {

    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);

  } else {

    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);

  }

}



// Global entries for the <html> tag

define('HTML_PARAMS','dir="ltr" lang="tr"');



// charset for web pages and emails

define('CHARSET', 'iso-8859-9');



// page title

define('TITLE', 'osCommerce Online Merchant Y�netim Arac�');



// header text in includes/header.php

define('HEADER_TITLE_TOP', 'Y�netim');

define('HEADER_TITLE_SUPPORT_SITE', 'Destek Sitesi');

define('HEADER_TITLE_ONLINE_CATALOG', 'Online Ma�aza');

define('HEADER_TITLE_ADMINISTRATION', 'Y�netim');



// text for gender

define('MALE', 'Erkek');

define('FEMALE', 'Kad�n');



// text for date of birth example

define('DOB_FORMAT_STRING', 'g�n/ay/y�l');



// configuration box text in includes/boxes/configuration.php

define('BOX_HEADING_CONFIGURATION', 'Ayarlar');

define('BOX_CONFIGURATION_MYSTORE', 'Ma�azam');

define('BOX_CONFIGURATION_LOGGING', 'G�nl�k');

define('BOX_CONFIGURATION_CACHE', '�nbellek');

define('BOX_CONFIGURATION_ADMINISTRATORS', 'Y�neticiler');

define('BOX_CONFIGURATION_STORE_LOGO', 'Ma�aza Logosu');



// modules box text in includes/boxes/modules.php

define('BOX_HEADING_MODULES', 'Mod�ller');



// categories box text in includes/boxes/catalog.php

define('BOX_HEADING_CATALOG', 'Katalog');

define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategoriler/�r�nler');

define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', '�r�n �zellikleri');

define('BOX_CATALOG_MANUFACTURERS', '�reticiler');

define('BOX_CATALOG_REVIEWS', 'Yorumlar');

define('BOX_CATALOG_SPECIALS', '�ndirimdekiler');

define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Beklenen �r�nler');



// customers box text in includes/boxes/customers.php

define('BOX_HEADING_CUSTOMERS', 'M��teriler');

define('BOX_CUSTOMERS_CUSTOMERS', 'M��teriler');

define('BOX_CUSTOMERS_ORDERS', 'Sipari�ler');



// taxes box text in includes/boxes/taxes.php

define('BOX_HEADING_LOCATION_AND_TAXES', '�ehirler / Vergiler');

define('BOX_TAXES_COUNTRIES', '�lkeler');

define('BOX_TAXES_ZONES', '�ehirler(B�lgeler)');

define('BOX_TAXES_GEO_ZONES', 'Vergi B�lgeleri');

define('BOX_TAXES_TAX_CLASSES', 'Vergi T�rleri');

define('BOX_TAXES_TAX_RATES', 'Vergi Oranlar�');



// reports box text in includes/boxes/reports.php

define('BOX_HEADING_REPORTS', 'Raporlar');

define('BOX_REPORTS_PRODUCTS_VIEWED', '�r�n ziyaret say�lar�');

define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Sat�lan �r�nler');

define('BOX_REPORTS_ORDERS_TOTAL', 'M��teri Sipari�-Toplamlar�');



// tools text in includes/boxes/tools.php

define('BOX_HEADING_TOOLS', 'Ara�lar');

define('BOX_TOOLS_ACTION_RECORDER', 'Eylem Kaydedici');

define('BOX_TOOLS_BACKUP', 'Veritaban� Yedekleme');

define('BOX_TOOLS_BANNER_MANAGER', 'Reklam Y�netimi');

define('BOX_TOOLS_CACHE', '�nbellek Y�netici');

define('BOX_TOOLS_DEFINE_LANGUAGE', 'Dilleri D�zenle');

define('BOX_TOOLS_MAIL', 'Eposta G�nder');

define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Posta Y�netimi');

define('BOX_TOOLS_SEC_DIR_PERMISSIONS', 'Dizin G�venlik �zinleri');

define('BOX_TOOLS_SERVER_INFO', 'Sunucu Bilgisi');

define('BOX_TOOLS_VERSION_CHECK', 'Versiyon Denetleme');

define('BOX_TOOLS_WHOS_ONLINE', 'Kimler Siteye Ba�l�');



// localizaion box text in includes/boxes/localization.php

define('BOX_HEADING_LOCALIZATION', 'Yerelle�tirme');

define('BOX_LOCALIZATION_CURRENCIES', 'Para Birimleri');

define('BOX_LOCALIZATION_LANGUAGES', 'Diller');

define('BOX_LOCALIZATION_ORDERS_STATUS', 'Sipari� Durumlar�');

//kgt - discount coupons
define('BOX_CATALOG_DISCOUNT_COUPONS', '�ndirim Kuponu');
//end kgt - discount coupons

//kgt - discount coupons report
define('BOX_REPORTS_DISCOUNT_COUPONS', '�ndirim Kuponu');
//end kgt - discount coupons report

// javascript messages

define('JS_ERROR', 'Formun i�lenmesinde hatalar olu�tu!\nL�tfen belirtilen d�zeltmeleri yap�n�z:\n\n');



define('JS_OPTIONS_VALUE_PRICE', '* Yeni �r�n �zelli�ine fiyat de�eri girmelisiniz\n');

define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Yeni �r�n �zelliklerine fiyat �neki eklemelisiniz\n');



define('JS_PRODUCTS_NAME', '* Yeni �r�ne bir isim vermelisiniz\n');

define('JS_PRODUCTS_DESCRIPTION', '* Yeni �r�ne i�in a��klama yazmal�s�n�z\n');

define('JS_PRODUCTS_PRICE', '* Yeni �r�n i�in fiyat de�eri girmelisiniz\n');

define('JS_PRODUCTS_WEIGHT', '* Yeni �r�n i�in a��rl�k de�eri girmelisiniz\n');

define('JS_PRODUCTS_QUANTITY', '* Yeni �r�n�n miktar�n� girmelisiniz\n');

define('JS_PRODUCTS_MODEL', '* Yeni �r�n i�in bir model de�eri yazmal�s�n�z\n');

define('JS_PRODUCTS_IMAGE', '* Yeni �r�n i�in resim de�eri yazmal�s�n�z\n');



define('JS_SPECIALS_PRODUCTS_PRICE', '* Kaydetmek i�in bu �r�ne yeni bir fiyat belirtmelisiniz.\n');



define('JS_GENDER', '* \'Cinsiyet\' se�ene�ini bo� b�rakmamal�s�n�z.\n');

define('JS_FIRST_NAME', '* \'�sminiz\' en az ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakter olmal�d�r.\n');

define('JS_LAST_NAME', '* \'Soy Isminiz\' en az ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakter olaml�d�r.\n');

define('JS_DOB', '* \'Do�um Tarihiniz\'  xx/xx/xxxx (g�n/ay/yil) seklinde olmal�d�r.\n');

define('JS_EMAIL_ADDRESS', '* \'E-Mail Adresiniz\' en az ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakter olmal�d�r.\n');

define('JS_ADDRESS', '* \'Adresiniz\' en az ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakter olmal�d�r.\n');

define('JS_POST_CODE', '* \'Posta Kodu\' en az ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakter olmal�d�r.\n');

define('JS_CITY', '* \'�l�e\' en az ' . ENTRY_CITY_MIN_LENGTH . ' karakter olmal�d�r.\n');

define('JS_STATE', '* \'�ehir\'\'inizi  se�mek zorundasiniz.\n');

define('JS_STATE_SELECT', '-- Yukar�dan Se�iniz --');

define('JS_ZONE', '* \'�ehir\' se�enegini bu �lke i�in g�sterilen listeden se�mek zorundas�n�z.');

define('JS_COUNTRY', '* \'�lke\' se�enegini bo� b�rakmamal�s�n�z.');

define('JS_TELEPHONE', '* \'Telefon Numarasi\' en az ' . ENTRY_TELEPHONE_MIN_LENGTH . ' karakter olmal�d�r.\n');

define('JS_PASSWORD', '* \'�ifre\' ve \'Dogrulama\' se�enekleri birbirini dogrulamal� ve en az ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakter olmal�d�r.\n');



define('JS_ORDER_DOES_NOT_EXIST', 'Sipari� numaras� %s yok!');



define('CATEGORY_PERSONAL', 'Ki�isel');

define('CATEGORY_ADDRESS', 'Adres');

define('CATEGORY_CONTACT', '�leti�im');

define('CATEGORY_COMPANY', '�irket');

define('CATEGORY_OPTIONS', 'Se�enekler');



define('ENTRY_GENDER', 'Cinsiyet:');

define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">gerekli</span>');

define('ENTRY_FIRST_NAME', '�sim:');

define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakter</span>');

define('ENTRY_LAST_NAME', 'Soy �sim:');

define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakter</span>');

define('ENTRY_DATE_OF_BIRTH', 'Do�um Tarihi:');

define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(�rn. 05/21/1970)</span>');

define('ENTRY_EMAIL_ADDRESS', 'E-Mail Adresi:');

define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakter</span>');

define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Bu e-mail adresi ge�erli formatta de�il!</span>');

define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Bu e-mail adresi zaten kullan�mda!</span>');

define('ENTRY_COMPANY', '�irket �smi:');

define('ENTRY_STREET_ADDRESS', 'Adres:');

define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakter</span>');

define('ENTRY_SUBURB', 'Semt:');

define('ENTRY_POST_CODE', 'Post Kodu:');

define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakter</span>');

define('ENTRY_CITY', '�l�e:');

define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_CITY_MIN_LENGTH . ' karakter</span>');

define('ENTRY_STATE', '�ehir:');

define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">gerekli</span>');

define('ENTRY_COUNTRY', '�lke:');

define('ENTRY_COUNTRY_ERROR', 'L�tfen �lkenizi se�iniz.');

define('ENTRY_TELEPHONE_NUMBER', 'Telefon Numaras�:');

define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_TELEPHONE_MIN_LENGTH . ' karakter</span>');

define('ENTRY_FAX_NUMBER', 'Fax Numaras�:');

define('ENTRY_NEWSLETTER', 'Haber Postas�:');

define('ENTRY_NEWSLETTER_YES', '�ye');

define('ENTRY_NEWSLETTER_NO', '�ye De�il');



// images

define('IMAGE_ANI_SEND_EMAIL', 'E-Mail G�nder');

define('IMAGE_BACK', 'Geri');

define('IMAGE_BACKUP', 'Yedekle');

define('IMAGE_CANCEL', '�ptal');

define('IMAGE_CONFIRM', 'Do�rula');

define('IMAGE_COPY', 'Kopyala');

define('IMAGE_COPY_TO', 'Kopyalanacak Yer');

define('IMAGE_DETAILS', 'Ayr�nt�lar');

define('IMAGE_DELETE', 'Sil');

define('IMAGE_EDIT', 'D�zenle');

define('IMAGE_EMAIL', 'Email');

define('IMAGE_EXPORT', 'D��ar� ��kart');

define('IMAGE_ICON_STATUS_GREEN', 'Aktif');

define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Aktif Et');

define('IMAGE_ICON_STATUS_RED', 'Aktif De�il');

define('IMAGE_ICON_STATUS_RED_LIGHT', 'Deaktif Et');

define('IMAGE_ICON_INFO', 'Bilgi');

define('IMAGE_INSERT', 'Ekle');

define('IMAGE_LOCK', 'Kilit');

define('IMAGE_MODULE_INSTALL', 'Mod�l� Y�kle');

define('IMAGE_MODULE_REMOVE', 'Mod�l� Kald�r');

define('IMAGE_MOVE', 'Ta��');

define('IMAGE_NEW_BANNER', 'Yeni Reklam');

define('IMAGE_NEW_CATEGORY', 'Yeni Kategori');

define('IMAGE_NEW_COUNTRY', 'Yeni �lke');

define('IMAGE_NEW_CURRENCY', 'Yeni Para Birimi');

define('IMAGE_NEW_FILE', 'Yeni Dosya');

define('IMAGE_NEW_FOLDER', 'Yeni Dizin');

define('IMAGE_NEW_LANGUAGE', 'Yeni Dil');

define('IMAGE_NEW_NEWSLETTER', 'Yeni Haber Postas�');

define('IMAGE_NEW_PRODUCT', 'Yeni �r�n');

define('IMAGE_NEW_TAX_CLASS', 'Yeni Vergi T�r�');

define('IMAGE_NEW_TAX_RATE', 'Yeni Vergi Oran�');

define('IMAGE_NEW_TAX_ZONE', 'Yeni Vergi B�lgesi');

define('IMAGE_NEW_ZONE', 'Yeni B�lge');

define('IMAGE_ORDERS', 'Sipari�ler');

define('IMAGE_ORDERS_INVOICE', 'Fatura');

define('IMAGE_ORDERS_PACKINGSLIP', '�rsaliye');

define('IMAGE_PREVIEW', '�nizleme');

define('IMAGE_RESTORE', 'Geri Al');

define('IMAGE_RESET', 'Ayarla');

define('IMAGE_SAVE', 'Kaydet');

define('IMAGE_SEARCH', 'Ara');

define('IMAGE_SELECT', 'Se�');

define('IMAGE_SEND', 'G�nder');

define('IMAGE_SEND_EMAIL', 'Send Email');

define('IMAGE_UNLOCK', 'A�');

define('IMAGE_UPDATE', 'G�ncelle');

define('IMAGE_UPDATE_CURRENCIES', 'D�viz Kurunu G�ncelle');

define('IMAGE_UPLOAD', 'Y�kle');



define('ICON_CROSS', 'Yanl��');

define('ICON_CURRENT_FOLDER', 'Ge�erli Dizin');

define('ICON_DELETE', 'Sil');

define('ICON_ERROR', 'Hata');

define('ICON_FILE', 'Dosya');

define('ICON_FILE_DOWNLOAD', 'Y�kle');

define('ICON_FOLDER', 'Dizin');

define('ICON_LOCKED', 'Kilitli');

define('ICON_PREVIOUS_LEVEL', '�nceki Seviye');

define('ICON_PREVIEW', '�nizleme');

define('ICON_STATISTICS', '�statistik');

define('ICON_SUCCESS', 'Ba�ar�l�');

define('ICON_TICK', 'Do�ru');

define('ICON_UNLOCKED', 'A��ld�');

define('ICON_WARNING', 'Uyar�');



// constants for use in tep_prev_next_display function

define('TEXT_RESULT_PAGE', 'Sayfa %s / %d');

define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> reklam)');

define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> �lke)');

define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> m��teri)');

define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> para birimi)');

define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'G�r�nen <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> girdiler)');

define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> dil)');

define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> �retici)');

define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> haber postas�');

define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> sipari�)');

define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> sipari� durumu)');

define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> �r�n)');

define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> beklenen �r�n)');

define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> �r�n yorumu)');

define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> �zel �r�n)');

define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> vergi cinsi)');

define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> vergi b�lgesi)');

define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> vergi oran�)');

define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> �ehir/b�lge)');



define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');

define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');



define('TEXT_DEFAULT', 'Varsay�lan');

define('TEXT_SET_DEFAULT', 'Varsay�lan Yap');

define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Gerekli</span>');



define('TEXT_CACHE_CATEGORIES', 'Kategoriler Kutusu');

define('TEXT_CACHE_MANUFACTURERS', '�reticiler Kutusu');

define('TEXT_CACHE_ALSO_PURCHASED', 'Ayn� Zamanda Sat�lanlar Mod�l�');



define('TEXT_NONE', '--bo�--');

define('TEXT_TOP', 'L�tfen Se�iniz');



define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Hata: Hedef bulunamad�.');

define('ERROR_DESTINATION_NOT_WRITEABLE', 'Hata: Hedef yaz�labilir de�il.');
define('ERROR_FILE_NOT_SAVED', 'Hata: Dosya y�kleme kaydedilemedi.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Hata: Y�klenen dosya tipi gecersiz.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Ba�ar�l�: Dosya y�kleme ba�ar�l�.');
define('WARNING_NO_FILE_UPLOADED', 'Uyar�: Dosya y�klemesi yok.');


      define('ALL_PAGES', 't�m sayfalar.');
      define('ANY_PAGES', 'herhangi bir sayfa.');
      define('ONE_BY_ONE', 'yada tek tek se�in :');
// BOF: Featured Products (FP)
define('BOX_CATALOG_FEATURED_PRODUCTS', '<b class="add_by_seaman">�zel �r�nler</b>');
//FP: end
/* Optional Related Products (ORP) */
        define('BOX_CATALOG_CATEGORIES_RELATED_PRODUCTS', '<b class="add_by_seaman">�lgili �r�nler</b>');
        define('IMAGE_BUTTON_NEW_INSTALL_SQL', '�lgili �r�nler i�in SQL y�klemesi, Version 4.0');
        define('IMAGE_BUTTON_UPGRADE_SQL', '�lgili �r�nler i�in SQL yenilemesi, Version 4.0');
        define('IMAGE_BUTTON_REMOVE_SQL', '�lgili �r�nler i�in SQL bilgilerinin kald�r�lmas�');
        define('IMAGE_RELATED_PRODUCTS', '�lgili �r�nler');
//ORP: end 
 define('BOX_HEADING_PAGES', 'Sayfalar');
 define('BOX_HEADING_SETTING', 'Ayarlar');
  
 define('BOX_CATALOG_TAGS', 'Etiketler');


define('ENTRY_GSM_NUMBER', 'Gsm:');

define('ENTRY_ID_CARD_NO', 'TC Kimlik No:');



// Discount Code 2.6 - start

define('BOX_CATALOG_DISCOUNT_CODES', 'Kupon Kodu');

define('TEXT_DISPLAY_NUMBER_OF_DISCOUNT_CODES', 'G�r�nt�lenen <b>%d</b> - <b>%d</b> (of <b>%d</b> kupon kodu)');

define('IMAGE_NEW_DISCOUNT_CODE', 'Yeni Kupon Kodu');

// Discount Code 2.6 - end
define('BOX_HEADING_PAGES', 'Sayfalar');
 define('BOX_HEADING_SETTING', 'Konf�g�rasyon');
  
 define('BOX_CATALOG_TAGS', 'Etiketler');
 // Discount Code 3.1.1 - start
define('BOX_CATALOG_DISCOUNT_CODES', '�ndirim Kuponlar�');
define('TEXT_DISPLAY_NUMBER_OF_DISCOUNT_CODES', 'G�sterilen <b>%d</b> to <b>%d</b> (of <b>%d</b> indirim kuponlar�)');
define('IMAGE_NEW_DISCOUNT_CODE', 'Yeni �ndirim Kuponu');
// Discount Code 3.1.1 - end
//kgt - discount coupons
define('BOX_CATALOG_DISCOUNT_COUPONS', 'Discount Coupons');
//end kgt - discount coupons

//kgt - discount coupons report
define('BOX_REPORTS_DISCOUNT_COUPONS', 'Discount Coupons');
//end kgt - discount coupons report
?>