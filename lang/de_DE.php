<?php
/**
 * Copyright 2010, 2011 pixeltricks GmbH
 *
 * This file is part of SilvercartPaymentIPayment.
 *
 * SilvercartPaymentIPayment is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SilvercartPaymentIPayment is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with SilvercartPaymentIPayment.  If not, see <http://www.gnu.org/licenses/>.
 *
 * German (Germany) language pack
 *
 * @package Silvercart
 * @subpackage i18n
 * @ignore
 */

i18n::include_locale_file('silvercart_payment_ipayment', 'en_US');

global $lang;

if (array_key_exists('de_DE', $lang) && is_array($lang['de_DE'])) {
    $lang['de_DE'] = array_merge($lang['en_US'], $lang['de_DE']);
} else {
    $lang['de_DE'] = $lang['en_US'];
}


$lang['de_DE']['SilvercartHandlingCostIPayment']['PLURALNAME'] = 'Gebühren';
$lang['de_DE']['SilvercartHandlingCostIPayment']['SINGULARNAME'] = 'Gebühr';

$lang['de_DE']['SilvercartOrderStatus']['IPAYMENT_CANCELED'] = 'iPayment abgebrochen';
$lang['de_DE']['SilvercartOrderStatus']['IPAYMENT_ERROR'] = 'iPayment Fehler';

$lang['de_DE']['SilvercartPaymentIPayment']['ACCOUNT_ID'] = 'Account-ID';
$lang['de_DE']['SilvercartPaymentIPayment']['API_URL'] = 'URL zum iPayment Silent CGI Checkout';
$lang['de_DE']['SilvercartPaymentIPayment']['API_DEVELOPMENT_MODE'] = 'API Entwicklungsmodus';
$lang['de_DE']['SilvercartPaymentIPayment']['API_LIVE_MODE'] = 'API Live Modus';
$lang['de_DE']['SilvercartPaymentIPayment']['ATTRIBUTED_ORDERSTATUS'] = 'Zuordnung Bestellstatus';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_SESSION'] = 'Bei der Verbindung mit iPayment ist ein Fehler aufgetreten. Bitte entschuldigen Sie die Verzögerung und versuchen Sie es noch einmal. Sollte der Fehler wiederholt auftreten, setzen Sie sich bitte mit uns in Verbindung.';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_DEFAULT'] = 'Es ist ein Fehler aufgetreten. Bitte entschuldigen Sie die Verzögerung und versuchen Sie es noch einmal. Sollte der Fehler wiederholt auftreten, setzen Sie sich bitte mit uns in Verbindung oder wählen Sie eine alternative Zahlart.';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_MISSING_CARDHOLDER'] = 'Dieses Feld darf nicht leer sein.';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_MISMATCHING_CARD_TYPE'] = 'Kartentyp passt nicht zur Nummer';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_CREDIT_CARD_NUMBER'] = 'Ungültige Kartennummer';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_VALID_TO'] = 'Ungültige Angabe';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_VALID_FROM'] = 'Ungültige Angabe';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_ISSUE_NUMBER'] = '';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_CHECKCODE'] = 'Ungültige Prüfziffer';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_CARD_TYPE'] = 'Ungültiger Kartentyp';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_CREDIT_CARD_DATA'] = 'Ungültige Kreditkartendaten';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_MISSING_CARDHOLDER'] = 'Dieses Feld darf nicht leer sein.';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_ACCOUNT_NUMBER'] = 'Ungültige Kontonummer';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_BANK_CODE'] = 'Ungültige BLZ';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_IBAN'] = 'Ungültige IBAN';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_COUNTRY'] = 'Ungültiges Land';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_BIC'] = 'Ungültige BIC';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_BANK'] = 'Ungültiges Bankinstitut';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_MISSING_BRANCH_CODE'] = 'Dieses Feld darf nicht leer sein.';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_BRANCH_CODE'] = 'Ungültiger Branch Code';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_MISSING_CHECKCODE'] = 'Dieses Feld darf nicht leer sein.';
$lang['de_DE']['SilvercartPaymentIPayment']['ERROR_INVALID_CELLPHONE'] = 'Ungültige Mobiltelefonnummer';
$lang['de_DE']['SilvercartPaymentIPayment']['INFOTEXT_CHECKOUT'] = 'Zahlung über iPayment';
$lang['de_DE']['SilvercartPaymentIPayment']['IPAYMENT_API'] = 'iPayment API';
$lang['de_DE']['SilvercartPaymentIPayment']['NAME'] = 'iPayment';
$lang['de_DE']['SilvercartPaymentIPayment']['ORDER_CONFIRMATION_SUBMIT_BUTTON_TITLE'] = 'Weiter zur Bezahlung';
$lang['de_DE']['SilvercartPaymentIPayment']['ORDERSTATUS_PAYED'] = 'Bestellstatus für Meldung "bezahlt"';
$lang['de_DE']['SilvercartPaymentIPayment']['ORDERSTATUS_CANCELED'] = 'Bestellstatus für Meldung "abgebrochen"';
$lang['de_DE']['SilvercartPaymentIPayment']['ORDERSTATUS_ERROR'] = 'Bestellstatus für Meldung "Fehler"';
$lang['de_DE']['SilvercartPaymentIPayment']['PASSWORD'] = 'Anwendungspasswort';
$lang['de_DE']['SilvercartPaymentIPayment']['PASSWORD_ADMIN'] = 'Admin-Aktions-Passwort';
$lang['de_DE']['SilvercartPaymentIPayment']['PAYMENT_CHANNEL'] = 'Zahlungsart';
$lang['de_DE']['SilvercartPaymentIPayment']['PAYMENT_CHANNEL_CC'] = 'Kreditkarte / Debitkarte (iPayment)';
$lang['de_DE']['SilvercartPaymentIPayment']['PAYMENT_CHANNEL_ELV'] = 'Lastschrift (iPayment)';
$lang['de_DE']['SilvercartPaymentIPayment']['PAYMENT_CHANNEL_PP'] = 'PaySafeCard (iPayment)';
$lang['de_DE']['SilvercartPaymentIPayment']['PLURALNAME'] = 'Bezahlarten';
$lang['de_DE']['SilvercartPaymentIPayment']['SERVER_IPS'] = 'IP-Adressen der iPayment Server (separiert durch Komma)';
$lang['de_DE']['SilvercartPaymentIPayment']['SINGULARNAME'] = 'Bezahlart';
$lang['de_DE']['SilvercartPaymentIPayment']['SOAP_URL'] = 'URL zur iPayment SOAP Service WSDL';
$lang['de_DE']['SilvercartPaymentIPayment']['TITLE'] = 'iPayment';
$lang['de_DE']['SilvercartPaymentIPayment']['USER_ID'] = 'Anwendungs-ID';

