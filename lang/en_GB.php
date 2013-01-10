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
 * English (GB) language pack
 *
 * @package Silvercart
 * @subpackage i18n
 * @ignore
 */

i18n::include_locale_file('silvercart_payment_ipayment', 'en_US');

global $lang;

if (array_key_exists('en_GB', $lang) && is_array($lang['en_GB'])) {
    $lang['en_GB'] = array_merge($lang['en_US'], $lang['en_GB']);
} else {
    $lang['en_GB'] = $lang['en_US'];
}

$lang['en_GB']['SilvercartHandlingCostIPayment']['PLURALNAME'] = 'Handling Costs';
$lang['en_GB']['SilvercartHandlingCostIPayment']['SINGULARNAME'] = 'Handling Cost';

$lang['en_GB']['SilvercartOrderStatus']['IPAYMENT_CANCELED'] = 'iPayment canceled';
$lang['en_GB']['SilvercartOrderStatus']['IPAYMENT_ERROR'] = 'iPayment error';
$lang['en_GB']['SilvercartOrderStatus']['IPAYMENT_PREAUTH'] = 'payment authorized';

$lang['en_GB']['SilvercartPaymentIPayment']['ACCOUNT_ID'] = 'Account ID';
$lang['en_GB']['SilvercartPaymentIPayment']['API_URL'] = 'URL to iPayment Silent CGI Checkout';
$lang['en_GB']['SilvercartPaymentIPayment']['API_DEVELOPMENT_MODE'] = 'API development mode';
$lang['en_GB']['SilvercartPaymentIPayment']['API_LIVE_MODE'] = 'API live mode';
$lang['en_GB']['SilvercartPaymentIPayment']['ATTRIBUTED_ORDERSTATUS'] = 'Attributed order status';
$lang['en_GB']['SilvercartPaymentIPayment']['CAPTURE_TRANSACTION_ON_ORDER_STATUS_CHANGE'] = 'Capture payment on order status change (if not set, the payment will be captured on order end)';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_SESSION'] = 'An error occured by trying to connect to iPayment. Please try again. If this error repeats, please contact us.';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_DEFAULT'] = 'An error occured. Please excuse the delay and try again. If this error repeats, please contact us or choose a different payment method.';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_MISSING_CARDHOLDER'] = 'This field cannot be empty.';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_MISMATCHING_CARD_TYPE'] = 'Mismatching card type';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_CREDIT_CARD_NUMBER'] = 'Invalid credit card number';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_VALID_TO'] = 'Invalid expiration date';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_VALID_FROM'] = 'Invalid expiration date';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_ISSUE_NUMBER'] = '';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_CHECKCODE'] = 'Invalid checkcode';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_CARD_TYPE'] = 'Invalid card type';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_CREDIT_CARD_DATA'] = 'Invalid credit card data';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_MISSING_CARDHOLDER'] = 'This field cannot be empty.';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_ACCOUNT_NUMBER'] = 'Invalid account number';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_BANK_CODE'] = 'Invalid bank code';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_IBAN'] = 'Invalid IBAN';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_COUNTRY'] = 'Invalid country';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_BIC'] = 'Invalid BIC';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_BANK'] = 'Invalid Bank';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_MISSING_BRANCH_CODE'] = 'This field cannot be empty.';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_BRANCH_CODE'] = 'Invalid branch code';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_MISSING_CHECKCODE'] = 'This field cannot be empty.';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_INVALID_CELLPHONE'] = 'Invalid cell phone';
$lang['en_GB']['SilvercartPaymentIPayment']['ERROR_CAPTURE'] = 'Capturing of the payment failed';
$lang['en_GB']['SilvercartPaymentIPayment']['INFOTEXT_CHECKOUT'] = 'Payment via iPayment';
$lang['en_GB']['SilvercartPaymentIPayment']['IPAYMENT_API'] = 'iPayment API';
$lang['en_GB']['SilvercartPaymentIPayment']['NAME'] = 'iPayment';
$lang['en_GB']['SilvercartPaymentIPayment']['ORDER_CONFIRMATION_SUBMIT_BUTTON_TITLE'] = 'Proceed to payment';
$lang['en_GB']['SilvercartPaymentIPayment']['ORDERSTATUS_PAYED'] = 'Order status "payed"';
$lang['en_GB']['SilvercartPaymentIPayment']['ORDERSTATUS_PREAUTH'] = 'Order status "payment preauth"';
$lang['en_GB']['SilvercartPaymentIPayment']['ORDERSTATUS_CANCELED'] = 'Order status "canceled"';
$lang['en_GB']['SilvercartPaymentIPayment']['ORDERSTATUS_ERROR'] = 'Order status "error"';
$lang['en_GB']['SilvercartPaymentIPayment']['ORDERSTATUS_CAPTURE'] = 'Order status to capture payment';
$lang['en_GB']['SilvercartPaymentIPayment']['PASSWORD'] = 'Password';
$lang['en_GB']['SilvercartPaymentIPayment']['PASSWORD_ADMIN'] = 'Administrative Password';
$lang['en_GB']['SilvercartPaymentIPayment']['PAYMENT_CHANNEL'] = 'Payment Channel';
$lang['en_GB']['SilvercartPaymentIPayment']['PAYMENT_CHANNEL_CC'] = 'Credit Card / Debit Card (iPayment)';
$lang['en_GB']['SilvercartPaymentIPayment']['PAYMENT_CHANNEL_ELV'] = 'Direct Debit (iPayment)';
$lang['en_GB']['SilvercartPaymentIPayment']['PAYMENT_CHANNEL_PP'] = 'PaySafeCard (iPayment)';
$lang['en_GB']['SilvercartPaymentIPayment']['PLURALNAME'] = 'payment methods';
$lang['en_GB']['SilvercartPaymentIPayment']['SERVER_IPS'] = 'IP-Addresses of the iPayment server (separated with comma)';
$lang['en_GB']['SilvercartPaymentIPayment']['SINGULARNAME'] = 'payment method';
$lang['en_GB']['SilvercartPaymentIPayment']['SOAP_URL'] = 'URL of the iPayment SOAP Service WSDL';
$lang['en_GB']['SilvercartPaymentIPayment']['TITLE'] = 'iPayment';
$lang['en_GB']['SilvercartPaymentIPayment']['USER_ID'] = 'User ID';
$lang['en_GB']['SilvercartPaymentIPayment']['USETRANSACTIONIDASINVOICETEXT'] = 'Use TransactionID (Order number) as invoice text';

