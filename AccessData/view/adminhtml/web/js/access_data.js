/**
 * Copyright Â© Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    "Magento_Ui/js/grid/columns/column",
    "jquery"], (Component, $) => {

    "use strict";

    return Component.extend({
        defaults: {
            accessData: 'test',
            imports: {
                access_data: '${$.provider}:data'
            }
        },

        initialize: function () {
            this._super();
        },

        access_data: function (access_data) {
            console.log('accessData2 ', access_data);
        },

        getLabel: function () {
            return this.accessData;
        },
    });
});
