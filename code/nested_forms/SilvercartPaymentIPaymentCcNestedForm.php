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
 * Nested form for iPayment Credit Card
 *
 * @package Silvercart
 * @subpackage Forms
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @copyright 2011 pixeltricks GmbH
 * @since 11.07.2011
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class SilvercartPaymentIPaymentCcNestedForm extends SilvercartPaymentIPaymentNestedForm {

    /**
     * Form field definitions.
     *
     * @var array
     */
    protected $formFields = array(
        'silent' => array(
            'type'              => 'HiddenField',
            'value'             => '1',
        ),
        'return_paymentdata_details' => array(
            'type'              => 'HiddenField',
            'value'             => '0',
        ),
        'ipayment_session_id' => array(
            'type'              => 'HiddenField',
        ),
        'error_lang' => array(
            'type'              => 'HiddenField',
        ),
        'noparams_on_redirect_url' => array(
            'type'              => 'HiddenField',
            'value'             => '0',
        ),
        'noparams_on_error_url' => array(
            'type'              => 'HiddenField',
            'value'             => '0',
        ),

        'addr_street' => array(
            'type'              => 'HiddenField',
            'title'             => 'Street',
            'value'             => '',
        ),
        'addr_street_number' => array(
            'type'              => 'HiddenField',
            'title'             => 'Street number',
            'value'             => '',
        ),
        'addr_street2' => array(
            'type'              => 'HiddenField',
            'title'             => 'Street addition',
            'value'             => '',
        ),
        'addr_city' => array(
            'type'              => 'HiddenField',
            'title'             => 'City',
            'value'             => '',
        ),
        'addr_zip' => array(
            'type'              => 'HiddenField',
            'title'             => 'ZIP',
            'value'             => '',
        ),
        'addr_country' => array(
            'type'              => 'HiddenField',
            'title'             => 'Country',
            'value'             => '',
        ),

        'addr_name' => array(
            'type'              => 'TextField',
            'title'             => 'Card holder',
            'value'             => '',
            'checkRequirements' => array(
                'isFilledIn' => true
            )
        ),
        'cc_number' => array(
            'type'              => 'TextField',
            'title'             => 'Card number',
            'checkRequirements' => array(
                'isFilledIn' => true
            )
        ),
        'cc_checkcode' => array(
            'type'              => 'TextField',
            'title'             => 'Checkcode',
            'checkRequirements' => array(
                'isFilledIn' => true
            )
        ),
        'cc_expdate_month' => array(
            'type'              => 'DropdownField',
            'title'             => 'Expiry',
            'checkRequirements' => array(
                'isFilledIn' => true
            )
        ),
        'cc_expdate_year' => array(
            'type'              => 'DropdownField',
            'title'             => 'Expiry',
            'checkRequirements' => array(
                'isFilledIn' => true
            )
        ),
    );

    /**
     * Error codes and their corresponding FormFields
     * 
     * @var array
     */
    protected $errorCodeFormFieldMatching = array(
        5000 => 'addr_name',
        5001 => 'cc_number',
        5002 => 'cc_number',
        5003 => 'cc_expdate_month',
        5006 => 'cc_checkcode',
        5007 => 'cc_number',
        5008 => 'cc_number',
        5009 => 'addr_name',
    );

    /**
     * Set initial form values
     *
     * @return void
     *
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 04.04.2011
     */
    public function fillInFieldValues() {
        // some values for hidden fields
        if ($this->controller->currentStepIsPaymentStep()) {
            $this->formFields['ipayment_session_id']['value']   = $this->getPaymentMethod()->getSessionId();
        }
        $this->formFields['error_lang']['value']            = substr(Translatable::get_current_locale(), 0, 2);
        
        $invoiceAddress = $this->Controller()->getInvoiceAddress();
        
        $this->formFields['addr_street']['value']           = $invoiceAddress->Street;
        $this->formFields['addr_street_number']['value']    = $invoiceAddress->StreetNumber;
        $this->formFields['addr_street2']['value']          = $invoiceAddress->Addition;
        $this->formFields['addr_city']['value']             = $invoiceAddress->City;
        $this->formFields['addr_zip']['value']              = $invoiceAddress->Postcode;
        $this->formFields['addr_country']['value']          = $invoiceAddress->SilvercartCountry()->ISO2;
        
        // localed form field titles
        $this->formFields['addr_name']['title']         = _t('SilvercartPaymentIPaymentCcCheckoutFormStep1.ADDR_NAME');
        $this->formFields['cc_number']['title']         = _t('SilvercartPaymentIPaymentCcCheckoutFormStep1.CC_NUMBER');
        $this->formFields['cc_checkcode']['title']      = _t('SilvercartPaymentIPaymentCcCheckoutFormStep1.CC_CHECKCODE');
        $this->formFields['cc_expdate_month']['title']  = _t('SilvercartPaymentIPaymentCcCheckoutFormStep1.CC_EXPDATE_MONTH');
        $this->formFields['cc_expdate_year']['title']   = _t('SilvercartPaymentIPaymentCcCheckoutFormStep1.CC_EXPDATE_YEAR');
        // set values for expiry fields
        $months = array(
            '1' => '01',
            '2' => '02',
            '3' => '03',
            '4' => '04',
            '5' => '05',
            '6' => '06',
            '7' => '07',
            '8' => '08',
            '9' => '09',
            '10' => '10',
            '11' => '11',
            '12' => '12'
        );
        $years          = array();
        $currentYear    = (int) date('Y');
        $upToYear       = $currentYear + 15;
        for ($year = $currentYear; $year < $upToYear; $year++) {
            $years[$year] = substr((string) $year, 2);
        }
        $this->formFields['cc_expdate_month']['value']  = $months;
        $this->formFields['cc_expdate_year']['value']   = $years;
    }

}