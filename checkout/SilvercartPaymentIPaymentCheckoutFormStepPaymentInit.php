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
 * Default payment init processor for iPayment.
 *
 * @package Silvercart
 * @subpackage Payment
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @copyright 2011 pixeltricks GmbH
 * @since 20.04.2011
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class SilvercartPaymentIPaymentCheckoutFormStepPaymentInit extends SilvercartCheckoutFormStepPaymentInit {

    /**
     * processor method
     *
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 04.04.2011
     */
    public function process() {
        if (parent::process()) {
            if (array_key_exists('ret_status', $_GET)) {
                if (in_array($_GET['ret_status'], $this->paymentMethodObj->failedIPaymentStatus)) {
                    // an error occured
                    if (array_key_exists($_GET['ret_errorcode'], $this->errorCodeFormFieldMatching)) {
                        $fieldName = $this->errorCodeFormFieldMatching[$_GET['ret_errorcode']];

                        $this->errorMessages[$fieldName] = array(
                            'message'   => $this->paymentMethodObj->getErrorMessage($_GET['ret_errorcode']),
                            'fieldname' => $this->formFields[$fieldName]['title'] ? $this->formFields[$fieldName]['title'] : $fieldName,
                            $fieldName => array(
                                'message' => $this->paymentMethodObj->getErrorMessage($_GET['ret_errorcode']),
                            )
                        );
                    } else {
                        $this->addMessage($this->paymentMethodObj->getErrorMessage($_GET['ret_errorcode']));
                    }
                    $this->paymentMethodObj->Log('error', 'error  ' . $_GET['ret_errorcode'] . ': ' . $_GET['ret_errormsg'] . '; transaction: ' . $_GET['shopper_id']);
                    $ipayment_session_id = $this->dataFieldByName('ipayment_session_id');
                    $ipayment_session_id->setValue($this->paymentMethodObj->refreshSessionId());
                    if (array_key_exists('addr_name', $_GET)) {
                        $addr_name = $this->dataFieldByName('addr_name');
                        if ($addr_name) {
                            $addr_name->setValue($_GET['addr_name']);
                        }
                    }
                } elseif (in_array($_GET['ret_status'], $this->paymentMethodObj->successIPaymentStatus)) {
                    // transaction successful
                    $this->controller->addCompletedStep();
                    $this->controller->NextStep();
                }
            }
        }
    }
}