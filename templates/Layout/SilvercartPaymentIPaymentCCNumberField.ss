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
    <img src="{$baseHref}/silvercart_payment_ipayment/images/visa.png" alt="Visa" title="Visa" />
    <img src="{$baseHref}/silvercart_payment_ipayment/images/mastercard.png" alt="MasterCard" title="MasterCard" />
    <img src="{$baseHref}/silvercart_payment_ipayment/images/american-express.png" alt="American Express" title="American Express" />
</div>