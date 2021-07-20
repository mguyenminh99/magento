<?php
namespace Vnext\TrainingModule\Block\Index;

use Vnext\TrainingModule\Model\TrainingFactory;

class Detail extends \Magento\Framework\View\Element\Template
{
    protected $trainingFactory;
    protected $studentNewsFactory;
    protected $collection;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        TrainingFactory $trainingFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->trainingFactory = $trainingFactory;
        $this->collection = $this->getCollection();
    }

    public function getCollection(){
        $collection = $this->trainingFactory->create()->getCollection();
        return $collection;
    }

    public function getStudent(){
        $student=($this->getRequest()->getParam('id'))? $this->getRequest()->getParam('id') : '';
        if($student != ''){
            return $this->trainingFactory->create()->load($student);
        }
        // else{
        //     return $this->redirectFactory->create()->setPath('404notfound');
        // }
    }

}
