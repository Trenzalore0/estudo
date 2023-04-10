<?php

declare(strict_types=1);

namespace Trenzalore\TodoList\Api\Data;

interface TodoListInterface
{
    const TODO_LIST_ENTITY_ID = 'entity_id';
    const TODO_LIST_LIST = 'list';
    const TODO_LIST_CUSTOMER_ID = 'customer_id';
    const TODO_LIST_TITLE = 'title';

    /**
     * Undocumented function
     *
     * @return string|int
     */
    public function getEntityId();

    public function setEntityId($entityId);

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getList();

    public function setList($list);

    /**
     * Undocumented function
     *
     * @return string|int
     */
    public function getCustomerId();

    public function setCustomerId($customerId);

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getTitle();

    public function setTitle($title);
}
