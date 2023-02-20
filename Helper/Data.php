<?php

namespace Fiko\Testing\Helper;

use Magento\Store\Model\StoreManagerInterface;

class Data
{
    const BORIZQY = 'Borizqy';

    /**
     * Constructor
     *
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(StoreManagerInterface $storeManager)
    {
        $this->storeManager = $storeManager;
    }

    /**
     * This method will return what's the bypassed parameter
     *
     * @param string $name
     * @return string
     */
    public function getName($name): string
    {
        return $name;
    }

    /**
     * Getting current store Id
     *
     * @return void
     */
    public function getStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }

    /**
     * Checking is string parameter borizqy or not?
     *
     * @param string $surname
     * @return boolean
     */
    public function isBorizqy($surname)
    {
        return ucwords(strtolower($surname)) === self::BORIZQY;
    }
}
