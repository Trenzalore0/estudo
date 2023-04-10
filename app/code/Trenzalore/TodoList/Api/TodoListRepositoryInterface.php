<?php

declare(strict_types=1);

namespace Trenzalore\TodoList\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Trenzalore\TodoList\Api\Data\TodoListInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

interface TodoListRepositoryInterface
{
    /**
     * @param string|int $id
     * @return TodoListInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param string|int $id
     * @throws NoSuchEntityException
     */
    public function deleteById($id);

    /**
     * @param string|int $customerId
     * @return array
     * @throws NoSuchEntityException
     */
    public function getByCustomerId($customerId);

    /**
     * @param TodoListInterface $todoList
     * @return TodoListInterface
     * @throws CouldNotSaveException
     */
    public function save(TodoListInterface $todoList);

    /**
     * @param TodoListInterface $todoList
     * @throws CouldNotSaveException
     */
    public function delete(TodoListInterface $todoList);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
