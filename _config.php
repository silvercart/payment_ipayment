<?php
/**
 * Copyright 2010, 2011 pixeltricks GmbH
 *
 * This file is part of SilvercartPrepaymentPayment.
 *
 * SilvercartPaymentIPayment is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SilvercartPrepaymentPayment is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with SilvercartPrepaymentPayment.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Silvercart
 * @subpackage iPayment
 * @ignore
 */

CustomHtmlForm::registerModule('silvercart_payment_ipayment', 50);
DataObject::add_extension('SilvercartPaymentIPayment',         'SilvercartDataObjectMultilingualDecorator');
// ----------------------------------------------------------------------------
// Register CSS requirements
// ----------------------------------------------------------------------------
#RequirementsEngine::registerThemedCssFile('silvercart_payment_ipayment');
// Require i18n javascript
Requirements::add_i18n_javascript('silvercart_payment_ipayment/javascript/lang');