<?php

namespace Vnext\TrainingModule\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Model\Product;

class MyObserver implements ObserverInterface
{
    protected $orderFactory;
    protected $product;

    public function __construct(\Magento\Quote\Model\QuoteFactory $quoteFactory,
                                \Magento\Sales\Model\Order $orderFactory,
                                Product $product)
    {
        $this->orderFactory = $orderFactory;
        $this->product = $product;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        $order = $observer->getEvent()->getOrder();
        $orderId = $order->getIncrementId();
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/khanh.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info($orderId);
        $orderItems = $order->getAllItems();
//        $getName = $orderItems->getName();
//        $qty = $getName->setQuantity(0);
//        var_dump($qty);die;
        foreach ($orderItems as $item){
            $logger->info($item->getName());
            $logger->info($item->product->setQty('qty', 0));
        }
        die;
//        echo '<pre>';
//        var_dump(count($orderItems));die;

    }

}