$lang['de_DE']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['ADDR_NAME'] = 'Karteninhaber';
$lang['de_DE']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_CHECKCODE'] = 'Prüfziffer';
$lang['de_DE']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_CHECKCODE_HINT'] = 'Die letzten 3 Ziffern auf der Rückseite Ihrer Kreditkarte. (Amex: 4 Ziffern auf der Vorderseite)';
$lang['de_DE']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_DATA'] = 'Ihre Kreditkartendaten';
$lang['de_DE']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_EXPDATE_MONTH'] = 'Ablaufdatum';
$lang['de_DE']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_EXPDATE_YEAR'] = 'Ablaufdatum';
$lang['de_DE']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_EXPDATE_HINT'] = 'Das Ablaufdatum der Kreditkarte auf der Vorderseite.';
$lang['de_DE']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_NUMBER'] = 'Kartennummer';
$lang['de_DE']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_NUMBER_HINT'] = 'Die 16 Ziffern auf der Vorderseite Ihrer Kreditkarte.';
$lang['de_DE']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CONFIRM'] = 'Zahlung bestätigen und Bestellung abschließen';
$lang['de_DE']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['TITLE'] = 'Kreditkartendaten';
$lang['de_DE']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['SECURITY_HINT'] = 'Ihre Kreditkartendaten werden <strong>SSL-verschlüsselt</strong> an einen sicheren iPayment Server übertragen. Ihre Kreditkartendaten werden <strong>nicht</strong> auf unseren Servern gespeichert.';

$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['ADDR_NAME'] = 'Kontoinhaber';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_ACCOUNTNUMBER'] = 'Kontonummer';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_DATA'] = 'Ihre Bankdaten';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_BIC'] = 'BIC';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_BIC_HINT'] = 'Bank Interchange Code - optional. Kann angegeben werden, wenn IBAN angegeben wurde.';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_CODE'] = 'Bankleitzahl';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_COUNTRY'] = 'Land';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_IBAN'] = 'IBAN';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_IBAN_HINT'] = 'International Bank Account Number - optional. Wenn angegeben, müssen keine weiteren Bankdaten angegeben werden.';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_NAME'] = 'Bankinstitut';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_NAME_HINT'] = 'Optional. Wird in den meisten Fällen automatisch ermittelt.';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['CONFIRM'] = 'Zahlung bestätigen und Bestellung abschließen';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['SECURITY_HINT'] = 'Ihre Bankdaten werden <strong>SSL-verschlüsselt</strong> an einen sicheren iPayment Server übertragen. Ihre Bankdaten werden <strong>nicht</strong> auf unseren Servern gespeichert.';
$lang['de_DE']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['TITLE'] = 'Bankdaten';

$lang['de_DE']['SilvercartPaymentIPaymentNotification']['PLURALNAME'] = 'Zahlungsbenachrichtigungen';
$lang['de_DE']['SilvercartPaymentIPaymentNotification']['SINGULARNAME'] = 'Zahlungsbenachrichtigung';

$lang['de_DE']['SilvercartPaymentIPaymentOrder']['PLURALNAME'] = 'iPayment Bestellungen';
$lang['de_DE']['SilvercartPaymentIPaymentOrder']['SINGULARNAME'] = 'iPayment Bestellung';