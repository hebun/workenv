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
define('HEADER_TITLE_CREATE_ACCOUNT', 'Hesap A�');
define('HEADER_TITLE_MY_ACCOUNT', 'Hesab�m');
define('HEADER_TITLE_CART_CONTENTS', 'Sepetim');
define('HEADER_TITLE_CHECKOUT', '�deme');
define('HEADER_TITLE_TOP', 'Ana Sayfa');
define('HEADER_TITLE_CATALOG', 'CSFreeShop ');
define('HEADER_TITLE_LOGOFF', '��k��');
define('HEADER_TITLE_LOGIN', 'Giri�');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'ki�i, a��l�� tarihi');

// text for gender
define('MALE', 'Bay');
define('FEMALE', 'Bayan');
define('MALE_ADDRESS', 'Say�n');
define('FEMALE_ADDRESS', 'Say�n');

// text for date of birth example
define('DOB_FORMAT_STRING', 'g�n/ay/y�l');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Teslimat Bilgileri');
define('CHECKOUT_BAR_PAYMENT', '�deme Bilgileri');
define('CHECKOUT_BAR_CONFIRMATION', 'Onaylama');
define('CHECKOUT_BAR_FINISHED', 'Tamamland�!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'L�tfen Se�iniz');
define('TYPE_BELOW', 'A�a��ya Yaz�n');

// javascript messages
define('JS_ERROR', 'Doldurdu�unuz formda baz� hatalar mevcut!\nL�tfen a�a��daki k�s�mlar� tekrar g�zden ge�irin:\n\n');

define('JS_REVIEW_TEXT', '* \'Yorum Alan�\' en az ' . REVIEW_TEXT_MIN_LENGTH . ' karakterden olu�mal�.\n');
define('JS_REVIEW_RATING', '* �r�ne bir puan vermeniz gerekmektedir.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* L�tfen, Sipari�iniz i�in bir �deme �ekli se�iniz.\n');

define('JS_ERROR_SUBMITTED', 'Bu formu zaten g�nderimi�siniz. L�tfen Tamam tu�una basarak i�lemin bitmesini bekleyiniz.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'L�tfen, Sipari�iniz i�in bir �deme �ekli se�iniz.');

define('CATEGORY_COMPANY', 'Firma Bilgileri');
define('CATEGORY_PERSONAL', 'Ki�isel Bilgiler');
define('CATEGORY_ADDRESS', 'Adres');
define('CATEGORY_CONTACT', '�rtibat');
define('CATEGORY_OPTIONS', 'Se�enekler');
define('CATEGORY_PASSWORD', '�ifre');

define('ENTRY_COMPANY', 'Firma Ad�:');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Cinsiyet:');
define('ENTRY_GENDER_ERROR', 'L�tfen cinsiyet se�iniz.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', '�sim:');
define('ENTRY_FIRST_NAME_ERROR', '�sim alan� en az ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakter i�ermelidir.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Soy �sim:');
define('ENTRY_LAST_NAME_ERROR', 'Soy �sim alan� en az ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakter i�ermelidir.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Do�um Tarihi:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Do�um tarihiniz �u bi�imde olmal�d�r: G�N/AY/YIL (�rn. 22/02/1981)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (�rn. 22/02/1981)');
define('ENTRY_EMAIL_ADDRESS', 'E-Posta Adresi:');
define('ENTRY_PHONE_ADDRESS', 'Telefon Numaran�z:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'E-Posta adresiniz en az ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakter i�ermelidir.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'E-Posta adresininizde bir hata var - L�tfen kontrol edip gerekli de�i�ikli�i yap�n�z.</font></small>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'E-Posta adresiniz kay�tlar�m�zda var - L�tfen e-posta adresinizle giri� yapmay� deneyiniz yada farkl� bir adres ile bir hesap a��n�z.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Adres:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Adres alan� en az ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakter i�ermelidir.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Semt:');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Posta Kodu:');
define('ENTRY_POST_CODE_ERROR', 'Posta Kodu alan� en az ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakter i�ermelidir.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', '�l�e:');
define('ENTRY_CITY_ERROR', '�l�e alan� en az ' . ENTRY_CITY_MIN_LENGTH . ' karakter i�ermelidir.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', '�l:');
define('ENTRY_STATE_ERROR', '�l alan� en az ' . ENTRY_STATE_MIN_LENGTH . ' karakter i�ermelidir.');
define('ENTRY_STATE_ERROR_SELECT', 'L�tfen �ehirler kutusundan bir �ehir se�iniz.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', '�lke:');
define('ENTRY_COUNTRY_ERROR', 'L�tfen �lkeler kutusundan bir �lke se�iniz.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefon numaras�:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Telefon numaras� alan� en az ' . ENTRY_TELEPHONE_MIN_LENGTH . ' rakam i�ermelidir.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Faks Numaras�:');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Haber listesi:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Abone ol');
define('ENTRY_NEWSLETTER_NO', 'Abone olma');
define('ENTRY_PASSWORD', '�ifre:');
define('ENTRY_PASSWORD_ERROR', '�ifre alan� en az ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakter i�ermelidir.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', '�ifre onay� alan� �ifre alan� ile ayn� olmal�d�r.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', '�ifre Onay�:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Eski �ifre:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', '�ifre alan� en az ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakter i�ermelidir.');
define('ENTRY_PASSWORD_NEW', 'Yeni �ifre:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Yeni �ifre alan� en az ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakter i�ermelidir.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', '�ifre onay� alan� �ifre alan� ile ayn� olmal�d�r.');
define('PASSWORD_HIDDEN', '--GIZLI--');

define('FORM_REQUIRED_INFORMATION', '* Gerekli bilgi');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Sonu� Sayfalar�:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> �r�n)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> sipari�)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> yorum)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> yeni �r�n)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'G�r�nen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> indirimdeki �r�n)');

