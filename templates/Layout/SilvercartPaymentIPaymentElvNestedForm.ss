<% require javascript(silvercart_payment_ipayment/javascript/SilvercartPaymentIPaymentElv.js) %>
<form class="yform form-horizontal silvercart-payment-ipayment-elv-form" $FormAttributes >
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
    <% end_with %>

    <fieldset id="silvercart-payment-ipayment-elv">
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
            <% loop Actions %>
            $Field
            <% end_loop %>
        </div>
    </div>
</form>