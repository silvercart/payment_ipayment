<div id="{$FormName}_{$FieldName}_Box" class="type-text<% if errorMessage %> error<% end_if %>">
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
    <p><% _t('SilvercartPaymentIPaymentElvCheckoutFormStep1.BANK_BIC_HINT') %></p>
    $FieldTag
</div>