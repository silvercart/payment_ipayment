<?php
/**
 * Copyright 2012 pixeltricks GmbH
 *
 * This file is part of SilvercartPrepaymentPayment.
 *
 * SilvercartPaypalPayment is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SilvercartPrepaymentPayment is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with SilvercartPrepaymentPayment.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Russian language pack
 *
 * @package SilvercartPaymentIpayment
 * @subpackage i18n
 * @ignore
 */

global $lang;

$lang['ru_RU']['SilvercartHandlingCostIPayment']['PLURALNAME'] = 'Gebühren';
$lang['ru_RU']['SilvercartHandlingCostIPayment']['SINGULARNAME'] = 'Gebühr';
$lang['ru_RU']['SilvercartOrderStatus']['IPAYMENT_CANCELED'] = 'iPayment abgebrochen';
$lang['ru_RU']['SilvercartOrderStatus']['IPAYMENT_ERROR'] = 'iPayment Fehler';
$lang['ru_RU']['SilvercartOrderStatus']['IPAYMENT_PREAUTH'] = 'Zahlung authorisiert';
$lang['ru_RU']['SilvercartPaymentIPayment']['ACCOUNT_ID'] = 'Account-ID';
$lang['ru_RU']['SilvercartPaymentIPayment']['API_URL'] = 'URL zum iPayment Silent CGI Checkout';
$lang['ru_RU']['SilvercartPaymentIPayment']['API_DEVELOPMENT_MODE'] = 'API Entwicklungsmodus';
$lang['ru_RU']['SilvercartPaymentIPayment']['API_LIVE_MODE'] = 'API Live Modus';
$lang['ru_RU']['SilvercartPaymentIPayment']['ATTRIBUTED_ORDERSTATUS'] = 'Zuordnung Bestellstatus';
$lang['ru_RU']['SilvercartPaymentIPayment']['CAPTURE_TRANSACTION_ON_ORDER_STATUS_CHANGE'] = 'Zahlung bei Änderung des Bestellstatus buchen (wenn nicht gesetzt, wird die Zahlung direkt bei Bestellabschluss gebucht)';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_SESSION'] = 'Bei der Verbindung mit iPayment ist ein Fehler aufgetreten. Bitte entschuldigen Sie die Verzögerung und versuchen Sie es noch einmal. Sollte der Fehler wiederholt auftreten, setzen Sie sich bitte mit uns in Verbindung.';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_DEFAULT'] = 'Es ist ein Fehler aufgetreten. Bitte entschuldigen Sie die Verzögerung und versuchen Sie es noch einmal. Sollte der Fehler wiederholt auftreten, setzen Sie sich bitte mit uns in Verbindung oder wählen Sie eine alternative Zahlart.';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_MISSING_CARDHOLDER'] = 'Dieses Feld darf nicht leer sein.';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_MISMATCHING_CARD_TYPE'] = 'Kartentyp passt nicht zur Nummer';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_CREDIT_CARD_NUMBER'] = 'Ungültige Kartennummer';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_VALID_TO'] = 'Ungültige Angabe';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_VALID_FROM'] = 'Ungültige Angabe';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_ISSUE_NUMBER'] = '';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_CHECKCODE'] = 'Ungültige Prüfziffer';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_CARD_TYPE'] = 'Ungültiger Kartentyp';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_CREDIT_CARD_DATA'] = 'Ungültige Kreditkartendaten';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_ACCOUNT_NUMBER'] = 'Ungültige Kontonummer';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_BANK_CODE'] = 'Ungültige BLZ';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_IBAN'] = 'Ungültige IBAN';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_COUNTRY'] = 'Ungültiges Land';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_BIC'] = 'Ungültige BIC';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_BANK'] = 'Ungültiges Bankinstitut';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_MISSING_BRANCH_CODE'] = 'Dieses Feld darf nicht leer sein.';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_BRANCH_CODE'] = 'Ungültiger Branch Code';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_MISSING_CHECKCODE'] = 'Dieses Feld darf nicht leer sein.';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_INVALID_CELLPHONE'] = 'Ungültige Mobiltelefonnummer';
$lang['ru_RU']['SilvercartPaymentIPayment']['ERROR_CAPTURE'] = 'Das Buchen der Zahlung ist fehlgeschlagen';
$lang['ru_RU']['SilvercartPaymentIPayment']['INFOTEXT_CHECKOUT'] = 'Zahlung über iPayment';
$lang['ru_RU']['SilvercartPaymentIPayment']['IPAYMENT_API'] = 'iPayment API';
$lang['ru_RU']['SilvercartPaymentIPayment']['NAME'] = 'iPayment';
$lang['ru_RU']['SilvercartPaymentIPayment']['ORDER_CONFIRMATION_SUBMIT_BUTTON_TITLE'] = 'Weiter zur Bezahlung';
$lang['ru_RU']['SilvercartPaymentIPayment']['ORDERSTATUS_PAYED'] = 'Bestellstatus für Meldung "bezahlt"';
$lang['ru_RU']['SilvercartPaymentIPayment']['ORDERSTATUS_PREAUTH'] = 'Bestellstatus für Meldung "Zahlung vorauthorisiert"';
$lang['ru_RU']['SilvercartPaymentIPayment']['ORDERSTATUS_CANCELED'] = 'Bestellstatus für Meldung "abgebrochen"';
$lang['ru_RU']['SilvercartPaymentIPayment']['ORDERSTATUS_ERROR'] = 'Bestellstatus für Meldung "Fehler"';
$lang['ru_RU']['SilvercartPaymentIPayment']['ORDERSTATUS_CAPTURE'] = 'Bestellstatus für Zahlungsbuchung';
$lang['ru_RU']['SilvercartPaymentIPayment']['PASSWORD'] = 'Anwendungspasswort';
$lang['ru_RU']['SilvercartPaymentIPayment']['PASSWORD_ADMIN'] = 'Admin-Aktions-Passwort';
$lang['ru_RU']['SilvercartPaymentIPayment']['PAYMENT_CHANNEL'] = 'Zahlungsart';
$lang['ru_RU']['SilvercartPaymentIPayment']['PAYMENT_CHANNEL_CC'] = 'Kreditkarte / Debitkarte (iPayment)';
$lang['ru_RU']['SilvercartPaymentIPayment']['PAYMENT_CHANNEL_ELV'] = 'Lastschrift (iPayment)';
$lang['ru_RU']['SilvercartPaymentIPayment']['PAYMENT_CHANNEL_PP'] = 'PaySafeCard (iPayment)';
$lang['ru_RU']['SilvercartPaymentIPayment']['PLURALNAME'] = 'Bezahlarten';
$lang['ru_RU']['SilvercartPaymentIPayment']['SERVER_IPS'] = 'IP-Adressen der iPayment Server (separiert durch Komma)';
$lang['ru_RU']['SilvercartPaymentIPayment']['SINGULARNAME'] = 'Bezahlart';
$lang['ru_RU']['SilvercartPaymentIPayment']['SOAP_URL'] = 'URL zur iPayment SOAP Service WSDL';
$lang['ru_RU']['SilvercartPaymentIPayment']['TITLE'] = 'iPayment';
$lang['ru_RU']['SilvercartPaymentIPayment']['USER_ID'] = 'Anwendungs-ID';
$lang['ru_RU']['SilvercartPaymentIPaymentLanguage']['SINGULARNAME'] = 'Übersetzung der Zahlart iPayment';
$lang['ru_RU']['SilvercartPaymentIPaymentLanguage']['PLURALNAME'] = 'Übersetzungen der Zahlart iPayment';
$lang['ru_RU']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['ADDR_NAME'] = 'Karteninhaber';
$lang['ru_RU']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_CHECKCODE'] = 'Prüfziffer';
$lang['ru_RU']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_CHECKCODE_HINT'] = 'Die letzten 3 Ziffern auf der Rückseite Ihrer Kreditkarte. (Amex: 4 Ziffern auf der Vorderseite)';
$lang['ru_RU']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_DATA'] = 'Ihre Kreditkartendaten';
$lang['ru_RU']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_EXPDATE_MONTH'] = 'Ablaufdatum';
$lang['ru_RU']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_EXPDATE_YEAR'] = 'Ablaufdatum';
$lang['ru_RU']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_EXPDATE_HINT'] = 'Das Ablaufdatum der Kreditkarte auf der Vorderseite.';
$lang['ru_RU']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_NUMBER'] = 'Kartennummer';
$lang['ru_RU']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_NUMBER_HINT'] = 'Die 16 Ziffern auf der Vorderseite Ihrer Kreditkarte.';
$lang['ru_RU']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CONFIRM'] = 'Zahlung bestätigen und Bestellung abschließen';
$lang['ru_RU']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['TITLE'] = 'Kreditkartendaten';
$lang['ru_RU']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['SECURITY_HINT'] = 'Ihre Kreditkartendaten werden <strong>SSL-verschlüsselt</strong> an einen sicheren iPayment Server übertragen. Ihre Kreditkartendaten werden <strong>nicht</strong> auf unseren Servern gespeichert.';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['ADDR_NAME'] = 'Kontoinhaber';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_ACCOUNTNUMBER'] = 'Kontonummer';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_DATA'] = 'Ihre Bankdaten';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_BIC'] = 'BIC';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_BIC_HINT'] = 'Bank Interchange Code - optional. Kann angegeben werden, wenn IBAN angegeben wurde.';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_CODE'] = 'Bankleitzahl';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_COUNTRY'] = 'Land';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_IBAN'] = 'IBAN';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_IBAN_HINT'] = 'International Bank Account Number - optional. Wenn angegeben, müssen keine weiteren Bankdaten angegeben werden.';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_NAME'] = 'Bankinstitut';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_NAME_HINT'] = 'Optional. Wird in den meisten Fällen automatisch ermittelt.';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['CONFIRM'] = 'Zahlung bestätigen und Bestellung abschließen';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['SECURITY_HINT'] = 'Ihre Bankdaten werden <strong>SSL-verschlüsselt</strong> an einen sicheren iPayment Server übertragen. Ihre Bankdaten werden <strong>nicht</strong> auf unseren Servern gespeichert.';
$lang['ru_RU']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['TITLE'] = 'Bankdaten';
$lang['ru_RU']['SilvercartPaymentIPaymentNotification']['PLURALNAME'] = 'Zahlungsbenachrichtigungen';
$lang['ru_RU']['SilvercartPaymentIPaymentNotification']['SINGULARNAME'] = 'Zahlungsbenachrichtigung';
$lang['ru_RU']['SilvercartPaymentIPaymentOrder']['PLURALNAME'] = 'iPayment Bestellungen';
$lang['ru_RU']['SilvercartPaymentIPaymentOrder']['SINGULARNAME'] = 'iPayment Bestellung';
