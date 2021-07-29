<?php
namespace Minh\CustomNote\Observer\Checkout;


class AddNoteToCheckout implements \Magento\Framework\Event\ObserverInterface
{
    protected $request;
    
    public function __construct(\Magento\Framework\App\RequestInterface $request)
    {
        $this->request = $request;
    }
    /**
     * Assign quote to session
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/minh.log');
        //     $logger = new \Zend\Log\Logger();
        //     $logger->addWriter($writer);
        // $attributes = implode( " " , $order->getData('customer_note') );
        // $logger->info($order->getData('customer_note'));

        $requestContent = json_decode($this->request->getContent(), true);
        $order = $observer->getEvent()->getOrder();

        $order->setCustomerNoteNotify(0);
        if($customerNote = $requestContent['paymentMethod']['extension_attributes']['customer_note'] ?? null){
            $order->setData(
                'customer_note',
                $customerNote
            );
        }
    }
}