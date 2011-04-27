<div id="{$FormName}_{$FieldName}_Box" class="type-text ipayment-cc-number<% if errorMessage %> error<% end_if %>">
    <% if errorMessage %>
        <div class="errorList">
            <% control errorMessage %>
            <strong class="message">
                {$message}
            </strong>
            <% end_control %>
        </div>
    <% end_if %>
    <label for="{$FormName}_{$FieldName}">{$Label}</label>
    <p><% _t('SilvercartPaymentIPaymentCcCheckoutFormStep1.CC_NUMBER_HINT') %></p>
    $FieldTag
    <% control Parent.getPaymentMethod %>
        <% if showPaymentLogos %>
            <% if PaymentLogos %>
                <% control PaymentLogos %>
                    $Image
                <% end_control %>
            <% end_if %>
        <% end_if %>
    <% end_control %>
</div>