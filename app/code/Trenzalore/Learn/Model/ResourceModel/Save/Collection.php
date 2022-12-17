<?php

declare(strict_types=1);

namespace Trenzalore\Learn\Model\ResourceModel\Save;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'trenzalore_learn_save_collection';
    protected $_eventObject = 'save_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Trenzalore\Learn\Model\Save', 'Trenzalore\Learn\Model\ResourceModel\Save');
    }
}
