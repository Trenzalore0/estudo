<?php

declare(strict_types=1);

namespace Trenzalore\Learn\Controller\Knockout;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Index implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @param PageFactory $pageFactory
     */
    public function __construct(
        PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;
    }
    /**
     * View page action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
