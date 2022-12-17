<?php

declare(strict_types=1);

namespace Trenzalore\Learn\Controller\Knockout;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Save implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @var JsonFactory
     */
    protected $_jsonFactory;

    /**
     * @param PageFactory $pageFactory
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        PageFactory $pageFactory,
        JsonFactory $jsonFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_jsonFactory = $jsonFactory;
    }
    /**
     * View page action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        // return $this->_pageFactory->create();





        $jsonReturn = $this->_jsonFactory->create();
        $jsonReturn->setData([
            'test' => true
        ]);
        return $jsonReturn;
    }
}
