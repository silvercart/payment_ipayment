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
 * First form step for iPayment PrePaid
 *
 * @package Silvercart
 * @subpackage Payment
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @copyright 2011 pixeltricks GmbH
 * @since 20.04.2011
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class SilvercartPaymentIPaymentPpCheckoutFormStep1 extends SilvercartPaymentIPaymentCheckoutFormStepPaymentInit {

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
        'pp_typ' => array(
            'type'              => 'HiddenField',
            'value'             => 'PaySafeCard',
        ),
        'pp_micromoney_contentid' => array(
            'type'              => 'HiddenField',
            'value'             => 'PaySafeCard',
        ),
        'pp_paysafecard_businesstype' => array(
            'type'              => 'TextField',
            'title'             => 'pp_paysafecard_businesstype',
            'value'             => '',
        ),
        'pp_paysafecard_reportingcriteria' => array(
            'type'              => 'TextField',
            'title'             => 'pp_paysafecard_reportingcriteria',
            'value'             => '',
        ),
    );

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
     * @since 20.04.2011
     */
    public function  __construct($controller, $params = null, $preferences = null, $barebone = false) {
        parent::__construct($controller, $params, $preferences, $barebone);
        $this->setFormAction($this->paymentMethodObj->iPaymentApiServerUrl);
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
        $this->paymentMethodObj->setCancelLink(Director::absoluteURL($this->controller->Link()));
        parent::preferences();

        $this->preferences['stepIsVisible']                     = true;
        $this->preferences['ShowCustomHtmlFormStepNavigation']  = true;
        $this->preferences['stepTitle']                         = _t('SilvercartPaymentIPaymentPpCheckoutFormStep1.TITLE', 'PaySafeCard Data');
        $this->preferences['submitButtonTitle']                 = _t('SilvercartPaymentIPaymentPpCheckoutFormStep1.CONFIRM', 'Confirm payment and order now');
        $this->preferences['fillInRequestValues']               = true;

        Requirements::themedCSS('silvercart_payment_ipayment');
    }

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
        $this->formFields['ipayment_session_id']['value']   = $this->paymentMethodObj->getSessionId();
        $this->formFields['error_lang']['value']            = substr(Translatable::get_current_locale(), 0, 2);
    }

}