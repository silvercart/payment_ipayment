<div id="{$FormName}_{$FieldName}_Box" class="type-text ipayment-cc-checkcode<% if errorMessage %> error<% end_if %>">
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
    <p><% _t('SilvercartPaymentIPaymentCcCheckoutFormStep1.CC_CHECKCODE_HINT') %></p>
    $FieldTag
</div>