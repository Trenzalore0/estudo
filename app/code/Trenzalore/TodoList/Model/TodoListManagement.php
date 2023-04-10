<?php

namespace Trenzalore\TodoList\Model;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Request\Http as Request;
use Magento\Customer\Model\Session as CustomerSession;
use Trenzalore\TodoList\Api\Data\TodoListInterface;
use Trenzalore\TodoList\Api\TodoListManagementInterface;
use Trenzalore\TodoList\Api\TodoListRepositoryInterface\Proxy as TodoListRepository;

class TodoListManagement implements TodoListManagementInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var TodoListRepository
     */
    protected $todoListRepository;

    /**
     * @param Request $request
     * @param CustomerSession $customerSession
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TodoListRepository $todoListRepository
     */
    public function __construct(
        Request $request,
        CustomerSession $customerSession,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TodoListRepository $todoListRepository
    ) {
        $this->request = $request;
        $this->customerSession = $customerSession;
        $this->todoListRepository = $todoListRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Undocumented function
     *
     * @return mixed
     */
    public function getList()
    {
        $customerId = $this->customerSession->getId();
        $todoListArray = $this->todoListRepository->getByCustomerId($customerId);
        return json_encode($todoListArray);
    }

    /**
     * Undocumented function
     *
     * @param TodoListInterface $todoList
     * @return void
     */
    public function save(TodoListInterface $todoList)
    {
        return $this->todoListRepository->save(
            $todoList->setCustomerId(
                $this->customerSession->getId()
            )
        );
    }
}
