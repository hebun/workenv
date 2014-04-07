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

define('TITLE', 'osCommerce Online Merchant Yönetim Aracý');



// header text in includes/header.php

define('HEADER_TITLE_TOP', 'Yönetim');

define('HEADER_TITLE_SUPPORT_SITE', 'Destek Sitesi');

define('HEADER_TITLE_ONLINE_CATALOG', 'Online Maðaza');

define('HEADER_TITLE_ADMINISTRATION', 'Yönetim');



// text for gender

define('MALE', 'Erkek');

define('FEMALE', 'Kadýn');



// text for date of birth example

define('DOB_FORMAT_STRING', 'gün/ay/yýl');



// configuration box text in includes/boxes/configuration.php

define('BOX_HEADING_CONFIGURATION', 'Ayarlar');

define('BOX_CONFIGURATION_MYSTORE', 'Maðazam');

define('BOX_CONFIGURATION_LOGGING', 'Günlük');

define('BOX_CONFIGURATION_CACHE', 'Önbellek');

define('BOX_CONFIGURATION_ADMINISTRATORS', 'Yöneticiler');

define('BOX_CONFIGURATION_STORE_LOGO', 'Maðaza Logosu');



// modules box text in includes/boxes/modules.php

define('BOX_HEADING_MODULES', 'Modüller');



// categories box text in includes/boxes/catalog.php

define('BOX_HEADING_CATALOG', 'Katalog');

define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategoriler/Ürünler');

define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Ürün Özellikleri');

define('BOX_CATALOG_MANUFACTURERS', 'Üreticiler');

define('BOX_CATALOG_REVIEWS', 'Yorumlar');

define('BOX_CATALOG_SPECIALS', 'Ýndirimdekiler');

define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Beklenen Ürünler');



// customers box text in includes/boxes/customers.php

define('BOX_HEADING_CUSTOMERS', 'Müþteriler');

define('BOX_CUSTOMERS_CUSTOMERS', 'Müþteriler');

define('BOX_CUSTOMERS_ORDERS', 'Sipariþler');



// taxes box text in includes/boxes/taxes.php

define('BOX_HEADING_LOCATION_AND_TAXES', 'Þehirler / Vergiler');

define('BOX_TAXES_COUNTRIES', 'Ülkeler');

define('BOX_TAXES_ZONES', 'Þehirler(Bölgeler)');

define('BOX_TAXES_GEO_ZONES', 'Vergi Bölgeleri');

define('BOX_TAXES_TAX_CLASSES', 'Vergi Türleri');

define('BOX_TAXES_TAX_RATES', 'Vergi Oranlarý');



// reports box text in includes/boxes/reports.php

define('BOX_HEADING_REPORTS', 'Raporlar');

define('BOX_REPORTS_PRODUCTS_VIEWED', 'Ürün ziyaret sayýlarý');

define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Satýlan ürünler');

define('BOX_REPORTS_ORDERS_TOTAL', 'Müþteri Sipariþ-Toplamlarý');



// tools text in includes/boxes/tools.php

define('BOX_HEADING_TOOLS', 'Araçlar');

define('BOX_TOOLS_ACTION_RECORDER', 'Eylem Kaydedici');

define('BOX_TOOLS_BACKUP', 'Veritabaný Yedekleme');

define('BOX_TOOLS_BANNER_MANAGER', 'Reklam Yönetimi');

define('BOX_TOOLS_CACHE', 'Önbellek Yönetici');

define('BOX_TOOLS_DEFINE_LANGUAGE', 'Dilleri Düzenle');

define('BOX_TOOLS_MAIL', 'Eposta Gönder');

define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Posta Yönetimi');

define('BOX_TOOLS_SEC_DIR_PERMISSIONS', 'Dizin Güvenlik Ýzinleri');

define('BOX_TOOLS_SERVER_INFO', 'Sunucu Bilgisi');

define('BOX_TOOLS_VERSION_CHECK', 'Versiyon Denetleme');

define('BOX_TOOLS_WHOS_ONLINE', 'Kimler Siteye Baðlý');



// localizaion box text in includes/boxes/localization.php

define('BOX_HEADING_LOCALIZATION', 'Yerelleþtirme');

define('BOX_LOCALIZATION_CURRENCIES', 'Para Birimleri');

define('BOX_LOCALIZATION_LANGUAGES', 'Diller');

define('BOX_LOCALIZATION_ORDERS_STATUS', 'Sipariþ Durumlarý');

//kgt - discount coupons
define('BOX_CATALOG_DISCOUNT_COUPONS', 'Ýndirim Kuponu');
//end kgt - discount coupons

//kgt - discount coupons report
define('BOX_REPORTS_DISCOUNT_COUPONS', 'Ýndirim Kuponu');
//end kgt - discount coupons report

// javascript messages

