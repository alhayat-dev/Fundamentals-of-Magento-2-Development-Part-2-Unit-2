<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit2\ComputerGames\Controller\Adminhtml\Game;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\RedirectFactory;
use Unit2\ComputerGames\Model\GameFactory;
use \Magento\Catalog\Model\ImageUploader;
use \Magento\Store\Model\StoreManagerInterface;
use Magento\Eav\Model\Config;

/**
 * Class Save
 * @package Unit2\ComputerGames\Controller\Adminhtml\Game
 */
class Save extends Action
{
    /**
     * @var null|Game
     */
    protected $gameFactory = null;

    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @var ImageUploader
     */
    protected $imageUploader;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var Config
     */
    protected $eavConfig;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param GameFactory $gameFactory
     * @param RedirectFactory $redirectFactory
     * @param ImageUploader $imageUploader
     * @param StoreManagerInterface $storeManager
     * @param Config $eavConfig
     */
    public function __construct(
        Action\Context $context,
        GameFactory $gameFactory,
        RedirectFactory $redirectFactory,
        ImageUploader $imageUploader,
        StoreManagerInterface $storeManager,
        Config $eavConfig
    )
    {
        $this->gameFactory = $gameFactory->create();
        $this->resultRedirectFactory = $redirectFactory;
        $this->imageUploader = $imageUploader;
        $this->storeManager = $storeManager;
        $this->eavConfig = $eavConfig;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $postData = $this->getRequest()->getParams();
        $gameId = 0;
        if (isset($postData['game_id'])) {
            $gameId = (int)$postData['game_id'];
        }

        $this->gameFactory->setName($postData['name'])
            ->setReleaseDate($postData['release_date'])
            ->setType($postData['type'])
            ->setTrialPeriod($postData['trial_period']);
        if ($gameId > 0) {
            $this->gameFactory->setGameId($gameId);
        }

        if (isset($postData['image'])) {
            try {
                $imageName = $this->imageUploader->moveFileFromTmp($postData['image'][0]['name']);
                $this->gameFactory->setImage($imageName);
            } catch (\Exception $e) {
                $imageName = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
            }
        }
        $this->gameFactory->save();
        $savedGameId = $this->gameFactory->getId();

        $returnToEdit = (bool)$this->getRequest()->getParam('back', false);
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($returnToEdit) {
            if ($savedGameId) {
                $resultRedirect->setPath(
                    '*/*/edit',
                    ['game_id' => $savedGameId, '_current' => true]
                );
            } else {
                $resultRedirect->setPath(
                    '*/*/edit',
                    ['_current' => true]
                );
            }
        } else {
            $resultRedirect->setPath('*/*/index');
        }
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
