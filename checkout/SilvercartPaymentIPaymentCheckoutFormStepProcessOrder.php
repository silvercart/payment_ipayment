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
 * Default order processor for iPayment.
 *
 * @package Silvercart
 * @subpackage Payment
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @copyright 2011 pixeltricks GmbH
 * @since 04.04.2011
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class SilvercartPaymentIPaymentCheckoutFormStepProcessOrder extends SilvercartCheckoutFormStepProcessOrder {

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
        $this->paymentMethodObj = DataObject::get_by_id(
            'SilvercartPaymentMethod',
            $checkoutData['PaymentMethod']
        );
        if ($this->paymentMethodObj) {
            $this->paymentMethodObj->clearSessionId();
        }
        $checkoutData = $this->controller->getCombinedStepData();
        $order = DataObject::get_one('SilvercartOrder', sprintf("`ID`='%s'", $checkoutData['orderId']));
        $shopper_id = $order->OrderNumber;
        $iPaymentOrder = DataObject::get_one('SilvercartPaymentIPaymentOrder', sprintf("`shopper_id`='%s'", $shopper_id));
        $status = $iPaymentOrder->ret_status;
        if (in_array($status, $this->paymentMethodObj->successIPaymentStatus)) {
            // transaction successful
            $order->setOrderStatusByID($this->paymentMethodObj->PaidOrderStatus);
            $this->paymentMethodObj->Log('SilvercartPaymentIPaymentCheckoutFormStepProcessOrder', 'transaction #' . $shopper_id . ' successful.');
        } elseif (in_array($status, $this->paymentMethodObj->failedIPaymentStatus)) {
            // transaction failed
            $order->setOrderStatusByID($this->paymentMethodObj->CanceledOrderStatus);
            $this->paymentMethodObj->Log('SilvercartPaymentIPaymentCheckoutFormStepProcessOrder', 'transaction #' . $shopper_id . ' failed.');
        } else {
            // unknown state
            $order->setOrderStatusByID($this->paymentMethodObj->ErrorOrderStatus);
            $this->paymentMethodObj->Log('SilvercartPaymentIPaymentCheckoutFormStepProcessOrder', 'transaction #' . $shopper_id . ' failed - unknown state.');
        }
        $order->sendConfirmationMail();
    }
}