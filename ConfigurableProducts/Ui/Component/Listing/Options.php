<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit2\ConfigurableProducts\Ui\Component\Listing;


use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Options
 * @package Unit2\ConfigurableProducts\Ui\Component\Listing
 */

class Options implements OptionSourceInterface
{
    const ATTR_OPTIONS = [
        ['label' => 'Default', 'value' => ''],
        ['label' => '1',     'value' => '1'],
        ['label' => '2',     'value' => '2'],
        ['label' => '3',     'value' => '3']
    ];

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return self::ATTR_OPTIONS;
    }
}
