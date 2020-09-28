<?php
/**
 *StyleGuide NewPage Controller Page View.
 *@author Ivan Havryliuk ivan.havryliuk95@gmail.com.
 *@copyright 2020 worzewolf.
 */
namespace StyleGuide\NewPage\Controller\Index;
use Magento\Framework\App\Action\Context;
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;

    public function __construct(Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}
