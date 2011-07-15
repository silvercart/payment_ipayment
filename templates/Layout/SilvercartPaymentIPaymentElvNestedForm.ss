<% require javascript(silvercart_payment_ipayment/javascript/SilvercartPaymentIPaymentElv.js) %>
<form class="yform silvercart-payment-ipayment-elv-form" $FormAttributes >
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

    <fieldset id="silvercart-payment-ipayment-elv">
        $CustomHtmlFormFieldByName(silent,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(return_paymentdata_details,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(ipayment_session_id,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(error_lang,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(noparams_on_redirect_url,CustomHtmlFormFieldHidden)
        $CustomHtmlFormFieldByName(noparams_on_error_url,CustomHtmlFormFieldHidden)
        <legend><% _t('SilvercartPaymentIPaymentElvCheckoutFormStep1.BANK_DATA','Your Bank Data') %></legend>
        <p><% _t('SilvercartPaymentIPaymentElvCheckoutFormStep1.SECURITY_HINT') %></p>
        $CustomHtmlFormFieldByName(addr_name)
        $CustomHtmlFormFieldByName(bank_accountnumber)
        $CustomHtmlFormFieldByName(bank_code)
        $CustomHtmlFormFieldByName(bank_name,SilvercartPaymentIPaymentBankNameField)
        $CustomHtmlFormFieldByName(bank_iban,SilvercartPaymentIPaymentBankIbanField)
        $CustomHtmlFormFieldByName(bank_bic,SilvercartPaymentIPaymentBankBicField)
    </fieldset>

    <div class="actionRow">
        <div class="type-button">
            <% control Actions %>
            $Field
            <% end_control %>
        </div>
    </div>
</form>