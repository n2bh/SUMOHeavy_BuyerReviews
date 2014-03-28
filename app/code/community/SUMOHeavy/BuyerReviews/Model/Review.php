<?php
/**
 * SUMOHeavy_BuyerReviews
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@sumoheavy.com so we can send you a copy immediately.
 *
 * @category    SUMOHeavy
 * @package     SUMOHeavy_BuyerReviews
 * @copyright   Copyright (c) 2012 SUMO Heavy Industries (http://www.sumoheavy.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author		Robert Brodie <support@sumoheavy.com>
 */

class SUMOHeavy_BuyerReviews_Model_Review extends Mage_Review_Model_Review {

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Check if current review is someone who purchased or not
     *
     * @return bool
     */
    public function isBuyer()
    {
        $customerId = $this->getCustomerId();
        $productId = $this->getEntityPkValue();

        if($customerId && $productId)
        {
            $orderItems = Mage::getResourceModel('sales/order_item_collection')
                ->join('sales/order', 'order_id=entity_id')
                ->addFieldToFilter('customer_id', $customerId)
                ->addFieldToFilter('product_id', $productId);

            return $orderItems->getSize() > 0;
        }

        return false;
    }
}