define('PREVNEXT_TITLE_FIRST_PAGE', '�lk Sayfa');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', '�nceki Sayfa');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Sonraki Sayfa');
define('PREVNEXT_TITLE_LAST_PAGE', 'Son Sayfa');
define('PREVNEXT_TITLE_PAGE_NO', 'Sayfa %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', '�nceki %d Sayfalar�');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Sonraki %d Sayfalar�');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;�LK');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;�nceki]');
define('PREVNEXT_BUTTON_NEXT', '[Sonraki&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'SON&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Ba�ka Adresler Eklemek i�in t�klay�n�z.');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adres Defterinize ula�mak i�in t�klay�n�z.');
define('IMAGE_BUTTON_BACK', 'Geri Gitmek i�in t�klay�n�z.');
define('IMAGE_BUTTON_BUY_NOW', '�imdi sat�nalmak i�in t�klay�n�z.');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Adresi De�itirmek i�in t�klay�n�z.');
define('IMAGE_BUTTON_CHECKOUT', '�deme Yapmak i�in t�klay�n�z.');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Sipari�inizi Onaylamak i�in t�klay�n�z.');
define('IMAGE_BUTTON_CONTINUE', 'Devam Etmek i�in t�klay�n�z.');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Ali�veri�e Devam Etmek i�in t�klay�n�z.');
define('IMAGE_BUTTON_DELETE', 'Silmek i�in t�klay�n�z.');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Hesap Bilgilerinizini D�zenlemek i�in t�klay�n�z.');
define('IMAGE_BUTTON_HISTORY', 'Ge�mi� Sipari�lerinizi g�rmek i�in t�klay�n�z.');
define('IMAGE_BUTTON_LOGIN', 'Giri� Yap');
define('IMAGE_BUTTON_IN_CART', 'Sepete At.');
define('IMAGE_BUTTON_NOTIFICATIONS', '�ndirim Bildirileri almak i�in t�klay�n�z.');
define('IMAGE_BUTTON_QUICK_FIND', 'Hemen Bulmak i�in t�klay�n�z.');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Indirim Bildirilerini Kald�rmak i�in t�klay�n�z.');
define('IMAGE_BUTTON_REVIEWS', 'Yorumlar� g�rmek/eklemek i�in t�klay�n�z.');
define('IMAGE_BUTTON_SEARCH', 'Arad���n�z �r�n� bulmak i�in t�klay�n�z.');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Kargo se�eneklerini g�rmek i�in t�klay�n�z.');
define('IMAGE_BUTTON_TELL_A_FRIEND', '�r�n bilgilerini Arkada��n�za G�ndermek i�in t�klay�n�z.');
define('IMAGE_BUTTON_UPDATE', 'G�ncellemek i�in t�klay�n�z.');
define('IMAGE_BUTTON_UPDATE_CART', 'Al��veri� Sepetinizi G�ncellemek i�in t�klay�n�z.');
define('IMAGE_BUTTON_WRITE_REVIEW', '�r�nler hakk�ndaki d���ncelerinizi payla�mak i�in t�klay�n�z.');

