<form class="yform" $FormAttributes >
    $CustomHtmlFormErrorMessages

    $CustomHtmlFormFieldByName(silent,CustomHtmlFormFieldHidden)
    $CustomHtmlFormFieldByName(return_paymentdata_details,CustomHtmlFormFieldHidden)
    $CustomHtmlFormFieldByName(ipayment_session_id,CustomHtmlFormFieldHidden)
    $CustomHtmlFormFieldByName(error_lang,CustomHtmlFormFieldHidden)
    $CustomHtmlFormFieldByName(noparams_on_redirect_url,CustomHtmlFormFieldHidden)
    $CustomHtmlFormFieldByName(noparams_on_error_url,CustomHtmlFormFieldHidden)

    <fieldset>
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