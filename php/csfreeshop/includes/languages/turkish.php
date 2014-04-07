<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'en_US.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('JQUERY_DATEPICKER_I18N_CODE', ''); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization
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

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'TRY');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="tr"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-9');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Hesap Aç');
define('HEADER_TITLE_MY_ACCOUNT', 'Hesabým');
define('HEADER_TITLE_CART_CONTENTS', 'Sepetim');
define('HEADER_TITLE_CHECKOUT', 'Ödeme');
define('HEADER_TITLE_TOP', 'Ana Sayfa');
define('HEADER_TITLE_CATALOG', 'CSFreeShop ');
define('HEADER_TITLE_LOGOFF', 'Çýkýþ');
define('HEADER_TITLE_LOGIN', 'Giriþ');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'kiþi, açýlýþ tarihi');

// text for gender
define('MALE', 'Bay');
define('FEMALE', 'Bayan');
define('MALE_ADDRESS', 'Sayýn');
define('FEMALE_ADDRESS', 'Sayýn');

// text for date of birth example
define('DOB_FORMAT_STRING', 'gün/ay/yýl');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Teslimat Bilgileri');
define('CHECKOUT_BAR_PAYMENT', 'Ödeme Bilgileri');
define('CHECKOUT_BAR_CONFIRMATION', 'Onaylama');
define('CHECKOUT_BAR_FINISHED', 'Tamamlandý!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Lütfen Seçiniz');
define('TYPE_BELOW', 'Aþaðýya Yazýn');

// javascript messages
define('JS_ERROR', 'Doldurduðunuz formda bazý hatalar mevcut!\nLütfen aþaðýdaki kýsýmlarý tekrar gözden geçirin:\n\n');

define('JS_REVIEW_TEXT', '* \'Yorum Alaný\' en az ' . REVIEW_TEXT_MIN_LENGTH . ' karakterden oluþmalý.\n');
define('JS_REVIEW_RATING', '* Ürüne bir puan vermeniz gerekmektedir.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Lütfen, Sipariþiniz için bir ödeme þekli seçiniz.\n');

define('JS_ERROR_SUBMITTED', 'Bu formu zaten gönderimiþsiniz. Lütfen Tamam tuþuna basarak iþlemin bitmesini bekleyiniz.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Lütfen, Sipariþiniz için bir ödeme þekli seçiniz.');

define('CATEGORY_COMPANY', 'Firma Bilgileri');
define('CATEGORY_PERSONAL', 'Kiþisel Bilgiler');
define('CATEGORY_ADDRESS', 'Adres');
define('CATEGORY_CONTACT', 'Ýrtibat');
define('CATEGORY_OPTIONS', 'Seçenekler');
define('CATEGORY_PASSWORD', 'Þifre');

