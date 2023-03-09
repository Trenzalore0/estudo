<?php

declare(strict_types=1);

namespace Trenzalore\TodoList\Model;

use Magento\Framework\Model\AbstractModel;
use Trenzalore\TodoList\Api\Data\TodoListInterface;
use Trenzalore\TodoList\Model\ResourceModel\TodoList as ResourceModelTodoList;

class TodoList extends AbstractModel implements TodoListInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModelTodoList::class);
    }

    public function getEntityId()
    {
        return $this->getData(self::TODO_LIST_ENTITY_ID);
    }

    public function setEntityId($entityId)
    {
        return $this->setData(self::TODO_LIST_ENTITY_ID, $entityId);
    }

    public function getList()
    {
        return $this->getData(self::TODO_LIST_LIST);
    }

    public function setList($list)
    {
        return $this->setData(self::TODO_LIST_LIST, $list);
    }

    public function getCustomerId()
    {
        return $this->getData(self::TODO_LIST_CUSTOMER_ID);
    }

    public function setCustomerId($customerId)
    {
        return $this->setData(self::TODO_LIST_CUSTOMER_ID, $customerId);
    }
}
