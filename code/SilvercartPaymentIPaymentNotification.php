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
 * processes iPayments reply
 *
 * @return void
 *
 * @package Silvercart
 * @subpackage Payment
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @copyright 2011 pixeltricks GmbH
 * @since 11.03.2011
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class SilvercartPaymentIPaymentNotification extends DataObject {
    
    /**
     * contains the modul's name
     *
     * @var string
     */
    protected $moduleName = 'IPayment';

    /**
     * This method will be called by the distributing script and receives the
     * iPayment status message
     * 
     * @param string $paymentChannel payment channel
     *
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @copyright 2011 pixeltricks GmbH
     * @since 11.03.2011
     */
    public function process($paymentChannel) {

        // load payment module
        //
        // Zahlungsmodul laden
        $iPaymentModule = DataObject::get_one(
            'SilvercartPaymentIPayment',
            sprintf(
                "`PaymentChannel` = '%s'",
                $paymentChannel
            )
        );

        if ($iPaymentModule) {

            $allowedIPaymentIPs = array();
            $iPaymentServerIPs = split(',', $iPaymentModule->iPaymentServerIPs);
            array_walk($iPaymentServerIPs, 'trim');

            $givenIP = $_SERVER['REMOTE_ADDR'];

            if (!array_key_exists('ret_status', $_REQUEST)
             || !array_key_exists('ret_trx_number', $_REQUEST)
             || !array_key_exists('ret_booknr', $_REQUEST)
             || !array_key_exists('ret_ip', $_REQUEST)
             || !array_key_exists('trx_paymenttyp', $_REQUEST)
             || !array_key_exists('shopper_id', $_REQUEST)) {
                $iPaymentModule->Log('SilvercartPaymentIPaymentNotification', 'This request seems to be an attack. The required request parameters are not given. (' . $givenIP . ')');
                Director::redirect(Controller::curr()->PageByIdentifierCodeLink());
                exit();
            }

            if (!in_array($givenIP, $iPaymentServerIPs)) {
                $iPaymentModule->Log('SilvercartPaymentIPaymentNotification', 'This request seems to be an attack. IP address is not within the allowed ones. (' . $givenIP . ')');
                Director::redirect(Controller::curr()->PageByIdentifierCodeLink());
                exit();
            }

            $status     = $_REQUEST['ret_status'];
            $trx_number = $_REQUEST['ret_trx_number'];
            $booknr     = $_REQUEST['ret_booknr'];
            $shopper_id = $_REQUEST['shopper_id'];

            $iPaymentOrder = DataObject::get_one('SilvercartPaymentIPaymentOrder', sprintf("`shopper_id`='%s'", $shopper_id));
            $iPaymentOrder->update($_REQUEST);
            $iPaymentOrder->write();
            $order = DataObject::get_one('SilvercartOrder', sprintf("`OrderNumber`='%s'", $shopper_id));
            if ($order) {
                if (in_array($status, $iPaymentModule->successIPaymentStatus)) {
                    // transaction successful
                    $order->setOrderStatusByID($iPaymentModule->PaidOrderStatus);
                    $iPaymentModule->Log('SilvercartPaymentIPaymentNotification', 'transaction #' . $shopper_id . ' successful.');
                } elseif (in_array($status, $iPaymentModule->failedIPaymentStatus)) {
                    // transaction failed
                    $order->setOrderStatusByID($iPaymentModule->CanceledOrderStatus);
                    $iPaymentModule->Log('SilvercartPaymentIPaymentNotification', 'transaction #' . $shopper_id . ' failed.');
                } else {
                    // unknown state
                    $order->setOrderStatusByID($iPaymentModule->ErrorOrderStatus);
                    $iPaymentModule->Log('SilvercartPaymentIPaymentNotification', 'transaction #' . $shopper_id . ' failed - unknown state.');
                }
            }

            $iPaymentOrder = DataObject::get_one('SilvercartPaymentIPaymentOrder', sprintf("`shopper_id`='%s'", $shopper_id));
            if (!$iPaymentOrder) {
                $iPaymentOrder = new SilvercartPaymentIPaymentOrder();
            }
            $iPaymentOrder->update($_REQUEST);
        }
    }
}
