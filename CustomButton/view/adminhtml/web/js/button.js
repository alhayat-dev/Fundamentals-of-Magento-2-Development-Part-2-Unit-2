/**
 * Copyright Â© Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    "Magento_Ui/js/form/components/button",
    "Magento_Ui/js/modal/confirm",
    "jquery"
], (Component, modalConfirm, $) => {
    "use strict";

    return Component.extend({

    action: function () {
        modalConfirm({
            content: "Hello World",
            opened: function() {
                $('body').trigger('contentUpdated');
            },
            buttons: [{
                text: 'Cancel',
                class: 'action-primary action-dismiss',

                /**
                 * Click handler.
                 */
                click: function (event) {
                    this.closeModal(event);
                }
            }]
        });
    }
    });
});