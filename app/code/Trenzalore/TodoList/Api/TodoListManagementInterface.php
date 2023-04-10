<?php

namespace Trenzalore\TodoList\Api;

use Trenzalore\TodoList\Api\Data\TodoListInterface;

interface TodoListManagementInterface
{
    /**
     * Undocumented function
     *
     * @return mixed
     */
    public function getList();

    /**
     * Undocumented function
     *
     * @param TodoListInterface $todoList
     * @return void
     */
    public function save(TodoListInterface $todoList);

}
