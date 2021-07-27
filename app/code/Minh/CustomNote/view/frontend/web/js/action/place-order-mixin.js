define(
    [
        'jquery',
        'mage/utls/wrapper'
    ],
    function ($,wrapper) {
        'use strict';
        return function(placeOrderAction){

            return wrapper.wrapp(placeOrderAction, function(originalAction, paymentData, messageContainer){
                if(paymentData['extention_atribute'] === indefined){
                    paymentData['extention_atribute'] = {};
                }
                var customerinput = $('.payment-method input[name="payment[method]"]:checked').parents('.payment-method').find('order-comment');
                paymentData['extention_atribute']['custom-note'] = customerinput.val();
                return originalAction(paymentData, messageContainer);
            })
        }
    }
);