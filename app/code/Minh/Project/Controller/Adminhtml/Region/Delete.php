<?php

namespace Minh\Project\Controller\Adminhtml\Region;

use Magento\Backend\App\Action;
use Minh\Project\Model\ResourceModel\Regions\CollectionFactory;
use Minh\Project\Model\RegionsFactory;
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
        RegionsFactory $regionsFactory,
        Filter $filter,
        CollectionFactory $collectionFactory,
        RedirectFactory $redirectFactory
    )
    {
        parent::__construct($context);
        $this->regionsFactory = $regionsFactory;
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
            $deleteregions = $this->regionsFactory->create()->load($item->getData('region_id'));
            try {
                $deleteregions->delete();
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
        return $this->resultRedirect->create()->setPath('project/post/index');
    }
}