define('JS_ERROR', 'Formun iþlenmesinde hatalar oluþtu!\nLütfen belirtilen düzeltmeleri yapýnýz:\n\n');



define('JS_OPTIONS_VALUE_PRICE', '* Yeni ürün özelliðine fiyat deðeri girmelisiniz\n');

define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Yeni ürün özelliklerine fiyat öneki eklemelisiniz\n');



define('JS_PRODUCTS_NAME', '* Yeni ürüne bir isim vermelisiniz\n');

define('JS_PRODUCTS_DESCRIPTION', '* Yeni ürüne için açýklama yazmalýsýnýz\n');

define('JS_PRODUCTS_PRICE', '* Yeni ürün için fiyat deðeri girmelisiniz\n');

define('JS_PRODUCTS_WEIGHT', '* Yeni ürün için aðýrlýk deðeri girmelisiniz\n');

define('JS_PRODUCTS_QUANTITY', '* Yeni ürünün miktarýný girmelisiniz\n');

define('JS_PRODUCTS_MODEL', '* Yeni ürün için bir model deðeri yazmalýsýnýz\n');

define('JS_PRODUCTS_IMAGE', '* Yeni ürün için resim deðeri yazmalýsýnýz\n');



define('JS_SPECIALS_PRODUCTS_PRICE', '* Kaydetmek için bu ürüne yeni bir fiyat belirtmelisiniz.\n');



define('JS_GENDER', '* \'Cinsiyet\' seçeneðini boþ býrakmamalýsýnýz.\n');

define('JS_FIRST_NAME', '* \'Ýsminiz\' en az ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakter olmalýdýr.\n');

define('JS_LAST_NAME', '* \'Soy Isminiz\' en az ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakter olamlýdýr.\n');

define('JS_DOB', '* \'Doðum Tarihiniz\'  xx/xx/xxxx (gün/ay/yil) seklinde olmalýdýr.\n');

define('JS_EMAIL_ADDRESS', '* \'E-Mail Adresiniz\' en az ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakter olmalýdýr.\n');

define('JS_ADDRESS', '* \'Adresiniz\' en az ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakter olmalýdýr.\n');

define('JS_POST_CODE', '* \'Posta Kodu\' en az ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakter olmalýdýr.\n');

define('JS_CITY', '* \'Ýlçe\' en az ' . ENTRY_CITY_MIN_LENGTH . ' karakter olmalýdýr.\n');

define('JS_STATE', '* \'Þehir\'\'inizi  seçmek zorundasiniz.\n');

define('JS_STATE_SELECT', '-- Yukarýdan Seçiniz --');

define('JS_ZONE', '* \'Þehir\' seçenegini bu ülke için gösterilen listeden seçmek zorundasýnýz.');

define('JS_COUNTRY', '* \'Ülke\' seçenegini boþ býrakmamalýsýnýz.');

define('JS_TELEPHONE', '* \'Telefon Numarasi\' en az ' . ENTRY_TELEPHONE_MIN_LENGTH . ' karakter olmalýdýr.\n');

define('JS_PASSWORD', '* \'Þifre\' ve \'Dogrulama\' seçenekleri birbirini dogrulamalý ve en az ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakter olmalýdýr.\n');



define('JS_ORDER_DOES_NOT_EXIST', 'Sipariþ numarasý %s yok!');



define('CATEGORY_PERSONAL', 'Kiþisel');

define('CATEGORY_ADDRESS', 'Adres');

define('CATEGORY_CONTACT', 'Ýletiþim');

define('CATEGORY_COMPANY', 'Þirket');

define('CATEGORY_OPTIONS', 'Seçenekler');



define('ENTRY_GENDER', 'Cinsiyet:');

define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">gerekli</span>');

define('ENTRY_FIRST_NAME', 'Ýsim:');

define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakter</span>');

define('ENTRY_LAST_NAME', 'Soy Ýsim:');

define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakter</span>');

define('ENTRY_DATE_OF_BIRTH', 'Doðum Tarihi:');

define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(örn. 05/21/1970)</span>');

define('ENTRY_EMAIL_ADDRESS', 'E-Mail Adresi:');

define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakter</span>');

define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Bu e-mail adresi geçerli formatta deðil!</span>');

define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Bu e-mail adresi zaten kullanýmda!</span>');

define('ENTRY_COMPANY', 'Þirket Ýsmi:');

define('ENTRY_STREET_ADDRESS', 'Adres:');

define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakter</span>');

define('ENTRY_SUBURB', 'Semt:');

define('ENTRY_POST_CODE', 'Post Kodu:');

define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakter</span>');

define('ENTRY_CITY', 'Ýlçe:');

define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_CITY_MIN_LENGTH . ' karakter</span>');

define('ENTRY_STATE', 'Þehir:');

define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">gerekli</span>');

