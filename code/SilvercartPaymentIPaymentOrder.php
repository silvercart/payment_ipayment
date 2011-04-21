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
    static $extensions = array(
        "Versioned('Live')",
    );
}
