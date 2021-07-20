<?php

namespace Vnext\TrainingModule\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Vnext\TrainingModule\Model\TrainingFactory;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Save extends Action
{
    private $resultRedirect;
    private $studentFactory;

    public function __construct(
        Action\Context $context,
        TrainingFactory $studentFactory,
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
        $id = !empty($data['entity_id']) ? $data['entity_id'] : null;

        $newData = [
            'name' => $data['name'],
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'address' => $data['address'],
            'email' => $data['email'],
        ];

        $student = $this->studentFactory->create();
        if ($id) {
            $student->load($id);
            $this->getMessageManager()->addSuccessMessage(__('Edit thành công'));
        } else {
            $this->getMessageManager()->addSuccessMessage(__('Save thành công.'));
        }
        try{
            $student->addData($newData);
            $student->save();
            return $this->resultRedirect->create()->setPath('cms/post/index');
        }catch (\Exception $e){
            $this->getMessageManager()->addErrorMessage(__('Save thất bại.'));
        }
    }
}