define('SMALL_IMAGE_BUTTON_DELETE', 'Sil');
define('SMALL_IMAGE_BUTTON_EDIT', 'D�zenle');
define('SMALL_IMAGE_BUTTON_VIEW', 'G�ster');

define('ICON_ARROW_RIGHT', 'daha fazlas� i�in t�klay�n�z.');
define('ICON_CART', '�r�n� Al��veri� Sepetinize Atmak i�in t�klay�n�z.');
define('ICON_ERROR', 'Hata');
define('ICON_SUCCESS', 'Ba�ar�l�');
define('ICON_WARNING', 'Uyar�');

define('TEXT_GREETING_PERSONAL', 'Say�n <span class="greetUser">%s</span>  ma�azam�za tekrar ho� geldiniz! Hangi <a href="%s"><u>yeni �r�nlerimizin</u></a> sat��a sunuldu�unu g�rmek ister misiniz?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>E�er %s de�ilseniz, l�tfen kendi hesap bilgileriniz ile <a href="%s"><u>giri� yapmak i�in t�klay�n</u></a>.</small>');
define('TEXT_GREETING_GUEST', 'Say�n <span class="greetUser">ziyaret�imiz</span> ma�azam�za ho� geldiniz! �ye hesab�n�z varsa <a href="%s"><u>�ye giri�i</u></a> yapabilir veya yeni bir <a href="%s"><u>hesap a�abilirsiniz</u></a>.');

define('TEXT_SORT_PRODUCTS', '�r�n S�ralama');
define('TEXT_DESCENDINGLY', 'azalan');
define('TEXT_ASCENDINGLY', 'artan');
define('TEXT_BY', ' ile ');

define('TEXT_REVIEW_BY', 'Say�n %s');
define('TEXT_REVIEW_WORD_COUNT', '%s kelime');
define('TEXT_REVIEW_RATING', 'Oran: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Tarih: %s');
define('TEXT_NO_REVIEWS', 'Hen�z bir �r�n yorumu bulunmamaktadir.');

define('TEXT_NO_NEW_PRODUCTS', 'Hen�z yeni bir �r�n bulunmamaktadir.');

define('TEXT_UNKNOWN_TAX_RATE', 'Bilinmeyen vergi oran�');

define('TEXT_REQUIRED', '<span class="errorText">Gerekli</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><strong><small>TEP ERROR:</small> Cannot send the email through the specified SMTP server. Please check your php.ini setting and correct the SMTP server if necessary.</strong></font>');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Kredi Kart�n�z�n son kullanma tarihi gecerli de�ildir.<br>L�tfen \'Son Kullanma Tarihi\'ni kontrol edip tekrar deneyiniz.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Kredi Kart�n�z�n numaras� ge�ersizdir.<br>L�rfen \'Kart numaras�n�\' kontrol edip tekrar deneyiniz.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'K.Kart�n�z�n ilk 4 numaras�n� kontrol ediniz : %s<br>E�er numaran�z do�ru ise, Bu K.Kart tipi ma�azam�zda kullan�lmamaktad�r.<br>E�er yanl�� ise, l�tfen tekrar deneyiniz.');

