<div id="{$FormName}_{$FieldName}_Box" class="type-text ipayment-cc-number<% if errorMessage %> error<% end_if %>">
    <% if errorMessage %>
        <div class="errorList">
            <% with errorMessage %>
            <strong class="message">
                {$message}
            </strong>
            <% end_with %>
        </div>
    <% end_if %>
    <label for="{$FormName}_{$FieldName}">{$Label}</label>
    <p><% _t('SilvercartPaymentIPaymentCcCheckoutFormStep1.CC_NUMBER_HINT') %></p>
    $FieldTag
    <% with Parent.getPaymentMethod %>
        <% if showPaymentLogos %>
            <% if PaymentLogos %>
                <% loop PaymentLogos %>
                    $Image
                <% end_loop %>
            <% end_if %>
        <% end_if %>
    <% end_with %>
</div>