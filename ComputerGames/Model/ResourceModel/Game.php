<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit2\ComputerGames\Model\ResourceModel;

/**
 * Class Game
 * @package Unit2\ComputerGames\Model\ResourceModel
 */
class Game extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init('computer_games', 'game_id');
    }
}
