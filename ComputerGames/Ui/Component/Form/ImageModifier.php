<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit2\ComputerGames\Ui\Component\Form;

use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Catalog\Model\ImageUploader;

class ImageModifier implements ModifierInterface
{
    protected $storeManager;

    protected $imageUploader;

    public function __construct(
        StoreManagerInterface $storeManager,
        ImageUploader $imageUploader
    ) {
        $this->storeManager = $storeManager;
        $this->imageUploader = $imageUploader;
    }
    /**
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        return $meta;
    }

    /**
     * modifyData
     *
     * @param  mixed $data
     *
     * @return void
     */
    public function modifyData(array $data)
    {
        foreach ($data as $image) {
            $imageData = $image->getData();
            if (isset($imageData['image'])) {
                $arrayImageData = [];
                $arrayImageData[0]['name'] = 'Image';
                $arrayImageData[0]['url'] = $this->storeManager->getStore()->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                    ) . $this->imageUploader->getFilePath(
                        $this->imageUploader->getBasePath(),
                        $image->getImage()
                    );
                $imageData['image'] = $arrayImageData;
            }

            $image->setData($imageData);
            $data[$image->getId()] = $imageData;
        }

        return $data;
    }
}