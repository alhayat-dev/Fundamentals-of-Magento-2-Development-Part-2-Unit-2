/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'Magento_Ui/js/grid/filters/filters'
], function (Filters) {
    'use strict';

    return Filters.extend({
        defaults: {
            templates: {
                filters: {
                    multiSelect: {
                        component: 'Magento_Ui/js/form/element/ui-select',
                        template: 'ui/grid/filters/elements/ui-select',
                        options: '${ JSON.stringify($.$data.column.options) }',
                        caption: ' '
                    }
                }
            }
        }
    });
});