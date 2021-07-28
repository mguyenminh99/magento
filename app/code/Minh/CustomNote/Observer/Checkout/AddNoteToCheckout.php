<?php
namespace Minh\CustomNote\Observer\Checkout;

class AddNoteToCheckout implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct()
    {
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
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