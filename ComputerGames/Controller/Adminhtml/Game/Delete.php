<?php
/**
 *  Copyright © Magento. All rights reserved.
 *  See COPYING.txt for license details.
 */
namespace Unit2\ComputerGames\Controller\Adminhtml\Game;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\RedirectFactory;
use Unit2\ComputerGames\Model\GameFactory;

/**
 * Class Delete
 * @package Unit2\ComputerGames\Controller\Adminhtml\Game
 */
class Delete extends Action
{
    /**
     * @var null|GameFactory
     */
    protected $gameFactory = null;

    /**
     * @var RedirectFactory|mixed
     */
    protected $resultRedirectFactory;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param GameFactory $gameFactory
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(Action\Context $context, GameFactory $gameFactory, RedirectFactory $redirectFactory)
    {
        $this->gameFactory = $gameFactory->create();
        $this->resultRedirectFactory = $redirectFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $entityId = $this->getRequest()->getParam('game_id');

        $this->gameFactory->load($entityId);
        if ($this->gameFactory->getId()) {
            $this->gameFactory->delete();
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Unit2_ComputerGames::grid');
    }
}
