<?php

declare(strict_types=1);

namespace Trenzalore\TodoList\Model\ResourceModel\TodoList;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'trenzalore_todolist_todo_list_collection';
    protected $_eventObject = 'todo_list_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Trenzalore\TodoList\Model\TodoList', 'Trenzalore\TodoList\Model\ResourceModel\TodoList');
    }
}
