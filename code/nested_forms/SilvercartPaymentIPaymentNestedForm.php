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
 * @subpackage Forms
 */

/**
 * Nested form for iPayment
 *
 * @package Silvercart
 * @subpackage Forms
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @copyright 2011 pixeltricks GmbH
 * @since 11.07.2011
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class SilvercartPaymentIPaymentNestedForm extends SilvercartCheckoutFormStep4DefaultPayment {

    /**
     * constructor. Set alternative form action here.
     *
     * @param Controller $controller  the controller object
     * @param array      $params      additional parameters
     * @param array      $preferences array with preferences
     * @param bool       $barebone    is the form initialized completely?
     *
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 04.04.2011
     */
    public function  __construct($controller, $params = null, $preferences = null, $barebone = false) {
        parent::__construct($controller, $params, $preferences, $barebone);
        $this->setFormAction($this->getPaymentMethod()->iPaymentApiServerUrl);
        Requirements::add_i18n_javascript('silvercart_payment_ipayment/javascript/lang');
    }

    /**
     * Here we set some preferences.
     *
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 04.04.2011
     */
    public function preferences() {
        parent::preferences();
        Requirements::themedCSS('silvercart_payment_ipayment');
        $this->getPaymentMethod()->setCancelLink(Director::absoluteURL($this->controller->Link()));
    }

    /**
     * processor method
     *
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 04.04.2011
     */
    public function process() {
        if (array_key_exists('trx_paymenttyp', $_GET) &&
            $_GET['trx_paymenttyp'] == $this->getPaymentMethod()->PaymentChannel &&
            array_key_exists('ret_status', $_GET)) {
            
            if (in_array($_GET['ret_status'], $this->getPaymentMethod()->failedIPaymentStatus)) {
                // an error occured
                if (array_key_exists($_GET['ret_errorcode'], $this->errorCodeFormFieldMatching)) {
                    $fieldName = $this->errorCodeFormFieldMatching[$_GET['ret_errorcode']];

                    $this->errorMessages[$fieldName] = array(
                        'message'   => $this->getPaymentMethod()->getErrorMessage($_GET['ret_errorcode']),
                        'fieldname' => $this->formFields[$fieldName]['title'] ? $this->formFields[$fieldName]['title'] : $fieldName,
                        $fieldName  => array(
                            'message' => $this->getPaymentMethod()->getErrorMessage($_GET['ret_errorcode']),
                        )
                    );
                } else {
                    $this->addMessage($this->getPaymentMethod()->getErrorMessage($_GET['ret_errorcode']));
                }
                $this->getPaymentMethod()->Log('error', 'error ' . $_GET['ret_errorcode'] . ': ' . $_GET['ret_errormsg'] . '; transaction: ' . $_GET['shopper_id']);
                $ipayment_session_id = $this->dataFieldByName('ipayment_session_id');
                $ipayment_session_id->setValue($this->getPaymentMethod()->refreshSessionId());
                
                if (array_key_exists('addr_name', $_GET)) {
                    $addr_name = $this->dataFieldByName('addr_name');
                    if ($addr_name) {
                        $addr_name->setValue($_GET['addr_name']);
                    }
                }
            } elseif (in_array($_GET['ret_status'], $this->getPaymentMethod()->successIPaymentStatus)) {
                // transaction successful; create/update iPaymentOrder
                $this->getPaymentMethod()->createIPaymentOrder(SilvercartNumberRange::reserveNewNumberByIdentifier('OrderNumber'), $_GET);
                // add PaymentMethod to step data
                $this->controller->setStepData(array(
                    'PaymentMethod' => $this->getPaymentMethod()->ID,
                ));
                // complete step and continue
                $this->controller->addCompletedStep();
                $this->controller->NextStep();
                return true;
            }
        } elseif ($this->controller->isStepCompleted(3)) {
            if ($this->getPaymentMethod()->getIPaymentOrder(SilvercartNumberRange::reserveNewNumberByIdentifier('OrderNumber'))) {
                $amount = (string) ((float) $this->getPaymentMethod()->getShoppingCart()->getAmountTotal()->getAmount() * 100);
                $this->getPaymentMethod()->checkTransactionAmount($amount);
            }
        }
        return false;
    }

}