define('FOOTER_TEXT_BODY', '  .Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br>, taraf�ndan haz�rland� <a href="http://www.clicksem.net" target="_blank">ClickSem Ltd. </a>');

define('ENTRY_GSM_NUMBER', 'Gsm:');
define('ENTRY_GSM_NUMBER_ERROR', 'Gsm numaras� alan� en az ' . ENTRY_GSM_MIN_LENGTH . ' rakam i�ermelidir.');
define('ENTRY_GSM_NUMBER_TEXT', '');
define('ENTRY_ID_CARD_NO', 'TC Kimlik No:');
define('ENTRY_ID_CARD_NO_TEXT', '*');
define('ENTRY_ID_CARD_NO_ERROR', 'TC Kimlik No alan� mutlaka doldurulmal�d�r.');
define('JS_ERROR_ID_CARD', '* L�tfen TC Kimlik numaran�z� tam giriniz. \nHesab�n�z �irket ad�na girilmedi�inden bu gereklidir.\nHesab� �irket ad�na �evirmek i�in `Adresi De�i�tir` butonuna bas�n�z.\n\n');

/* ## add by Seaman ####################################  */
define('ITEM_INFORMATION_PRIVACY', 'Gizlilik S�zle�mesi');
define('ITEM_INFORMATION_CONDITIONS', 'Kullan�m Kosullar�');
define('ITEM_INFORMATION_SHIPPING', 'Teslimat &amp; �ade');
define('IMAGE_BUTTON_DETAILS', 'Detaylar');
define('PRICE', 'Fiyat�m�z:&nbsp;&nbsp;');
define('PRICE2', 'Eski Fiyat:&nbsp;&nbsp;');
define('BACK_TO_TOP', 'Yukari ��k');
define('SEE_ALL', 'Hepsini G�r');
// BOF: Featured Products (FP)
define('BOX_CATALOG_FEATURED_PRODUCTS', '�zel �r�nler');
define('BOX_HEADING_FEATURED', '�zel');
//FP: end  
// Optional Related Products (ORP) 
define('IMAGE_BUTTON_RP_BUY_NOW', 'Hemen Al');
//ORP: end 
/* ## add by Seaman ####################################  */
// Discount Code 3.1.1 - start
define('TEXT_DISCOUNT', '�ndirim');
define('TEXT_DISCOUNT_CODE', '�ndirim Kodu');
// Discount Code 3.1.1 - end

//kgt - discount coupons
define('ENTRY_DISCOUNT_COUPON_ERROR', 'Girdi�iniz kupon kodu ge�erli de�il.');
define('ENTRY_DISCOUNT_COUPON_AVAILABLE_ERROR', 'Girdi�iniz kupon kodu art�k ge�erli de�il.');
define('ENTRY_DISCOUNT_COUPON_USE_ERROR', 'Kay�tlar�m�z kuponu %s kere kulland���n�z� g�steriyor.  Kuponunuzu %s kereden fazla kullanamazs�n�z.');
define('ENTRY_DISCOUNT_COUPON_MIN_PRICE_ERROR', 'Bu kupon i�in minimum toplam paket tutar� %sdir');
define('ENTRY_DISCOUNT_COUPON_MIN_QUANTITY_ERROR', 'Bu kupon i�in alman�z gereken minimum �r�n say�s� %s adettir');
define('ENTRY_DISCOUNT_COUPON_EXCLUSION_ERROR', 'Sepetinizdeki baz� �r�nler kampanya d���d�r.' );
define('ENTRY_DISCOUNT_COUPON', 'Kupon Kodu:');
define('ENTRY_DISCOUNT_COUPON_SHIPPING_CALC_ERROR', 'Hesaplanan al��veri� tutar�n�z de�i�ti.');
//end kgt - discount coupons

?>
