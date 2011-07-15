<% require javascript(silvercart_payment_ipayment/javascript/SilvercartPaymentIPaymentCc.js) %>
<form class="yform silvercart-payment-ipayment-cc-form" $FormAttributes >
    $CustomHtmlFormMetadata
    $CustomHtmlFormErrorMessages
    
    <% control PaymentMethod %>
    <div class="silvercart-checkout-payment-additionalInfo">
        <strong>$Name</strong>
        <% if showPaymentLogos %>
            <div class="silvercart-checkout-payment-additionalInfo-logos">
            <% if PaymentLogos %>
                <span class="silvercart-checkout-payment-additionalInfo-logo">
                    <% control PaymentLogos %>
                        $Image
                    <% end_control %>
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
        <legend><% _t('SilvercartPaymentIPaymentCcCheckoutFormStep1.CC_DATA','Your credit card data') %></legend>
        <p><% _t('SilvercartPaymentIPaymentCcCheckoutFormStep1.SECURITY_HINT') %></p>
        $CustomHtmlFormFieldByName(addr_name)
        $CustomHtmlFormFieldByName(cc_number,SilvercartPaymentIPaymentCCNumberField)
        $CustomHtmlFormFieldByName(cc_checkcode,SilvercartPaymentIPaymentCCCheckcodeField)
        $CustomHtmlFormFieldByName(cc_expdate_month,SilvercartPaymentIPaymentValidToField)
    </fieldset>

    <div class="actionRow">
        <div class="type-button">
            <% control Actions %>
            $Field
            <% end_control %>
        </div>
    </div>
</form>