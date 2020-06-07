<?php


namespace Unit2\ComputerGames\Ui\Component\Options;


class Types implements \Magento\Framework\Data\OptionSourceInterface
{

    const TYPE_OPTIONS = [
        ['label' => 'RPG',       'value' => 'RPG'],
        ['label' => 'RTS',       'value' => 'RTS'],
        ['label' => 'MMO',       'value' => 'MMO'],
        ['label' => 'Simulator', 'value' => 'Simulator'],
        ['label' => 'Shooter',   'value' => 'Shooter']
    ];

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $this->options = self::TYPE_OPTIONS;
        return $this->options;
    }
}
