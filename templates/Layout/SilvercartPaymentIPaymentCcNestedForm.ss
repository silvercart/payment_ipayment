<% require javascript(silvercart_payment_ipayment/javascript/SilvercartPaymentIPaymentCc.js) %>
<form class="yform silvercart-payment-ipayment-cc-form" $FormAttributes >
    $CustomHtmlFormMetadata
    $CustomHtmlFormErrorMessages
    
    <% with PaymentMethod %>
    <div class="silvercart-checkout-payment-additionalInfo">
        <strong>$Name</strong>
        <% if showPaymentLogos %>
            <div class="silvercart-checkout-payment-additionalInfo-logos">
            <% if PaymentLogos %>
                <span class="silvercart-checkout-payment-additionalInfo-logo">
                    <% loop PaymentLogos %>
                        $Image
                    <% end_loop %>
                </span>
            <% end_if %>
            </div>
        <% end_if %>
        <% if paymentDescription %>
            <div class="silvercart-checkout-payment-additionalInfo-description">
                <i>$paymentDescription</i>
            </div>
        <% end_if %>
    </div>
    <% end_control %>

    <fieldset id="silvercart-payment-ipayment-cc">
        $CustomHtmlFormFieldByName(silent,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(return_paymentdata_details,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(ipayment_session_id,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(error_lang,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(noparams_on_redirect_url,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(noparams_on_error_url,CustomHtmlFormFieldHidden)
        
        $CustomHtmlFormFieldByName(addr_street,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(addr_street_number,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(addr_street2,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(addr_city,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(addr_zip,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(addr_country,CustomHtmlFormFieldHidden)
        
        <legend><% _t('SilvercartPaymentIPaymentCcCheckoutFormStep1.CC_DATA','Your credit card data') %></legend>
        <p><% _t('SilvercartPaymentIPaymentCcCheckoutFormStep1.SECURITY_HINT') %></p>
        $CustomHtmlFormFieldByName(addr_name)
        $CustomHtmlFormFieldByName(cc_number,SilvercartPaymentIPaymentCCNumberField)
        $CustomHtmlFormFieldByName(cc_checkcode,SilvercartPaymentIPaymentCCCheckcodeField)
        $CustomHtmlFormFieldByName(cc_expdate_month,SilvercartPaymentIPaymentValidToField)
    </fieldset>

    <div class="actionRow">
        <div class="type-button">
            <% loop Actions %>
            $Field
            <% end_loop %>
        </div>
    </div>
</form>