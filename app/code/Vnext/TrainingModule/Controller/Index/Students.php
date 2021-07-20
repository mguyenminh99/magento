<?php
namespace Vnext\TrainingModule\Controller\Index;
use Magento\Framework\View\Result\PageFactory;
class Students extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
    protected $scopeConfig;
    protected $helpEmail;
    protected $redirectFactory;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface  $scopeConfig,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        PageFactory $resultPageFactory,
        \Vnext\TrainingModule\Helper\Email $helpEmail
    )
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->redirectFactory = $redirectFactory;
        $this->scopeConfig  = $scopeConfig;
        $this->helpEmail = $helpEmail;

    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $active = $this->scopeConfig->getValue('section_training/general/enable_active', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if($active == 'disable'){
            return $this->redirectFactory->create()->setPath('404notfound');
        }
        // return $this->helpEmail->sendEmail();

        return $this->_pageFactory->create();
    }
}
