<?php

namespace Vnext\TrainingModule\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Vnext\TrainingModule\Model\TrainingFactory;
use Minh\Project\Model\ResourceModel\Regions\CollectionFactory;
use Minh\Project\Model\RegionsFactory;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Save extends Action
{
    private $resultRedirect;
    private $studentFactory;

    public function __construct(
        Action\Context $context,
        RegionsFactory $studentFactory,
        RedirectFactory $redirectFactory
    )
    {
        parent::__construct($context);
        $this->studentFactory = $studentFactory;
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

        $student = $this->studentFactory->create();
        if ($id) {
            $student->load($id);
            $this->getMessageManager()->addSuccessMessage(__('Edit thành công'));
        } 
        try{
            if($student->getCollection()->addFieldToFilter('default_name', ['eq' => $data['default_name']])){
                $this->getMessageManager()->addErrorMessage(__('Default Name đã tồn tại '));
                return $this->resultRedirect->create()->setPath('project/post/new');
                $student->getCollection()->getSelect()->reset(\Magento\Framework\DB\Select::WHERE);
                if($student->getCollection()->addFieldToFilter('code' , ['eq' => $data['code']])->addFieldToFilter('country_id' , ['eq' => $data['country_id']])){
                    $this->getMessageManager()->addErrorMessage(__('Code đã tồn tại tại country '));
                    return $this->resultRedirect->create()->setPath('project/post/new');
                }
            }else{
                $student->addData($newData);
                $student->save();
                return $this->resultRedirect->create()->setPath('project/post/index');
            }
        }catch (\Exception $e){
            $this->getMessageManager()->addErrorMessage(__('Save thất bại.'));
        }
    }
}