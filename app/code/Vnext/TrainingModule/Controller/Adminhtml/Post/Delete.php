<?php

namespace Vnext\TrainingModule\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Vnext\TrainingModule\Model\ResourceModel\Training\CollectionFactory;
use Vnext\TrainingModule\Model\TrainingFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Delete extends Action
{
    private $postFactory;
    private $filter;
    private $collectionFactory;
    private $resultRedirect;

    public function __construct(
        Action\Context $context,
        TrainingFactory $studentFactory,
        Filter $filter,
        CollectionFactory $collectionFactory,
        RedirectFactory $redirectFactory
    )
    {
        parent::__construct($context);
        $this->studentFactory = $studentFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resultRedirect = $redirectFactory;
    }

    public function execute()
    {

        $collection = $this->filter->getCollection($this->collectionFactory->create());
        
        $total = 0;
        $err = 0;
        foreach ($collection->getItems() as $item) {
            $deleteStudent = $this->studentFactory->create()->load($item->getData('entity_id'));
            try {
                $deleteStudent->delete();
                $total++;
            } catch (LocalizedException $exception) {
                $err++;
            }
        }

        if ($total) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $total)
            );
        }

        if ($err) {
            $this->messageManager->addErrorMessage(
                __(
                    'A total of %1 record(s) haven\'t been deleted. Please see server logs for more details.',
                    $err
                )
            );
        }
        return $this->resultRedirect->create()->setPath('cms/post/index');
    }
}

        // $this->messageManager->addErrorMessage(__("Error"));
		// $this->messageManager->addWarningMessage(__("Warning"));
		// $this->messageManager->addNoticeMessage(__("Notice"));
		// $this->messageManager->addSuccessMessage(__("Success"));