$lang['en_GB']['SilvercartPaymentIPaymentLanguage']['SINGULARNAME'] = 'Translation of the payment method iPayment';
$lang['en_GB']['SilvercartPaymentIPaymentLanguage']['PLURALNAME'] = 'Translations of the payment method iPayment';

$lang['en_GB']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['ADDR_NAME'] = 'Cardholder';
$lang['en_GB']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_CHECKCODE'] = 'Checkcode';
$lang['en_GB']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_CHECKCODE_HINT'] = 'The last 3 digits on the back of your credit card. (Amex: 4 digits in front)';
$lang['en_GB']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_DATA'] = 'Your credit card data';
$lang['en_GB']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_EXPDATE_MONTH'] = 'Expiration Date';
$lang['en_GB']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_EXPDATE_YEAR'] = 'Expiration Date';
$lang['en_GB']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_EXPDATE_HINT'] = 'The date your credit card expires. Find this in front of your credit card.';
$lang['en_GB']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_NUMBER'] = 'Cardnumber';
$lang['en_GB']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CC_NUMBER_HINT'] = 'The 16 digits on the front of your credit card.';
$lang['en_GB']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['CONFIRM'] = 'Confirm payment and order now';
$lang['en_GB']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['TITLE'] = 'Credit Card Data';
$lang['en_GB']['SilvercartPaymentIPaymentCcCheckoutFormStep1']['SECURITY_HINT'] = 'Your credit card data will be send to a secure iPayment server <strong>SSL encrypted</strong>. Your credit card data will <strong>not</strong> be saved on our servers.';

$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['ADDR_NAME'] = 'Account Holder';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_ACCOUNTNUMBER'] = 'Account Number';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_DATA'] = 'Your Bankdata';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_BIC'] = 'BIC';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_BIC_HINT'] = 'Bank Interchange Code - optional. Can be set, if IBAN is set.';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_CODE'] = 'Bank Code';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_COUNTRY'] = 'Country';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_IBAN'] = 'IBAN';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_IBAN_HINT'] = 'International Bank Account Number - optional. If set, no additional bank data has to be set.';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_NAME'] = 'Bank Name';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['BANK_NAME_HINT'] = 'Optional. Will be detected automatically in most cases.';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['CONFIRM'] = 'Confirm payment and order now';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['SECURITY_HINT'] = 'Your credit card data will be send to a secure iPayment server <strong>SSL encrypted</strong>. Your credit card data will <strong>not</strong> be saved on our servers.';
$lang['en_GB']['SilvercartPaymentIPaymentElvCheckoutFormStep1']['TITLE'] = 'Bankdata';

$lang['en_GB']['SilvercartPaymentIPaymentNotification']['PLURALNAME'] = 'Silvercart iPayment Notifications';
$lang['en_GB']['SilvercartPaymentIPaymentNotification']['SINGULARNAME'] = 'Silvercart iPayment Notification';

$lang['en_GB']['SilvercartPaymentIPaymentOrder']['PLURALNAME'] = 'Silvercart iPayment Orders';
$lang['en_GB']['SilvercartPaymentIPaymentOrder']['SINGULARNAME'] = 'Silvercart iPayment Orders';