<?php

declare(strict_types=1);

namespace Trenzalore\TodoList\Model;

use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\App\Request\Http as Request;
use Trenzalore\TodoList\Api\Data\TodoListInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Trenzalore\TodoList\Api\TodoListRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Trenzalore\TodoList\Model\ResourceModel\TodoList as TodoListResourceModel;
use Trenzalore\TodoList\Api\Data\TodoListInterfaceFactory as TodoListModelFactory;
use Trenzalore\TodoList\Model\ResourceModel\TodoList\CollectionFactory as TodoListCollectionFactory;

class TodoListRepository implements TodoListRepositoryInterface
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var TodoListModelFactory
     */
    private $todoListModelFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var TodoListResourceModel
     */
    private $todoListResourceModel;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var TodoListCollectionFactory
     */
    private $todoListCollectionFactory;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @param Logger $logger
     * @param Request $request
     * @param FilterBuilder $filterBuilder
     * @param TodoListModelFactory $todoListModelFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TodoListResourceModel $todoListResourceModel
     * @param CollectionProcessorInterface $collectionProcessor
     * @param TodoListCollectionFactory $todoListCollectionFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        Logger $logger,
        Request $request,
        FilterBuilder $filterBuilder,
        TodoListModelFactory $todoListModelFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TodoListResourceModel $todoListResourceModel,
        CollectionProcessorInterface $collectionProcessor,
        TodoListCollectionFactory $todoListCollectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->logger = $logger;
        $this->request = $request;
        $this->filterBuilder = $filterBuilder;
        $this->todoListModelFactory = $todoListModelFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->todoListResourceModel = $todoListResourceModel;
        $this->collectionProcessor = $collectionProcessor;
        $this->todoListCollectionFactory = $todoListCollectionFactory;
        $this->searchResultsFactory  = $searchResultsFactory;
    }

    /**
     * @param string|int $id
     * @return TodoListInterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $todoList = $this->todoListModelFactory->create();
        $this->todoListResourceModel->load($todoList, $id, TodoListInterface::TODO_LIST_ENTITY_ID);
        if (!$todoList->getEntityId()) {
            throw new NoSuchEntityException(__("Todo List with id %1 does not exists", $id));
        }
        return $todoList;
    }

    /**
     * @param string|int $id
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

    /**
     * @param string|int $customerId
     * @return array
     * @throws NoSuchEntityException
     */
    public function getByCustomerId($customerId)
    {
        $todoListArray = $this->getList(
            $this->searchCriteriaBuilder->addFilter(
                $this->filterBuilder->setField(TodoListInterface::TODO_LIST_CUSTOMER_ID)
                    ->setValue($customerId)
                    ->setConditionType('eq')
                    ->create()
            )->create()
        )->getItems();
        if (empty($todoListArray)) {
            $this->logger->error(__('Todo List with Customer id %1 does not exists', $customerId));
        }
        return $todoListArray;
    }

    /**
     * @param TodoListInterface $todoList
     * @return TodoListInterface
     * @throws CouldNotSaveException
     */
    public function save(TodoListInterface $todoList)
    {
        try {
            if ($this->request->getMethod() === "PUT") {

                if (!$todoList->getEntityId()) {
                    throw new CouldNotSaveException(__('Id need to be specified'));
                }

                $originalClass = $this->getById($todoList->getEntityId());
                $todoList->setData(array_merge($originalClass->getData(), $todoList->getData()));
            }

            $this->todoListResourceModel->save($todoList);
            return (int) $todoList->getEntityId();
        } catch (CouldNotSaveException $e) {
            $this->logger->error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param TodoListInterface $todoList
     * @throws CouldNotSaveException
     */
    public function delete(TodoListInterface $todoList)
    {
        try {
            $this->todoListResourceModel->delete($todoList);
        } catch (CouldNotSaveException $e) {
            $this->logger->error($e->getMessage());
            throw $e;
        }
        return true;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->todoListCollectionFactory->create();
        if (null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setItems($collection->getData());
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setSearchCriteria($searchCriteria);
        return $searchResults;
    }
}