define('ENTRY_COMPANY', 'Firma Adý:');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Cinsiyet:');
define('ENTRY_GENDER_ERROR', 'Lütfen cinsiyet seçiniz.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Ýsim:');
define('ENTRY_FIRST_NAME_ERROR', 'Ýsim alaný en az ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Soy Ýsim:');
define('ENTRY_LAST_NAME_ERROR', 'Soy Ýsim alaný en az ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Doðum Tarihi:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Doðum tarihiniz þu biçimde olmalýdýr: GÜN/AY/YIL (örn. 22/02/1981)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (örn. 22/02/1981)');
define('ENTRY_EMAIL_ADDRESS', 'E-Posta Adresi:');
define('ENTRY_PHONE_ADDRESS', 'Telefon Numaranýz:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'E-Posta adresiniz en az ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'E-Posta adresininizde bir hata var - Lütfen kontrol edip gerekli deðiþikliði yapýnýz.</font></small>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'E-Posta adresiniz kayýtlarýmýzda var - Lütfen e-posta adresinizle giriþ yapmayý deneyiniz yada farklý bir adres ile bir hesap açýnýz.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Adres:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Adres alaný en az ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Semt:');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Posta Kodu:');
define('ENTRY_POST_CODE_ERROR', 'Posta Kodu alaný en az ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Ýlçe:');
define('ENTRY_CITY_ERROR', 'Ýlçe alaný en az ' . ENTRY_CITY_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Ýl:');
define('ENTRY_STATE_ERROR', 'Ýl alaný en az ' . ENTRY_STATE_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_STATE_ERROR_SELECT', 'Lütfen þehirler kutusundan bir þehir seçiniz.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Ülke:');
define('ENTRY_COUNTRY_ERROR', 'Lütfen ülkeler kutusundan bir ülke seçiniz.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefon numarasý:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Telefon numarasý alaný en az ' . ENTRY_TELEPHONE_MIN_LENGTH . ' rakam içermelidir.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Faks Numarasý:');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Haber listesi:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Abone ol');
define('ENTRY_NEWSLETTER_NO', 'Abone olma');
define('ENTRY_PASSWORD', 'Þifre:');
define('ENTRY_PASSWORD_ERROR', 'Þifre alaný en az ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Þifre onayý alaný þifre alaný ile ayný olmalýdýr.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Þifre Onayý:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Eski Þifre:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Þifre alaný en az ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_PASSWORD_NEW', 'Yeni Þifre:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Yeni Þifre alaný en az ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Þifre onayý alaný þifre alaný ile ayný olmalýdýr.');
define('PASSWORD_HIDDEN', '--GIZLI--');

define('FORM_REQUIRED_INFORMATION', '* Gerekli bilgi');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Sonuç Sayfalarý:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> ürün)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> sipariþ)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> yorum)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> yeni ürün)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Görünen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> indirimdeki ürün)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Ýlk Sayfa');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Önceki Sayfa');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Sonraki Sayfa');
define('PREVNEXT_TITLE_LAST_PAGE', 'Son Sayfa');
define('PREVNEXT_TITLE_PAGE_NO', 'Sayfa %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Önceki %d Sayfalarý');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Sonraki %d Sayfalarý');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;ÝLK');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Önceki]');
define('PREVNEXT_BUTTON_NEXT', '[Sonraki&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'SON&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Baþka Adresler Eklemek için týklayýnýz.');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adres Defterinize ulaþmak için týklayýnýz.');
define('IMAGE_BUTTON_BACK', 'Geri Gitmek için týklayýnýz.');
define('IMAGE_BUTTON_BUY_NOW', 'Þimdi satýnalmak için týklayýnýz.');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Adresi Deðitirmek için týklayýnýz.');
define('IMAGE_BUTTON_CHECKOUT', 'Ödeme Yapmak için týklayýnýz.');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Sipariþinizi Onaylamak için týklayýnýz.');
define('IMAGE_BUTTON_CONTINUE', 'Devam Etmek için týklayýnýz.');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Aliþveriþe Devam Etmek için týklayýnýz.');
define('IMAGE_BUTTON_DELETE', 'Silmek için týklayýnýz.');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Hesap Bilgilerinizini Düzenlemek için týklayýnýz.');
define('IMAGE_BUTTON_HISTORY', 'Geçmiþ Sipariþlerinizi görmek için týklayýnýz.');
define('IMAGE_BUTTON_LOGIN', 'Giriþ Yap');
define('IMAGE_BUTTON_IN_CART', 'Sepete At.');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Ýndirim Bildirileri almak için týklayýnýz.');
define('IMAGE_BUTTON_QUICK_FIND', 'Hemen Bulmak için týklayýnýz.');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Indirim Bildirilerini Kaldýrmak için týklayýnýz.');
define('IMAGE_BUTTON_REVIEWS', 'Yorumlarý görmek/eklemek için týklayýnýz.');
define('IMAGE_BUTTON_SEARCH', 'Aradýðýnýz Ürünü bulmak için týklayýnýz.');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Kargo seçeneklerini görmek için týklayýnýz.');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Ürün bilgilerini Arkadaþýnýza Göndermek için týklayýnýz.');
define('IMAGE_BUTTON_UPDATE', 'Güncellemek için týklayýnýz.');
define('IMAGE_BUTTON_UPDATE_CART', 'Alýþveriþ Sepetinizi Güncellemek için týklayýnýz.');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Ürünler hakkýndaki düþüncelerinizi paylaþmak için týklayýnýz.');

define('SMALL_IMAGE_BUTTON_DELETE', 'Sil');
define('SMALL_IMAGE_BUTTON_EDIT', 'Düzenle');
define('SMALL_IMAGE_BUTTON_VIEW', 'Göster');

define('ICON_ARROW_RIGHT', 'daha fazlasý için týklayýnýz.');
define('ICON_CART', 'Ürünü Alýþveriþ Sepetinize Atmak için týklayýnýz.');
define('ICON_ERROR', 'Hata');
define('ICON_SUCCESS', 'Baþarýlý');
define('ICON_WARNING', 'Uyarý');

define('TEXT_GREETING_PERSONAL', 'Sayýn <span class="greetUser">%s</span>  maðazamýza tekrar hoþ geldiniz! Hangi <a href="%s"><u>yeni ürünlerimizin</u></a> satýþa sunulduðunu görmek ister misiniz?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Eðer %s deðilseniz, lütfen kendi hesap bilgileriniz ile <a href="%s"><u>giriþ yapmak için týklayýn</u></a>.</small>');
define('TEXT_GREETING_GUEST', 'Sayýn <span class="greetUser">ziyaretçimiz</span> maðazamýza hoþ geldiniz! Üye hesabýnýz varsa <a href="%s"><u>üye giriþi</u></a> yapabilir veya yeni bir <a href="%s"><u>hesap açabilirsiniz</u></a>.');

define('TEXT_SORT_PRODUCTS', 'Ürün Sýralama');
define('TEXT_DESCENDINGLY', 'azalan');
define('TEXT_ASCENDINGLY', 'artan');
define('TEXT_BY', ' ile ');

define('TEXT_REVIEW_BY', 'Sayýn %s');
define('TEXT_REVIEW_WORD_COUNT', '%s kelime');
define('TEXT_REVIEW_RATING', 'Oran: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Tarih: %s');
define('TEXT_NO_REVIEWS', 'Henüz bir ürün yorumu bulunmamaktadir.');

