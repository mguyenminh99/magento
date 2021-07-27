define(
    [
        'jquery',
        'uiComponent'
    ],
    function ($,component) {
        'use strict';
       return component.extend({
           defaults:{
               template: 'Minh_CustomNote/checkout/order-comment-block'
           }
       });
    }
);