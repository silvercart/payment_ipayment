<form class="yform form-horizontal" $FormAttributes >
    $CustomHtmlFormErrorMessages

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
    <% if PaymentMethod.UseTransactionIDAsInvoiceText %>
        $CustomHtmlFormFieldByName(invoice_text,CustomHtmlFormFieldHidden)
    <% end_if %>

    <fieldset>
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