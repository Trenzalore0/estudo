<?php

declare(strict_types=1);

namespace Trenzalore\TodoList\Model\ResourceModel\TodoList;

use Trenzalore\TodoList\Model\TodoList;
use Trenzalore\TodoList\Model\ResourceModel\TodoList as ResourceTodoList;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            TodoList::class,
            ResourceTodoList::class
        );
    }
}