define('ENTRY_COUNTRY', 'Ülke:');

define('ENTRY_COUNTRY_ERROR', 'Lütfen Ülkenizi seçiniz.');

define('ENTRY_TELEPHONE_NUMBER', 'Telefon Numarasý:');

define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_TELEPHONE_MIN_LENGTH . ' karakter</span>');

define('ENTRY_FAX_NUMBER', 'Fax Numarasý:');

define('ENTRY_NEWSLETTER', 'Haber Postasý:');

define('ENTRY_NEWSLETTER_YES', 'Üye');

define('ENTRY_NEWSLETTER_NO', 'Üye Deðil');



// images

define('IMAGE_ANI_SEND_EMAIL', 'E-Mail Gönder');

define('IMAGE_BACK', 'Geri');

define('IMAGE_BACKUP', 'Yedekle');

define('IMAGE_CANCEL', 'Ýptal');

define('IMAGE_CONFIRM', 'Doðrula');

define('IMAGE_COPY', 'Kopyala');

define('IMAGE_COPY_TO', 'Kopyalanacak Yer');

define('IMAGE_DETAILS', 'Ayrýntýlar');

define('IMAGE_DELETE', 'Sil');

define('IMAGE_EDIT', 'Düzenle');

define('IMAGE_EMAIL', 'Email');

define('IMAGE_EXPORT', 'Dýþarý Çýkart');

define('IMAGE_ICON_STATUS_GREEN', 'Aktif');

define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Aktif Et');

define('IMAGE_ICON_STATUS_RED', 'Aktif Deðil');

define('IMAGE_ICON_STATUS_RED_LIGHT', 'Deaktif Et');

define('IMAGE_ICON_INFO', 'Bilgi');

define('IMAGE_INSERT', 'Ekle');

define('IMAGE_LOCK', 'Kilit');

define('IMAGE_MODULE_INSTALL', 'Modülü Yükle');

define('IMAGE_MODULE_REMOVE', 'Modülü Kaldýr');

define('IMAGE_MOVE', 'Taþý');

define('IMAGE_NEW_BANNER', 'Yeni Reklam');

define('IMAGE_NEW_CATEGORY', 'Yeni Kategori');

define('IMAGE_NEW_COUNTRY', 'Yeni Ülke');

define('IMAGE_NEW_CURRENCY', 'Yeni Para Birimi');

define('IMAGE_NEW_FILE', 'Yeni Dosya');

define('IMAGE_NEW_FOLDER', 'Yeni Dizin');

define('IMAGE_NEW_LANGUAGE', 'Yeni Dil');

define('IMAGE_NEW_NEWSLETTER', 'Yeni Haber Postasý');

define('IMAGE_NEW_PRODUCT', 'Yeni Ürün');

define('IMAGE_NEW_TAX_CLASS', 'Yeni Vergi Türü');

define('IMAGE_NEW_TAX_RATE', 'Yeni Vergi Oraný');

define('IMAGE_NEW_TAX_ZONE', 'Yeni Vergi Bölgesi');

define('IMAGE_NEW_ZONE', 'Yeni Bölge');

define('IMAGE_ORDERS', 'Sipariþler');

define('IMAGE_ORDERS_INVOICE', 'Fatura');

define('IMAGE_ORDERS_PACKINGSLIP', 'Ýrsaliye');

define('IMAGE_PREVIEW', 'Önizleme');

define('IMAGE_RESTORE', 'Geri Al');

define('IMAGE_RESET', 'Ayarla');

define('IMAGE_SAVE', 'Kaydet');

define('IMAGE_SEARCH', 'Ara');

define('IMAGE_SELECT', 'Seç');

define('IMAGE_SEND', 'Gönder');

define('IMAGE_SEND_EMAIL', 'Send Email');

define('IMAGE_UNLOCK', 'Aç');

define('IMAGE_UPDATE', 'Güncelle');

define('IMAGE_UPDATE_CURRENCIES', 'Döviz Kurunu Güncelle');

define('IMAGE_UPLOAD', 'Yükle');



define('ICON_CROSS', 'Yanlýþ');

define('ICON_CURRENT_FOLDER', 'Geçerli Dizin');

define('ICON_DELETE', 'Sil');

define('ICON_ERROR', 'Hata');

define('ICON_FILE', 'Dosya');

define('ICON_FILE_DOWNLOAD', 'Yükle');

define('ICON_FOLDER', 'Dizin');

define('ICON_LOCKED', 'Kilitli');

define('ICON_PREVIOUS_LEVEL', 'Önceki Seviye');

define('ICON_PREVIEW', 'Önizleme');

define('ICON_STATISTICS', 'Ýstatistik');

define('ICON_SUCCESS', 'Baþarýlý');

define('ICON_TICK', 'Doðru');

define('ICON_UNLOCKED', 'Açýldý');

