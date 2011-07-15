$(function() {
    $(document).ready(function() {
        var opened = false;
        $('#silvercart-payment-ipayment-cc').css({
            display: 'none'
        });
        
        $('.silvercart-payment-ipayment-cc-form .actionRow input[type="submit"]').click(function(event) {
            if (!opened) {
                event.preventDefault();
                $('#silvercart-payment-ipayment-cc').slideDown('slow');
                var buttonLabel = '';
                if(typeof(ss) == 'undefined' || typeof(ss.i18n) == 'undefined') {
                    buttonLabel = 'Proceed to overview';
                } else {
                    buttonLabel = ss.i18n._t('SilvercartPaymentIPayment.PROCEED_TO_OVERVIEW', 'Proceed to overview');
                }
                $(this).attr('value', buttonLabel);
                opened = true;
                return false;
            }
            return true;
        });
    });
});