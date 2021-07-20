<?php
namespace Vnext\TrainingModule\Block\Index;
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
        //get values of current page
        $sort_by = $this->scopeConfig->getValue('section_training/general/enable2', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $sort_order = $this->scopeConfig->getValue('section_training/general/enable3', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $page_size = $this->scopeConfig->getValue('section_training/general/enable4', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        // $active = $this->scopeConfig->getValue('section_training/general/enable_active', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        // if($active == 'disable'){
        //     return $this->redirectFactory->create()
        //     ->setPath('404notfound');

        // }
        $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;

        $name=($this->getRequest()->getParam('name'))? $this->getRequest()->getParam('name') : '';

        $gender=($this->getRequest()->getParam('gender'))? $this->getRequest()->getParam('gender') : '';

        $entity_id=($this->getRequest()->getParam('entity_id'))? $this->getRequest()->getParam('entity_id') : '';

        $sort=($this->getRequest()->getParam('sort'))? $this->getRequest()->getParam('sort') : '';

        $from=($this->getRequest()->getParam('from'))? $this->getRequest()->getParam('from') : '';

        $to=($this->getRequest()->getParam('to'))? $this->getRequest()->getParam('to') : '';



        //get values of current limit
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : $page_size;
        $collection = $this->collection;
        if(isset($sort_order) && isset($sort_by)){
            $collection->setOrder($sort_by , $sort_order);
        }
     
        //$collection = $this->studentNewsFactory->getCollection();
        // $collection->getSelect()->columns( array("age" => new Zend_Db_Exđsdsdpr("(SELECT datediff(YY,dob,getdate()) as age FROM student")) );
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        if($from != ''){
            $collection->addFieldToFilter('dob' ,['gteq' => $from] );
        }
        if($to != ''){
            $collection->addFieldToFilter('dob' ,['lteq' => $to] );
        }

        if($name != ''){
            $collection->addFieldToFilter('name' , $name);
        }
        if($gender != ''){
            $collection->addFieldToFilter('gender' , $gender);
        }
        if($sort != ''){
            if($sort == 1){
                $collection->setOrder('entity_id','desc');
            }
            elseif($sort == 3){
                $collection->setOrder('dob' , 'desc');
            }
            elseif($sort == 2){
                $collection->setOrder('name' , 'desc');
            }
        }
        if($entity_id != ''){
            $collection->addFieldToFilter('entity_id', $entity_id);
        }


        return $collection;

        
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('STUDENT'));


        if ($this->getListNews()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'student.pager'
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

    public function deleteById($id){
        $training = $this->studentNewsFactory->create();
        $training->load($id);
        $training->delete();
      
    }
   
}