<?php
namespace Vnext\TrainingModule\Controller\Adminhtml\Training;

class Index extends \Magento\Backend\App\Action
{
    private $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create(); // this crete an empty page 
        $resultPage->getConfig()->getTitle()->prepend(__('Page Created'));//this is your page heading 
        return $resultPage;// this show page
    }
}
