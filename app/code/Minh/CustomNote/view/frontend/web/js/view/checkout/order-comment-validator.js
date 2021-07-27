define(
    [
        'uiComponent',
        'Magento_Chechout/js/model/payment/additional-validators',
        'Minh_CustomNote/js/model/checkout/order-comment-validators '
    ],
    function (Component, additionalValidator, commentValidator){
        'use strict';
        additionalValidator.registerValidator(commentValidator);
        return Component.extend({});
    }
)