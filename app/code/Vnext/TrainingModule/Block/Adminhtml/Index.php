<?php
namespace Vnext\TrainingModule\Block\Adminhtml;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Element\Template;
use \Magento\Framework\Exception\NotFoundException;


class Index extends \Magento\Framework\View\Element\Template
{
    protected $studentNewsFactory;

    protected $_query;

    protected $collection;
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface  $scopeConfig,
        \Magento\Framework\View\Element\Template\Context $context,
        \Vnext\TrainingModule\Model\TrainingFactory $studentNewsFactory,
        array $data = []
    ) {

        parent::__construct($context, $data);
        $this->studentNewsFactory = $studentNewsFactory;
        $this->collection = $this->getStudentCollection();
        $this->scopeConfig  = $scopeConfig;
    }

    public function getStudent(){
        return __('TrainingContent');
    }

    public function getStudentCollection(){
        $collection = $this->studentNewsFactory->create()->getCollection();
        return $collection;
    }


    public function getListNews()
    {
        //get values of current limit
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 5;
        $collection = $this->collection;
        if(isset($sort_order) && isset($sort_by)){
            $collection->setOrder($sort_by , $sort_order);
        }
    
        $collection->setPageSize($pageSize);

        return $collection;

        
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('STUDENT'));


        if ($this->getListNews()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'students.pager'
            )->setAvailableLimit(array(5=>5,))->setShowPerPage(true)->setCollection(
                $this->getListNews()
            );
            $this->setChild('pager', $pager);
            $this->getListNews()->load();
        }
        return $this;
    }
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
   
}