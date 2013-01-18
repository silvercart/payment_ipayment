<form class="yform" $FormAttributes >
    $CustomHtmlFormErrorMessages

    $CustomHtmlFormFieldByName(silent,CustomHtmlFormFieldHidden)
    $CustomHtmlFormFieldByName(return_paymentdata_details,CustomHtmlFormFieldHidden)
    $CustomHtmlFormFieldByName(ipayment_session_id,CustomHtmlFormFieldHidden)
    $CustomHtmlFormFieldByName(error_lang,CustomHtmlFormFieldHidden)
    $CustomHtmlFormFieldByName(noparams_on_redirect_url,CustomHtmlFormFieldHidden)
    $CustomHtmlFormFieldByName(noparams_on_error_url,CustomHtmlFormFieldHidden)
    $CustomHtmlFormFieldByName(pp_typ,CustomHtmlFormFieldHidden)
    $CustomHtmlFormFieldByName(pp_micromoney_contentid,CustomHtmlFormFieldHidden)

    <fieldset>
        <legend><% _t('SilvercartPaymentIPaymentPpCheckoutFormStep1.BANK_DATA','Your PaySafeCard Data') %></legend>
        <p><% _t('SilvercartPaymentIPaymentPpCheckoutFormStep1.SECURITY_HINT') %></p>
        $CustomHtmlFormFieldByName(pp_paysafecard_businesstype)
        $CustomHtmlFormFieldByName(pp_paysafecard_reportingcriteria)
    </fieldset>

    <div class="actionRow">
        <div class="type-button">
            <% loop Actions %>
            $Field
            <% end_loop %>
        </div>
    </div>
</form>