define('TEXT_NO_NEW_PRODUCTS', 'Henüz yeni bir ürün bulunmamaktadir.');

define('TEXT_UNKNOWN_TAX_RATE', 'Bilinmeyen vergi oraný');

define('TEXT_REQUIRED', '<span class="errorText">Gerekli</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><strong><small>TEP ERROR:</small> Cannot send the email through the specified SMTP server. Please check your php.ini setting and correct the SMTP server if necessary.</strong></font>');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Kredi Kartýnýzýn son kullanma tarihi gecerli deðildir.<br>Lütfen \'Son Kullanma Tarihi\'ni kontrol edip tekrar deneyiniz.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Kredi Kartýnýzýn numarasý geçersizdir.<br>Lürfen \'Kart numarasýný\' kontrol edip tekrar deneyiniz.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'K.Kartýnýzýn ilk 4 numarasýný kontrol ediniz : %s<br>Eðer numaranýz doðru ise, Bu K.Kart tipi maðazamýzda kullanýlmamaktadýr.<br>Eðer yanlýþ ise, lütfen tekrar deneyiniz.');

define('FOOTER_TEXT_BODY', '  .Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br>, tarafýndan hazýrlandý <a href="http://www.clicksem.net" target="_blank">ClickSem Ltd. </a>');

define('ENTRY_GSM_NUMBER', 'Gsm:');
define('ENTRY_GSM_NUMBER_ERROR', 'Gsm numarasý alaný en az ' . ENTRY_GSM_MIN_LENGTH . ' rakam içermelidir.');
define('ENTRY_GSM_NUMBER_TEXT', '');
define('ENTRY_ID_CARD_NO', 'TC Kimlik No:');
define('ENTRY_ID_CARD_NO_TEXT', '*');
define('ENTRY_ID_CARD_NO_ERROR', 'TC Kimlik No alaný mutlaka doldurulmalýdýr.');
define('JS_ERROR_ID_CARD', '* Lütfen TC Kimlik numaranýzý tam giriniz. \nHesabýnýz þirket adýna girilmediðinden bu gereklidir.\nHesabý þirket adýna çevirmek için `Adresi Deðiþtir` butonuna basýnýz.\n\n');

/* ## add by Seaman ####################################  */
define('ITEM_INFORMATION_PRIVACY', 'Gizlilik Sözleþmesi');
define('ITEM_INFORMATION_CONDITIONS', 'Kullaným Kosullarý');
define('ITEM_INFORMATION_SHIPPING', 'Teslimat &amp; Ýade');
define('IMAGE_BUTTON_DETAILS', 'Detaylar');
define('PRICE', 'Fiyatýmýz:&nbsp;&nbsp;');
define('PRICE2', 'Eski Fiyat:&nbsp;&nbsp;');
define('BACK_TO_TOP', 'Yukari Çýk');
define('SEE_ALL', 'Hepsini Gör');
// BOF: Featured Products (FP)
define('BOX_CATALOG_FEATURED_PRODUCTS', 'Özel Ürünler');
define('BOX_HEADING_FEATURED', 'Özel');
//FP: end  
// Optional Related Products (ORP) 
define('IMAGE_BUTTON_RP_BUY_NOW', 'Hemen Al');
//ORP: end 
/* ## add by Seaman ####################################  */
// Discount Code 3.1.1 - start
define('TEXT_DISCOUNT', 'Ýndirim');
define('TEXT_DISCOUNT_CODE', 'Ýndirim Kodu');
// Discount Code 3.1.1 - end

//kgt - discount coupons
define('ENTRY_DISCOUNT_COUPON_ERROR', 'Girdiðiniz kupon kodu geçerli deðil.');
define('ENTRY_DISCOUNT_COUPON_AVAILABLE_ERROR', 'Girdiðiniz kupon kodu artýk geçerli deðil.');
define('ENTRY_DISCOUNT_COUPON_USE_ERROR', 'Kayýtlarýmýz kuponu %s kere kullandýðýnýzý gösteriyor.  Kuponunuzu %s kereden fazla kullanamazsýnýz.');
define('ENTRY_DISCOUNT_COUPON_MIN_PRICE_ERROR', 'Bu kupon için minimum toplam paket tutarý %sdir');
define('ENTRY_DISCOUNT_COUPON_MIN_QUANTITY_ERROR', 'Bu kupon için almanýz gereken minimum ürün sayýsý %s adettir');
define('ENTRY_DISCOUNT_COUPON_EXCLUSION_ERROR', 'Sepetinizdeki bazý ürünler kampanya dýþýdýr.' );
define('ENTRY_DISCOUNT_COUPON', 'Kupon Kodu:');
define('ENTRY_DISCOUNT_COUPON_SHIPPING_CALC_ERROR', 'Hesaplanan alýþveriþ tutarýnýz deðiþti.');
//end kgt - discount coupons

?>
