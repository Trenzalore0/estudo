<?php

declare(strict_types=1);

namespace Trenzalore\FreeItem\Observer;

use Exception;
use Psr\Log\LoggerInterface;
use Magento\Sales\Model\Order;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Quote\Api\CartRepositoryInterface as QuoteRepository;
use Magento\Quote\Model\Quote\Item\ToOrderItem as ToOrderItemConverter;

class SetFreeItem implements ObserverInterface
{

    const PRICE_FREE = 0;

    /**
     * @var Order
     */
    private $_currentOrder;

    /**
     * @var LoggerInterface
     */
    private $_logger;

    /**
     * @var ProductRepositoryInterface
     */
    private $_productRepository;

    /**
     * @var QuoteRepository
     */
    private $_quoteRepository;

    /**
     * @var ToOrderItemConverter
     */
    private $_toOrderItemConverter;

    public function __construct(
        LoggerInterface $logger,
        ProductRepositoryInterface $productRepository,
        QuoteRepository $quoteRepository,
        ToOrderItemConverter $toOrderItemConverter
    ) {
        $this->_logger = $logger;
        $this->_productRepository = $productRepository;
        $this->_quoteRepository = $quoteRepository;
        $this->_toOrderItemConverter = $toOrderItemConverter;
    }

    public function execute(Observer $observer)
    {
        $this->_currentOrder = $observer->getEvent()->getOrder();
        $this->setFreeItem('24-MB01');
    }


    private function setFreeItem($skuProduct, $parentSku = '')
    {
        try {
            $product = $this->_productRepository->get($skuProduct);
            $quote = $this->_quoteRepository->get(
                $this->_currentOrder->getQuoteId()
            );

            $product->setCustomPrice(self::PRICE_FREE);
            $product->setOriginalCustomPrice(self::PRICE_FREE);
            $quote->addProduct($product);

            $this->_currentOrder->setItems($this->resolveItems($quote));
            $this->_currentOrder->save();
        } catch (Exception $e) {
            $this->_logger->error($e->getMessage());
            throw $e;
        }
    }

    private function resolveItems($quote)
    {
        $orderItems = [];
        foreach ($quote->getAllItems() as $quoteItem) {
            $itemId = $quoteItem->getId();

            if (!empty($orderItems[$itemId])) {
                continue;
            }

            $parentItemId = $quoteItem->getParentItemId();
            /** @var \Magento\Quote\Model\ResourceModel\Quote\Item $parentItem */
            if ($parentItemId && !isset($orderItems[$parentItemId])) {
                $orderItems[$parentItemId] = $this->_toOrderItemConverter->convert(
                    $quoteItem->getParentItem(),
                    ['parent_item' => null]
                );
            }
            $parentItem = isset($orderItems[$parentItemId]) ? $orderItems[$parentItemId] : null;
            $orderItems[$itemId] = $this->_toOrderItemConverter->convert($quoteItem, ['parent_item' => $parentItem]);
        }
        return array_values($orderItems);
    }
}