define('ICON_WARNING', 'Uyarý');



// constants for use in tep_prev_next_display function

define('TEXT_RESULT_PAGE', 'Sayfa %s / %d');

define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> reklam)');

define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> ülke)');

define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> müþteri)');

define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> para birimi)');

define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'Görünen <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> girdiler)');

define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> dil)');

define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> üretici)');

define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> haber postasý');

define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> sipariþ)');

define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> sipariþ durumu)');

define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> ürün)');

define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> beklenen ürün)');

define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> ürün yorumu)');

define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> özel ürün)');

define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> vergi cinsi)');

define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> vergi bölgesi)');

define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> vergi oraný)');

define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> þehir/bölge)');



define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');

define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');



define('TEXT_DEFAULT', 'Varsayýlan');

define('TEXT_SET_DEFAULT', 'Varsayýlan Yap');

define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Gerekli</span>');



define('TEXT_CACHE_CATEGORIES', 'Kategoriler Kutusu');

define('TEXT_CACHE_MANUFACTURERS', 'Üreticiler Kutusu');

define('TEXT_CACHE_ALSO_PURCHASED', 'Ayný Zamanda Satýlanlar Modülü');



define('TEXT_NONE', '--boþ--');

define('TEXT_TOP', 'Lütfen Seçiniz');



define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Hata: Hedef bulunamadý.');

define('ERROR_DESTINATION_NOT_WRITEABLE', 'Hata: Hedef yazýlabilir deðil.');
define('ERROR_FILE_NOT_SAVED', 'Hata: Dosya yükleme kaydedilemedi.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Hata: Yüklenen dosya tipi gecersiz.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Baþarýlý: Dosya yükleme baþarýlý.');
define('WARNING_NO_FILE_UPLOADED', 'Uyarý: Dosya yüklemesi yok.');


      define('ALL_PAGES', 'tüm sayfalar.');
      define('ANY_PAGES', 'herhangi bir sayfa.');
      define('ONE_BY_ONE', 'yada tek tek seçin :');
// BOF: Featured Products (FP)
define('BOX_CATALOG_FEATURED_PRODUCTS', '<b class="add_by_seaman">Özel Ürünler</b>');
//FP: end
/* Optional Related Products (ORP) */
        define('BOX_CATALOG_CATEGORIES_RELATED_PRODUCTS', '<b class="add_by_seaman">Ýlgili Ürünler</b>');
        define('IMAGE_BUTTON_NEW_INSTALL_SQL', 'Ýlgili ürünler için SQL yüklemesi, Version 4.0');
        define('IMAGE_BUTTON_UPGRADE_SQL', 'Ýlgili ürünler için SQL yenilemesi, Version 4.0');
        define('IMAGE_BUTTON_REMOVE_SQL', 'Ýlgili ürünler için SQL bilgilerinin kaldýrýlmasý');
        define('IMAGE_RELATED_PRODUCTS', 'Ýlgili Ürünler');
//ORP: end 
 define('BOX_HEADING_PAGES', 'Sayfalar');
 define('BOX_HEADING_SETTING', 'Ayarlar');
  
 define('BOX_CATALOG_TAGS', 'Etiketler');


define('ENTRY_GSM_NUMBER', 'Gsm:');

define('ENTRY_ID_CARD_NO', 'TC Kimlik No:');



// Discount Code 2.6 - start

define('BOX_CATALOG_DISCOUNT_CODES', 'Kupon Kodu');

define('TEXT_DISPLAY_NUMBER_OF_DISCOUNT_CODES', 'Görüntülenen <b>%d</b> - <b>%d</b> (of <b>%d</b> kupon kodu)');

define('IMAGE_NEW_DISCOUNT_CODE', 'Yeni Kupon Kodu');

// Discount Code 2.6 - end
define('BOX_HEADING_PAGES', 'Sayfalar');
 define('BOX_HEADING_SETTING', 'Konfügürasyon');
  
 define('BOX_CATALOG_TAGS', 'Etiketler');
 // Discount Code 3.1.1 - start
define('BOX_CATALOG_DISCOUNT_CODES', 'Ýndirim Kuponlarý');
define('TEXT_DISPLAY_NUMBER_OF_DISCOUNT_CODES', 'Gösterilen <b>%d</b> to <b>%d</b> (of <b>%d</b> indirim kuponlarý)');
define('IMAGE_NEW_DISCOUNT_CODE', 'Yeni Ýndirim Kuponu');
// Discount Code 3.1.1 - end
//kgt - discount coupons
define('BOX_CATALOG_DISCOUNT_COUPONS', 'Discount Coupons');
//end kgt - discount coupons

//kgt - discount coupons report
define('BOX_REPORTS_DISCOUNT_COUPONS', 'Discount Coupons');
//end kgt - discount coupons report
?>