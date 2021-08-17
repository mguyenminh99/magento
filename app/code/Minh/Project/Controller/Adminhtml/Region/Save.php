<?php

namespace Minh\Project\Controller\Adminhtml\Region;

use Magento\Backend\App\Action;
use Minh\Project\Model\RegionsFactory;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Save extends Action
{
    private $resultRedirect;
    private $regionsFactory;

    public function __construct(
        Action\Context $context,
        RegionsFactory $regionsFactory,
        RedirectFactory $redirectFactory
    )
    {
        parent::__construct($context);
        $this->regionsFactory = $regionsFactory;
        $this->resultRedirect = $redirectFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['region_id']) ? $data['region_id'] : null;

        $newData = [
            'country_id' => $data['country_id'],
            'code' => $data['code'],
            'default_name' => $data['default_name']
        ];

        $regions = $this->regionsFactory->create();
        if ($id) {
            $regions->load($id);
            $this->getMessageManager()->addSuccessMessage(__('Edit thành công'));
        } else {
            $this->getMessageManager()->addSuccessMessage(__('Save thành công.'));
        }
        try{
            $regions->addData($newData);
            $regions->save();
            return $this->resultRedirect->create()->setPath('project/region/index');
        }catch (\Exception $e){
            $this->getMessageManager()->addErrorMessage(__('Save thất bại.'));
        }
    }
}