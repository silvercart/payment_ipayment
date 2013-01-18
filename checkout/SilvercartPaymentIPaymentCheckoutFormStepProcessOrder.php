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
 * Default order processor for iPayment.
 *
 * @package Silvercart
 * @subpackage Forms
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @copyright 2011 pixeltricks GmbH
 * @since 04.04.2011
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class SilvercartPaymentIPaymentCheckoutFormStepProcessOrder extends SilvercartCheckoutFormStepProcessOrder {
    
    /**
     *
     * @var SilvercartPaymentMethod
     */
    protected $paymentMethod = null;

    /**
     * processor method
     *
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 04.04.2011
     */
    public function process() {
        $this->sendConfirmationMail = false;
        parent::process();
        $checkoutData = $this->controller->getCombinedStepData();
        $this->setPaymentMethod(
            DataObject::get_by_id(
                'SilvercartPaymentMethod',
                $checkoutData['PaymentMethod']
            )
        );
        $checkoutData = $this->controller->getCombinedStepData();
        $order = DataObject::get_one('SilvercartOrder', sprintf("\"ID\"='%s'", $checkoutData['orderId']));
        $shopper_id = $order->OrderNumber;
        $iPaymentOrder = $this->getPaymentMethod()->getIPaymentOrder($shopper_id);
        $status = $iPaymentOrder->ret_status;
        if ($iPaymentOrder) {
            $amount = (string) ((float) $order->AmountTotal->getAmount() * 100);
            $this->getPaymentMethod()->checkTransactionAmount($amount, $shopper_id);
            if (!$this->getPaymentMethod()->CaptureTransactionOnOrderStatusChange) {
                if (in_array($iPaymentOrder->trx_typ, SilvercartPaymentIPaymentOrder::$allowedCaptureTypes)) {
                    $iPaymentOrder->capture();
                }
            }
        }
        if ($this->getPaymentMethod()) {
            $this->getPaymentMethod()->clearSessionId();
        }
        if (in_array($status, $this->getPaymentMethod()->successIPaymentStatus)) {
            // transaction successful
            if (in_array($iPaymentOrder->trx_typ, $this->getPaymentMethod()->payedIPaymentType)) {
                $order->setOrderStatusByID($this->getPaymentMethod()->PaidOrderStatus);
                $this->getPaymentMethod()->Log('SilvercartPaymentIPaymentCheckoutFormStepProcessOrder', 'transaction #' . $shopper_id . ' successful.');
            } else {
                $order->setOrderStatusByID($this->getPaymentMethod()->PreauthOrderStatus);
                $this->getPaymentMethod()->Log('SilvercartPaymentIPaymentCheckoutFormStepProcessOrder', 'preauth #' . $shopper_id . ' successful.');
            }
        } elseif (in_array($status, $this->getPaymentMethod()->failedIPaymentStatus)) {
            // transaction failed
            $order->setOrderStatusByID($this->getPaymentMethod()->CanceledOrderStatus);
            $this->getPaymentMethod()->Log('SilvercartPaymentIPaymentCheckoutFormStepProcessOrder', 'transaction #' . $shopper_id . ' failed.');
        } else {
            // unknown state
            $order->setOrderStatusByID($this->getPaymentMethod()->ErrorOrderStatus);
            $this->getPaymentMethod()->Log('SilvercartPaymentIPaymentCheckoutFormStepProcessOrder', 'transaction #' . $shopper_id . ' failed - unknown state.');
        }
        $order->sendConfirmationMail();
    }
    
    /**
     * Returns the related payment method
     *
     * @return SilvercartPaymentMethod 
     */
    public function getPaymentMethod() {
        return $this->paymentMethod;
    }

    /**
     * Sets the related payment method
     *
     * @param SilvercartPaymentMethod $paymentMethod Related payment method
     * 
     * @return void
     */
    public function setPaymentMethod(SilvercartPaymentMethod $paymentMethod) {
        $this->paymentMethod = $paymentMethod;
    }
}