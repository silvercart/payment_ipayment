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
 * @package Silvercart
 * @subpackage Payment
 */

/**
 * iPayment payment modul
 *
 * @package Silvercart
 * @subpackage Payment
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @copyright 2011 pixeltricks GmbH
 * @since 29.03.2011
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class SilvercartPaymentIPayment extends SilvercartPaymentMethod {

    /**
     * Indicates whether a payment module has multiple payment channels or not.
     *
     * @var bool
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 29.03.2011
     */
    public static $has_multiple_payment_channels = true;

    /**
     * A list of possible payment channels.
     *
     * @var array
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 29.03.2011
     */
    public static $possible_payment_channels = array(
        'cc' => 'Credit Card / Debit Card (iPayment)',
        'elv' => 'Direct Debit (iPayment)',
        /**
         * PaySafeCard is not ready to use yet.
         */
        //'pp' => 'PaySafeCard',
    );

    protected $trx_type_mapping = array(
        'cc' => 'auth',
        'elv' => 'auth',
        'pp' => 'auth',
    );
    
    /**
     * iPayment session lifetime in seconds
     *
     * @var int
     */
    protected $sessionLifeTime = 240;

    /**
     * db field definitions
     *
     * @var array
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 29.03.2011
     */
    public static $db = array(
        // Base attributes
        'iPaymentAccountID_Dev' => 'VarChar(255)',
        'iPaymentAccountID_Live' => 'VarChar(255)',
        'iPaymentUserID_Dev' => 'VarChar(255)',
        'iPaymentUserID_Live' => 'VarChar(255)',
        'iPaymentPassword_Dev' => 'VarChar(255)',
        'iPaymentPassword_Live' => 'VarChar(255)',
        'iPaymentAdminPassword_Dev' => 'VarChar(255)',
        'iPaymentAdminPassword_Live' => 'VarChar(255)',
        // API attributes
        'iPaymentServerIPs_Dev' => 'VarChar(255)',
        'iPaymentServerIPs_Live' => 'VarChar(255)',
        'iPaymentSoapServerUrl_Dev' => 'VarChar(255)',
        'iPaymentSoapServerUrl_Live' => 'VarChar(255)',
        'iPaymentApiServerUrl_Dev' => 'VarChar(255)',
        'iPaymentApiServerUrl_Live' => 'VarChar(255)',
        'iPaymentInfotextCheckout' => 'VarChar(255)',
        'PaidOrderStatus' => 'Int',
        'CanceledOrderStatus' => 'Int',
        'ErrorOrderStatus' => 'Int',
        // Payment attributes
        'PaymentChannel' => 'Enum("cc,elv,pp","cc")',
    );

    public static $casting = array(
        'iPaymentAccountID' => 'VarChar(255)',
        'iPaymentUserID' => 'VarChar(255)',
        'iPaymentPassword' => 'VarChar(255)',
        'iPaymentApiServerUrl' => 'VarChar(255)',
        'iPaymentServerIPs' => 'VarChar(255)',
        'iPaymentSoapServerUrl' => 'VarChar(255)',
    );

    /**
     * Default values for iPayment.
     *
     * @var array
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 29.03.2011
     */
    public static $defaults = array(
        'iPaymentAccountID_Dev' => '99999',
        'iPaymentUserID_Dev' => '99999',
        'iPaymentPassword_Dev' => '0',
        'iPaymentServerIPs_Dev' => '212.227.34.218,212.227.34.219,212.227.34.220',
        'iPaymentServerIPs_Live' => '212.227.34.218,212.227.34.219,212.227.34.220',
        'iPaymentSoapServerUrl_Dev' => 'https://ipayment.de/v2/ip_service_v3.php?wsdl',
        'iPaymentSoapServerUrl_Live' => 'https://ipayment.de/v2/ip_service_v3.php?wsdl',
        'iPaymentApiServerUrl_Dev' => 'https://ipayment.de/merchant/99999/processor/2.0/',
        'iPaymentApiServerUrl_Live' => 'https://ipayment.de/merchant/__ACCOUNTID__/processor/2.0/',
    );

    /**
     * define 1:1 relations
     *
     * @var array
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 29.03.2011
     */
    public static $has_one = array(
        'SilvercartHandlingCost' => 'SilvercartHandlingCostIPayment'
    );
    /**
     * contains module name for display in the admin backend
     *
     * @var string
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 29.03.2011
     */
    protected $moduleName = 'IPayment';
    /**
     * contains all strings of the iPayment answer which declare the transaction status false
     *
     * @var array
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 29.03.2011
     */
    public $failedIPaymentStatus = array(
        'ERROR',
    );
    /**
     * contains all strings of the iPayment answer which declare the transaction status true
     *
     * @var array
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 29.03.2011
     */
    public $successIPaymentStatus = array(
        'SUCCESS',
        'REDIRECT',
    );
    public static $errorCodes = array(
        // cc
        5000 => 'MISSING_CARDHOLDER',
        5001 => 'MISMATCHING_CARD_TYPE',
        5002 => 'INVALID_CREDIT_CARD_NUMBER',
        5003 => 'INVALID_VALID_TO',
        5004 => 'INVALID_VALID_FROM',
        5005 => 'INVALID_ISSUE_NUMBER',
        5006 => 'INVALID_CHECKCODE',
        5007 => 'INVALID_CARD_TYPE',
        5008 => 'INVALID_CREDIT_CARD_DATA',
        5009 => 'MISSING_CARDHOLDER',
        // elv
        5010 => 'INVALID_ACCOUNT_NUMBER',
        5011 => 'INVALID_BANK_CODE',
        5012 => 'INVALID_IBAN',
        5013 => 'INVALID_COUNTRY',
        5014 => 'INVALID_COUNTRY',
        5015 => 'INVALID_BIC',
        5016 => 'INVALID_BANK',
        5017 => 'MISSING_BRANCH_CODE',
        5018 => 'INVALID_BRANCH_CODE',
        5019 => 'MISSING_CHECKCODE',
        5020 => 'INVALID_CELLPHONE',
        5021 => 'INVALID_CHECKCODE',
    );

    /**
     * Creates and relates required order status
     * 
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 21.04.2011
     */
    public function  requireDefaultRecords() {
        parent::requireDefaultRecords();

        $requiredStatus = array(
            'payed'             => _t('SilvercartOrderStatus.PAYED', 'payed'),
            'ipayment_canceled' => _t('SilvercartOrderStatus.IPAYMENT_CANCELED', 'iPayment canceled'),
            'ipayment_error'    => _t('SilvercartOrderStatus.IPAYMENT_ERROR', 'iPayment error'),
        );
        
        $paymentLogos = array(
            'cc' => array(
                'American Express'  => '/silvercart_payment_ipayment/images/american-express.png',
                'MasterCard'        => '/silvercart_payment_ipayment/images/mastercard.png',
                'VISA'              => '/silvercart_payment_ipayment/images/visa.png',
            ),
        );

        foreach ($requiredStatus as $code => $title) {
            if (!DataObject::get_one('SilvercartOrderStatus', sprintf("`Code`='%s'", $code))) {
                $silvercartOrderStatus = new SilvercartOrderStatus();
                $silvercartOrderStatus->Title = $title;
                $silvercartOrderStatus->Code = $code;
                $silvercartOrderStatus->write();
            }
        }
        
        $upladsFolder = DataObject::get_one('Folder', "`Name`='Uploads'");
        if (!$upladsFolder) {
            $upladsFolder = new Folder();
            $upladsFolder->Name = 'Uploads';
            $upladsFolder->Title = 'Uploads';
            $upladsFolder->Filename = 'assets/Uploads/';
            $upladsFolder->write();
        }
        // check, whether images exist
        foreach ($paymentLogos as $paymentChannel => $logos) {
            $paymentChannelMethod = DataObject::get_one('SilvercartPaymentIPayment', sprintf("`PaymentChannel`='%s'", $paymentChannel));
            if ($paymentChannelMethod) {
                if ($paymentChannelMethod->PaymentLogos()->Count() == 0 && $paymentChannelMethod->showPaymentLogos) {
                    foreach ($logos as $title => $logo) {
                        $paymentLogo = new SilvercartImage();
                        $paymentLogo->Title = $title;
                        $storedLogo = DataObject::get_one('Image', sprintf("`Name`='%s'", basename($logo)));
                        if ($storedLogo) {
                            $paymentLogo->ImageID = $storedLogo->ID;
                        } else {
                            file_put_contents(Director::baseFolder() . '/' . $upladsFolder->Filename . basename($logo), file_get_contents(Director::baseFolder() . $logo));
                            $image = new Image();
                            $image->setFilename($upladsFolder->Filename . basename($logo));
                            $image->setName(basename($logo));
                            $image->Title = basename($logo, '.png');
                            $image->ParentID = $upladsFolder->ID;
                            $image->write();
                            $paymentLogo->ImageID = $image->ID;
                        }
                        $paymentLogo->write();
                        $paymentChannelMethod->PaymentLogos()->add($paymentLogo);
                    }
                }
            }
        }

        $iPaymentPayments = DataObject::get('SilvercartPaymentIPayment', "`PaidOrderStatus`=0");
        if ($iPaymentPayments) {
            foreach ($iPaymentPayments as $iPaymentPayment) {
                $iPaymentPayment->PaidOrderStatus       = DataObject::get_one('SilvercartOrderStatus', "`Code`='payed'")->ID;
                $iPaymentPayment->CanceledOrderStatus   = DataObject::get_one('SilvercartOrderStatus', "`Code`='ipayment_canceled'")->ID;
                $iPaymentPayment->ErrorOrderStatus      = DataObject::get_one('SilvercartOrderStatus', "`Code`='ipayment_error'")->ID;
                $iPaymentPayment->write();
            }
        }
    }

    /**
     * i18n for field labels
     *
     * @param boolean $includerelations a boolean value to indicate if the labels returned include relation fields
     *
     * @return array
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 29.03.2011
     */
    public function fieldLabels($includerelations = true) {
        return array_merge(
                parent::fieldLabels($includerelations),
                array(
                    // Base attributes
                    'iPaymentAccountID_Dev'         => _t('SilvercartPaymentIPayment.ACCOUNT_ID', 'Account ID'),
                    'iPaymentAccountID_Live'        => _t('SilvercartPaymentIPayment.ACCOUNT_ID', 'Account ID'),
                    'iPaymentUserID_Dev'            => _t('SilvercartPaymentIPayment.USER_ID', 'User ID'),
                    'iPaymentUserID_Live'           => _t('SilvercartPaymentIPayment.USER_ID', 'User ID'),
                    'iPaymentPassword_Dev'          => _t('SilvercartPaymentIPayment.PASSWORD', 'Password'),
                    'iPaymentPassword_Live'         => _t('SilvercartPaymentIPayment.PASSWORD', 'Password'),
                    'iPaymentAdminPassword_Dev'     => _t('SilvercartPaymentIPayment.PASSWORD_ADMIN', 'Admin password'),
                    'iPaymentAdminPassword_Live'    => _t('SilvercartPaymentIPayment.PASSWORD_ADMIN', 'Admin password'),
                    // API attributes
                    'iPaymentServerIPs_Dev'         => _t('SilvercartPaymentIPayment.SERVER_IPS', 'Server IPs'),
                    'iPaymentServerIPs_Live'        => _t('SilvercartPaymentIPayment.SERVER_IPS', 'Server IPs'),
                    'iPaymentSoapServerUrl_Dev'     => _t('SilvercartPaymentIPayment.SOAP_URL', 'URL to the iPayment SOAP service WSDL'),
                    'iPaymentSoapServerUrl_Live'    => _t('SilvercartPaymentIPayment.SOAP_URL', 'URL to the iPayment SOAP service WSDL'),
                    'iPaymentApiServerUrl_Dev'      => _t('SilvercartPaymentIPayment.API_URL', 'URL to the iPayment checkout'),
                    'iPaymentApiServerUrl_Live'     => _t('SilvercartPaymentIPayment.API_URL', 'URL to the iPayment checkout'),
                    'iPaymentInfotextCheckout'      => _t('SilvercartPaymentIPayment.INFOTEXT_CHECKOUT', 'payment via iPayment'),
                    'PaidOrderStatus'               => _t('SilvercartPaymentIPayment.ORDERSTATUS_PAYED', 'orderstatus for notification "payed"'),
                    'CanceledOrderStatus'           => _t('SilvercartPaymentIPayment.ORDERSTATUS_CANCELED', 'orderstatus for notification "canceled"'),
                    'ErrorOrderStatus'              => _t('SilvercartPaymentIPayment.ORDERSTATUS_ERROR', 'orderstatus for notification "error"'),
                )
        );
    }

    /**
     * returns CMS fields
     *
     * @param mixed $params optional
     *
     * @return FieldSet
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 29.03.2011
     */
    public function getCMSFields($params = null) {
        $fields = parent::getCMSFieldsForModules($params);

        // Add fields to default tab ------------------------------------------
        $channelField = new ReadonlyField('DisplayPaymentChannel', _t('SilvercartPaymentIPayment.PAYMENT_CHANNEL'), $this->getPaymentChannelName($this->PaymentChannel));

        $fields->addFieldToTab('Sections.Basic', $channelField, 'isActive');

        // Additional tabs and fields -----------------------------------------
        $tabApi = new Tab('iPaymentAPI', _t('SilvercartPaymentIPayment.IPAYMENT_API', 'iPayment API'));
        $tabOrderStatus = new Tab('OrderStatus', _t('SilvercartPaymentIPayment.ATTRIBUTED_ORDERSTATUS', 'attributed order status'));

        $fields->fieldByName('Sections')->push($tabApi);
        $fields->fieldByName('Sections')->push($tabOrderStatus);

        // API Tabset ---------------------------------------------------------
        $tabApiTabset = new TabSet('APIOptions');
        $tabApiTabDev = new Tab(_t('SilvercartPaymentIPayment.API_DEVELOPMENT_MODE', 'API development mode'));
        $tabApiTabLive = new Tab(_t('SilvercartPaymentIPayment.API_LIVE_MODE', 'API live mode'));

        // API Tabs -----------------------------------------------------------
        $tabApiTabset->push($tabApiTabDev);
        $tabApiTabset->push($tabApiTabLive);

        $tabApi->push($tabApiTabset);

        // API Tab Dev fields -------------------------------------------------
        $tabApiTabDev->setChildren(
                new FieldSet(
                        new TextField('iPaymentAccountID_Dev', _t('SilvercartPaymentIPayment.ACCOUNT_ID')),
                        new TextField('iPaymentUserID_Dev', _t('SilvercartPaymentIPayment.USER_ID')),
                        new TextField('iPaymentPassword_Dev', _t('SilvercartPaymentIPayment.PASSWORD')),
                        new TextField('iPaymentAdminPassword_Dev', _t('SilvercartPaymentIPayment.PASSWORD_ADMIN')),
                        new TextField('iPaymentServerIPs_Dev', _t('SilvercartPaymentIPayment.SERVER_IPS')),
                        new TextField('iPaymentSoapServerUrl_Dev', _t('SilvercartPaymentIPayment.SOAP_URL')),
                        new TextField('iPaymentApiServerUrl_Dev', _t('SilvercartPaymentIPayment.API_URL'))
                )
        );

        // API Tab Live fields ------------------------------------------------
        $tabApiTabLive->setChildren(
                new FieldSet(
                        new TextField('iPaymentAccountID_Live', _t('SilvercartPaymentIPayment.ACCOUNT_ID')),
                        new TextField('iPaymentUserID_Live', _t('SilvercartPaymentIPayment.USER_ID')),
                        new TextField('iPaymentPassword_Live', _t('SilvercartPaymentIPayment.PASSWORD')),
                        new TextField('iPaymentAdminPassword_Live', _t('SilvercartPaymentIPayment.PASSWORD_ADMIN')),
                        new TextField('iPaymentServerIPs_Live', _t('SilvercartPaymentIPayment.SERVER_IPS')),
                        new TextField('iPaymentSoapServerUrl_Live', _t('SilvercartPaymentIPayment.SOAP_URL')),
                        new TextField('iPaymentApiServerUrl_Live', _t('SilvercartPaymentIPayment.API_URL'))
                )
        );

        // Bestellstatus Tab fields -------------------------------------------
        $OrderStatus = DataObject::get('SilvercartOrderStatus');
        $tabOrderStatus->setChildren(
                new FieldSet(
                        new DropdownField('PaidOrderStatus', _t('SilvercartPaymentIPayment.ORDERSTATUS_PAYED'), $OrderStatus->map('ID', 'Title'), $this->PaidOrderStatus),
                        new DropdownField('CanceledOrderStatus', _t('SilvercartPaymentIPayment.ORDERSTATUS_CANCELED'), $OrderStatus->map('ID', 'Title'), $this->CanceledOrderStatus),
                        new DropdownField('ErrorOrderStatus', _t('SilvercartPaymentIPayment.ORDERSTATUS_ERROR'), $OrderStatus->map('ID', 'Title'), $this->ErrorOrderStatus)
                )
        );

        return $fields;
    }

    /**
     * Returns iPayments API URL dependent on the actual mode (Live/Dev)
     *
     * @return string
     */
    public function getiPaymentApiServerUrl() {
        if ($this->mode == 'Live') {
            $apiUrl = $this->iPaymentApiServerUrl_Live;
        } else {
            $apiUrl = $this->iPaymentApiServerUrl_Dev;
        }
        return $apiUrl;
    }

    /**
     * Returns the iPayment password dependent on the actual mode (Live/Dev)
     *
     * @return string
     */
    public function getiPaymentPassword() {
        if ($this->mode == 'Live') {
            $password = $this->iPaymentPassword_Live;
        } else {
            $password = $this->iPaymentPassword_Dev;
        }
        return $password;
    }

    /**
     * Returns the iPayment account ID dependent on the actual mode (Live/Dev)
     *
     * @return string
     */
    public function getiPaymentAccountID() {
        if ($this->mode == 'Live') {
            $accountId = $this->iPaymentAccountID_Live;
        } else {
            $accountId = $this->iPaymentAccountID_Dev;
        }
        return $accountId;
    }

    /**
     * Returns the iPayment user ID dependent on the actual mode (Live/Dev)
     *
     * @return string
     */
    public function getiPaymentUserID() {
        if ($this->mode == 'Live') {
            $userId = $this->iPaymentUserID_Live;
        } else {
            $userId = $this->iPaymentUserID_Dev;
        }
        return $userId;
    }

    /**
     * Returns the iPayment SOAP server URL dependent on the actual mode (Live/Dev)
     *
     * @return string
     */
    public function getiPaymentSoapServerUrl() {
        if ($this->mode == 'Live') {
            $soapServerUrl = $this->iPaymentSoapServerUrl_Live;
        } else {
            $soapServerUrl = $this->iPaymentSoapServerUrl_Dev;
        }
        return $soapServerUrl;
    }

    /**
     * Returns the iPayment server IPs dependent on the actual mode (Live/Dev)
     *
     * @return string
     */
    public function getiPaymentServerIPs() {
        if ($this->mode == 'Live') {
            $serverIPs = $this->iPaymentServerIPs_Live;
        } else {
            $serverIPs = $this->iPaymentServerIPs_Dev;
        }
        return $serverIPs;
    }

    // ------------------------------------------------------------------------
    // processing methods
    // ------------------------------------------------------------------------

    /**
     * returns an error message depending on the error code.
     *
     * @param string $errorCode Errorcode
     *
     * @return string
     */
    public function getErrorMessage($errorCode) {
        if (array_key_exists($errorCode, self::$errorCodes)) {
            $identifier = self::$errorCodes[$errorCode];
        } else {
            $identifier = 'DEFAULT';
        }
        return _t('SilvercartPaymentIPayment.ERROR_' . $identifier);
    }

    /**
     * Returns the iPayment session ID. If the session ID doesn't exists, it will
     * be created.
     *
     * @return string
     */
    public function getSessionId() {
        if (!Session::get('ipayment_session_id') || $this->SessionExpired()) {
            $this->createSessionId();
        }
        return Session::get('ipayment_session_id');
    }
    
    /**
     * Checks, whether the iPAyment Session is expired or not.
     *
     * @return bool
     * 
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 27.04.2011
     */
    public function SessionExpired() {
        if (!Session::get('ipayment_session_created')) {
            return true;
        } elseif (Session::get('ipayment_session_created') + $this->sessionLifeTime < time()) {
            return true;
        }
        return false;
    }

    /**
     * Removes the actual iPayment session ID from session and creates a new one.
     *
     * @return string
     * 
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 11.04.2011
     */
    public function refreshSessionId() {
        $this->clearSessionId();
        return $this->getSessionId();
    }

    /**
     * removes the iPayment session ID. Normally used after a successful transmission.
     * 
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 11.04.2011
     */
    public function clearSessionId() {
        Session::clear('ipayment_session_id');
        Session::save();
    }

    /**
     * Creates the iPayment Session ID
     *
     * @return string|boolean false
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 30.03.2011
     */
    protected function createSessionId() {
        $iPaymentSessionID = false;
        $accountId      = $this->iPaymentAccountID;
        $userId         = $this->iPaymentUserID;
        $password       = $this->iPaymentPassword;
        $apiUrl         = $this->iPaymentSoapServerUrl;
        $amount         = (string) ((float) $this->getShoppingCart()->getAmountTotal()->getAmount() * 100);
        $currency       = $this->getShoppingCart()->getAmountTotal()->getCurrency();
        $transactionId  = SilvercartNumberRange::reserveNewNumberByIdentifier('OrderNumber');

        // iPayment SOAP-call
        $soapClient = new SoapClient($apiUrl, array('trace' => 1));

        try {
            $iPaymentSessionID = $soapClient->createSession(
                array(
                    'accountId'         => $accountId,
                    'trxuserId'         => $userId,
                    'trxpassword'       => $password,
                ),
                array(
                    'trxAmount'         => $amount,
                    'trxCurrency'       => $currency,
                    'shopperId'         => $transactionId
                ),
                $this->trx_type_mapping[$this->PaymentChannel],
                $this->PaymentChannel,
                array(
                    'fromIp'            => $_SERVER['REMOTE_ADDR'],
                    'client_name'       => 'SilverCart',
                    'client_version'    => SilvercartConfig::getConfig()->SilvercartVersion,
                ),
                array(
                    'redirectUrl'       => $this->getReturnLink(),
                    'hiddenTriggerUrl'  => $this->getHiddenTriggerLink(),
                    'silentErrorUrl'    => $this->getCancelLink(),
                )
            );
            $this->saveIPaymentSessionID($iPaymentSessionID);
            $this->Log('createSessionId', 'create session ' . $iPaymentSessionID . ' for transaction ' . $transactionId);
            $this->createIPaymentOrder(
                    $transactionId,
                    array(
                        'trx_amount'    => $amount,
                        'trx_currency'  => $currency,
                        'shopper_id'    => $transactionId
                    )
            );
        } catch(SoapFault $e) {
            $this->Log('createSessionId', $e->getMessage());
            $this->Log('createSessionId', var_export($soapClient->__getLastRequest(), true));
            $this->errorOccured = true;
            $this->addError(_t('SilvercartPaymentIPayment.ERROR_SESSION'));
        }
        return $iPaymentSessionID;
    }

    /**
     * Saves the iPayment session ID to the session.
     *
     * @param string $iPaymentSessionID iPayment session ID
     *
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 30.03.2011
     */
    protected function saveIPaymentSessionID($iPaymentSessionID) {
        Session::set('ipayment_session_created', time());
        Session::set('ipayment_session_id', $iPaymentSessionID);
        Session::save();
    }

    /**
     * Returns the hidden trigger link.
     *
     * @return string
     */
    public function getHiddenTriggerLink() {
        return Director::absoluteBaseURL() . substr(Controller::curr()->PageByIdentifierCodeLink('SilvercartPaymentNotification'), 1) . 'process/' . $this->moduleName . '/' . $this->PaymentChannel;
    }

    /**
     * Creates a new iPaymentOrder if not exists.
     *
     * @param string $transactionId The payment reference for iPayment
     * @param string $data          Additional transaction information
     * 
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 11.04.2011
     */
    public function createIPaymentOrder($transactionId, $data = array()) {
        if (!DataObject::get_one('SilvercartPaymentIPaymentOrder', sprintf("`shopper_id`='%s'", $transactionId))) {
            $iPaymentOrder = new SilvercartPaymentIPaymentOrder();
            $iPaymentOrder->MemberID = Member::currentUserID();
            $iPaymentOrder->update($data);
            $iPaymentOrder->write();
        }
    }

    /**
     * Set the title for the submit button on the order confirmation step.
     *
     * @return string
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 11.04.2011
     */
    public function getOrderConfirmationSubmitButtonTitle() {
        return _t('SilvercartPaymentIPayment.ORDER_CONFIRMATION_SUBMIT_BUTTON_TITLE');
    }

}
