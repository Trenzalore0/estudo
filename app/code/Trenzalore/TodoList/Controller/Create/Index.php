<?php

declare(strict_types=1);

namespace Trenzalore\TodoList\Controller\Create;

use Magento\Framework\View\Result\Page;
use Magento\Framework\App\Action\Context;
use Magento\Wishlist\Controller\AbstractIndex;
use Magento\Framework\Controller\ResultFactory;

class Index extends AbstractIndex
{
    /**
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * View page action
     *
     * @return Page
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $resultPage;
    }
}
