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
 * additional information for orders via iPayment
 *
 * @package Silvercart
 * @subpackage Payment
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @copyright 2011 pixeltricks GmbH
 * @since 11.03.2011
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class SilvercartPaymentIPaymentOrder extends DataObject {

    /**
     * attribute definition
     *
     * @var array
     */
    public static $db = array(
        'trxuser_id'                => 'Varchar(255)',
        'trx_amount'                => 'Varchar(255)',
        'trx_currency'              => 'Varchar(255)',
        'shopper_id'                => 'Varchar(255)',
        'trx_typ'                   => 'Varchar(255)',
        'trx_paymenttyp'            => 'Varchar(255)',
        'ret_transdate'             => 'Varchar(255)',
        'ret_transtime'             => 'Varchar(255)',
        'ret_errorcode'             => 'Varchar(255)',
        'ret_authcode'              => 'Varchar(255)',
        'ret_ip'                    => 'Varchar(255)',
        'ret_booknr'                => 'Varchar(255)',
        'ret_trx_number'            => 'Varchar(255)',
        'redirect_needed'           => 'Varchar(255)',
        'trx_paymentmethod'         => 'Varchar(255)',
        'trx_paymentdata_country'   => 'Varchar(255)',
        'trx_remoteip_country'      => 'Varchar(255)',
        'ret_status'                => 'Varchar(255)',
    );

    public static $has_one = array(
        'Member' => 'Member',
    );

    /**
     * register extensions for $this
     *
     * @var array
     */
    public static $extensions = array(
        "Versioned('Live')",
    );
    
    public static $allowedCaptureTypes = array(
        'preauth',
        're_preauth',
    );
    
    public static $allowedReverseTypes = array(
        'preauth',
        're_preauth',
    );
    
    public static $allowedPreAuthorizeTypes = array(
        'preauth',
        're_preauth',
        'reverse',
    );

    /**
     * Related PaymentMethod
     *
     * @var SilvercartPaymentIPayment 
     */
    protected $paymentMethod = null;
    /**
     * SoapClient
     *
     * @var SoapClient 
     */
    protected $soapClient = null;
    /**
     * AccountData for SoapClient
     *
     * @var array
     */
    protected $soapAccountData = null;
    /**
     * TransactionData for SoapClient
     *
     * @var array
     */
    protected $soapTransactionData = null;
    /**
     * Options for SoapClient
     *
     * @var array
     */
    protected $soapOptions = null;
    /**
     * ProcessorUrls for SoapClient
     *
     * @var array
     */
    protected $soapProcessorUrls = null;

    // ------------------------------------------------------------------------
    // SOAP helper methods
    // ------------------------------------------------------------------------

    /**
     * Sets the related PaymentMethod
     *
     * @param SilvercartPaymentIPayment $paymentMethod PaymentMethod
     * 
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 15.07.2011
     */
    protected function setPaymentMethod(SilvercartPaymentIPayment $paymentMethod) {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Returns the related PaymentMethod. Sets the related PaymentMethod if not 
     * exists.
     * 
     * @return SilvercartPaymentIPayment
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 15.07.2011
     */
    public function getPaymentMethod() {
        if (is_null($this->paymentMethod)) {
            $paymentMethod = DataObject::get_one('SilvercartPaymentIPayment', sprintf("`PaymentChannel` = '%s'", $this->trx_paymenttyp));
            $this->setPaymentMethod($paymentMethod);
        }
        return $this->paymentMethod;
    }

    /**
     * Creates and returns a SoapClient to handle existing transactions with
     * iPayment.
     *
     * @return SoapClient
     */
    protected function getSoapClient() {
        if (is_null($this->soapClient)) {
            $paymentMethod = $this->getPaymentMethod();
            if ($paymentMethod) {
                $apiUrl         = $paymentMethod->iPaymentSoapServerUrl;

                // iPayment SOAP-call
                $this->soapClient = new SoapClient($apiUrl, array('trace' => 1));
            }
        }
        return $this->soapClient;
    }
    
    /**
     * Returns the AccountData for the SoapClient. Creates them if not exists.
     *
     * @return array
     */
    protected function getSoapAccountData($withAdminPassword = false) {
        if (is_null($this->soapAccountData)) {
            $paymentMethod = $this->getPaymentMethod();
            if ($paymentMethod) {
                $this->soapAccountData = array(
                    'accountId'     => $paymentMethod->iPaymentAccountID,
                    'trxuserId'     => $paymentMethod->iPaymentUserID,
                    'trxpassword'   => $paymentMethod->iPaymentPassword,
                );
                if ($withAdminPassword) {
                    $this->soapAccountData['adminactionpassword'] = $paymentMethod->iPaymentAdminPassword;
                }
            }
        }
        return $this->soapAccountData;
    }
    
    /**
     * Returns the TransactionData for the SoapClient. Creates them if not exists.
     *
     * @return array
     */
    public function getSoapTransactionData() {
        if (is_null($this->soapTransactionData)) {
            $paymentMethod = $this->getPaymentMethod();
            if ($paymentMethod) {
                $this->soapTransactionData = array(
                    'trxAmount'     => $this->trx_amount,
                    'trxCurrency'   => $this->trx_currency,
                    'shopperId'     => $this->shopper_id,
                );
            }
        }
        return $this->soapTransactionData;
    }
    
    /**
     * Returns the Options for the SoapClient. Creates them if not exists.
     *
     * @return array
     */
    public function getSoapOptions() {
        if (is_null($this->soapOptions)) {
            $this->soapOptions = array(
                'fromIp'            => $_SERVER['REMOTE_ADDR'],
                'client_name'       => 'SilverCart',
                'client_version'    => SilvercartConfig::getConfig()->SilvercartVersion,
            );
        }
        return $this->soapOptions;
    }
    
    /**
     * Returns the ProcessorUrls for the SoapClient. Creates them if not exists.
     *
     * @return array
     */
    public function getSoapProcessorUrls() {
        if (is_null($this->soapProcessorUrls)) {
            $paymentMethod = $this->getPaymentMethod();
            if ($paymentMethod) {
                $this->soapProcessorUrls = array(
                    'redirectUrl'       => $paymentMethod->getReturnLink(),
                    'hiddenTriggerUrl'  => $paymentMethod->getHiddenTriggerLink(),
                    'silentErrorUrl'    => $paymentMethod->getCancelLink(),
                );
            }
        }
        return $this->soapProcessorUrls;
    }

    // ------------------------------------------------------------------------
    // SOAP processing methods
    // ------------------------------------------------------------------------
    
    /**
     * Captures a preauthed iPayment transaction via SOAP call.
     *
     * @return bool
     * 
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 15.07.2011
     */
    public function capture() {
        $iPaymentCaptureResult = false;
        if (in_array($this->trx_typ, self::$allowedCaptureTypes)) {
            try {
                $soapClient = $this->getSoapClient();
                $soapResult = $soapClient->capture(
                    $this->getSoapAccountData(true),
                    $this->ret_trx_number,
                    $this->getSoapTransactionData(),
                    $this->getSoapOptions()
                );
                $iPaymentCaptureResult = $this->handleSoapResult('capture', $soapResult);
            } catch(SoapFault $e) {
                $this->Log('capture', $e->getMessage());
                $this->Log('capture', var_export($soapClient->__getLastRequest(), true));
                $this->getPaymentMethod()->errorOccured = true;
                $this->addError(_t('SilvercartPaymentIPayment.ERROR_CAPTURE'));
            }
        } else {
            $this->Log('capture', 'transaction type ' . $this->trx_typ . ' not within allowed types:');
            $this->Log('capture', var_export(self::$allowedCaptureTypes, true));
        }
        return $iPaymentCaptureResult;
    }

    /**
     * Creates the iPayment Session ID
     *
     * @return string|boolean false
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 30.03.2011
     */
    public function createSession() {
        $iPaymentSessionID = false;
        try {
            $soapClient = $this->getSoapClient();
            $iPaymentSessionID = $soapClient->createSession(
                $this->getSoapAccountData(),
                $this->getSoapTransactionData(),
                $this->getPaymentMethod()->getTransactionType(),
                $this->getPaymentMethod()->PaymentChannel,
                $this->getSoapOptions(),
                $this->getSoapProcessorUrls()
            );
            $this->saveIPaymentSessionID($iPaymentSessionID, $this->trx_amount);
            $this->Log('createSessionId', 'create session ' . $iPaymentSessionID . ' for transaction ' . $this->shopper_id);
        } catch(SoapFault $e) {
            $this->Log('createSessionId', $e->getMessage());
            $this->Log('createSessionId', var_export($soapClient->__getLastRequest(), true));
            $this->getPaymentMethod()->errorOccured = true;
            $this->addError(_t('SilvercartPaymentIPayment.ERROR_SESSION'));
        }
        return $iPaymentSessionID;
    }
    
    /**
     * Re preauths an iPayment transaction via SOAP call.
     *
     * @return bool
     * 
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 15.07.2011
     */
    public function rePreAuthorize() {
        $iPaymentRePreauthResult = false;
        if (in_array($this->trx_typ, self::$allowedPreAuthorizeTypes)) {
            try {
                $soapClient = $this->getSoapClient();
                $soapResult = $soapClient->rePreAuthorize(
                    $this->getSoapAccountData(true),
                    $this->ret_trx_number,
                    $this->getSoapTransactionData(),
                    $this->getSoapOptions()
                );
                $iPaymentRePreauthResult = $this->handleSoapResult('re_preauth', $soapResult);
            } catch(SoapFault $e) {
                $this->Log('re_preauth', $e->getMessage());
                $this->Log('re_preauth', var_export($soapClient->__getLastRequest(), true));
                $this->getPaymentMethod()->errorOccured = true;
                $this->addError(_t('SilvercartPaymentIPayment.ERROR_PREAUTH'));
            }
        } else {
            $this->Log('re_preauth', 'transaction type ' . $this->trx_typ . ' not within allowed types:');
            $this->Log('re_preauth', var_export(self::$allowedReverseTypes, true));
        }
        return $iPaymentRePreauthResult;
    }
    
    /**
     * Reverses a preauthed iPayment transaction via SOAP call.
     *
     * @return bool
     * 
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 15.07.2011
     */
    public function reverse() {
        $iPaymentReverseResult = false;
        if (in_array($this->trx_typ, self::$allowedReverseTypes)) {
            try {
                $soapClient = $this->getSoapClient();
                $soapResult = $soapClient->reverse(
                    $this->getSoapAccountData(true),
                    $this->ret_trx_number,
                    $this->getSoapTransactionData(),
                    $this->getSoapOptions()
                );
                $iPaymentReverseResult = $this->handleSoapResult('reverse', $soapResult);
            } catch(SoapFault $e) {
                $this->Log('reverse', $e->getMessage());
                $this->Log('reverse', var_export($soapClient->__getLastRequest(), true));
                $this->getPaymentMethod()->errorOccured = true;
                $this->addError(_t('SilvercartPaymentIPayment.ERROR_REVERSE'));
            }
        } else {
            $this->Log('reverse', 'transaction type ' . $this->trx_typ . ' not within allowed types:');
            $this->Log('reverse', var_export(self::$allowedReverseTypes, true));
        }
        return $iPaymentReverseResult;
    }

    // ------------------------------------------------------------------------
    // general helper methods
    // ------------------------------------------------------------------------
    
    /**
     * Handles the given SOAP result.
     *
     * @param string   $transactionType Transaction type
     * @param stdClass $soapResult      SOAP result
     * 
     * @return boolean 
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 17.07.2011
     */
    protected function handleSoapResult($transactionType, $soapResult) {
        $result = false;
        if ($soapResult->status == 'ERROR') {
            $message = 'ERROR #' . $soapResult->errorDetails->retErrorcode;
            $message .= ' on transaction #' . $this->shopper_id;
            $message .= ': ' . $soapResult->errorDetails->retErrorMsg;
            $message .= '; ' . $soapResult->errorDetails->retAdditionalMsg;
            $this->Log($transactionType, $message);
        } else {
            $result = true;
            $this->Log($transactionType, $transactionType . ' for transaction #' . $this->shopper_id . ' successful');
        }
        $this->updateFromSoapResult($transactionType, $soapResult);
        return $result;
    }
    
    /**
     * Updates the iPayment order from the given SOAP result.
     *
     * @param string   $transactionType Transaction type
     * @param stdClass $soapResult      SOAP result
     * 
     * @return boolean 
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 17.07.2011
     */
    protected function updateFromSoapResult($transactionType, $soapResult) {
        $this->status   = $soapResult->status;
        $this->trx_typ  = $transactionType;
        if ($soapResult->status == 'ERROR') {
            $this->ret_errorcode            = $soapResult->errorDetails->retErrorcode;
        } else {
            $this->ret_transdate            = $soapResult->successDetails->retTransDate;
            $this->ret_transtime            = $soapResult->successDetails->retTransTime;
            $this->ret_trx_number           = $soapResult->successDetails->retTrxNumber;
            $this->ret_authcode             = $soapResult->successDetails->retAuthCode;
            $this->trx_paymentmethod        = $soapResult->paymentMethod;
            $this->trx_paymentdata_country  = $soapResult->trxPaymentDataCountry;
            $this->trx_remoteip_country     = $soapResult->trxRemoteIpCountry;
        }
        $this->write();
    }

    /**
     * Saves the iPayment session ID to the session.
     *
     * @param string $iPaymentSessionID iPayment session ID
     * @param string $amount            Current order amount
     *
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 30.03.2011
     */
    protected function saveIPaymentSessionID($iPaymentSessionID, $amount) {
        Session::set('ipayment_session_created.' .  $this->getPaymentMethod()->PaymentChannel, time());
        Session::set('ipayment_session_id.' .       $this->getPaymentMethod()->PaymentChannel, $iPaymentSessionID);
        Session::set('ipayment_session_amount.' .   $this->getPaymentMethod()->PaymentChannel, $amount);
        Session::save();
    }

    /**
     * Writes a log entry (wrapper for SilvercartPaymentMethod::Log())
     *
     * @param string $context the context for the log entry
     * @param string $text    the text for the log entry
     *
     * @return void
     *
     * @see SilvercartPaymentMethod::Log()
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 15.07.2011
     */
    public function Log($context, $text) {
        $this->getPaymentMethod()->Log($context, $text);
    }

    /**
     * registers an error (wrapper for SilvercartPaymentMethod::addError())
     *
     * @param string $errorText text for the error message
     *
     * @return void
     *
     * @see SilvercartPaymentMethod::addError()
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 15.07.2011
     */
    protected function addError($errorText) {
        $this->getPaymentMethod()->addError($errorText);
    }
}
