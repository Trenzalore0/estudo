<?php

declare(strict_types=1);

namespace Trenzalore\TodoList\Api\Data;

interface TodoListInterface
{
    const TODO_LIST_ENTITY_ID = 'entity_id';
    const TODO_LIST_LIST = 'list';
    const TODO_LIST_CUSTOMER_ID = 'customer_id';

    public function getEntityId();

    public function setEntityId($entityId);

    public function getList();

    public function setList($list);

    public function getCustomerId();

    public function setCustomerId($customerId);
}
