<?php
class Soundworks_Tools_Model_Soundworks_Api extends Mage_Api_Model_Resource_Abstract
{
    
    public function createShop($params)
    {
        $result = array();

        $website = Mage::getModel('core/website');
        $website->setCode($params->websiteCode)
            ->setName($params->websiteName)
            ->save();
        $result['websiteId'] = $website->getId();

        $storeGroup = Mage::getModel('core/store_group');
        $storeGroup->setWebsiteId($website->getId())
            ->setName($params->storeGroupName)
            ->setRootCategoryId($params->rootCategoryId)
            ->save();
        $result['storeGroupId'] = $storeGroup->getId();

        /** @var $store Mage_Core_Model_Store */
        $store = Mage::getModel('core/store');
        $store->setCode($params->storeCode)
            ->setWebsiteId($storeGroup->getWebsiteId())
            ->setGroupId($storeGroup->getId())
            ->setName($params->storeName)
            ->setIsActive(1)
            ->save();
        $result['storeId'] = $store->getId();

        return $result;
    }
}