define(
    [
        'jquery',
        'mage/utls/wrapper'
    ],
    function ($,wrapper) {
        'use strict';
        return function(placeOrderAction){

            return wrapper.wrapp(placeOrderAction, function(originalAction, paymentData, messageContainer){
                if(paymentData['extension_attributes'] === indefined){
                    paymentData['extension_attributes'] = {};
                }
                var customerinput = $('.payment-method input[name="payment[method]"]:checked').parents('.payment-method').find('.order-comment');
                paymentData['extension_attributes']['customer_note'] = customerinput.val();
                return originalAction(paymentData, messageContainer);
            })
        }
    }
);