<?php
/**
 * @package     StyleGuide\NewPage
 * @version     1.0.0
 * @author Ivan Havryliuk ivan.havryliuk95@gmail.com.
 * @copyright 2020 worzewolf.
 */

namespace StyleGuide\NewPage\Setup\Patch\Data;

use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

class FooterMainContainer implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * @var BlockRepositoryInterface
     */
    private $blockRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * AddNewCmsBlock constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param BlockFactory $blockFactory
     * @param BlockRepositoryInterface $blockRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockFactory $blockFactory,
        BlockRepositoryInterface $blockRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockFactory = $blockFactory;
        $this->blockRepository = $blockRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $identifier = 'footer.main';
        $blockData = [
            'title' => 'Footer Wrapper',
            'identifier' => $identifier,
            'content' => '<div class="footer-contacts">
<div class="text-item">We\'re here to help</div>
<div class="link-item"><a class="footer_help-link call" href="tel:111-111-1111">Call</a></div>
<div class="link-item"><a class="footer_help-link email">Email</a></div>
<div class="link-item"><a class="footer_help-link chat">Chat</a></div>
<div class="link-item"><a class="footer_help-link visit">Visit</a></div>
</div>
<div class="footer-links-wrap">
<div class="footer-navigation">
<div class="footer-links-col">
<h3 class="footer-heading">About Us</h3>
<ul class="footer-nav-list">
<li><a>Our Story</a></li>
<li><a>Our Stores</a></li>
<li><a>Careers</a></li>
<li><a>Brand Ambassador Program</a></li>
<li><a>Affiliate Program</a></li>
<li>&nbsp;</li>
</ul>
<h3 class="footer-heading">Shop</h3>
<ul class="footer-nav-list">
<li><a>Style Guide</a></li>
<li><a>Fabric Guide</a></li>
<li><a>Pant Guide</a></li>
</ul>
</div>
<div class="footer-links-col">
<h3 class="footer-heading">Customer Service</h3>
<ul class="footer-nav-list">
<li><a>Contact Us</a></li>
<li><a>FAQs</a></li>
<li><a>Gift Cards</a></li>
<li><a>Order Status</a></li>
<li><a>Shipping</a></li>
<li><a>Return Policy</a></li>
<li><a>Email Preferences</a></li>
<li><a>Accessibility View</a></li>
</ul>
</div>
<div class="footer-links-col">
<h3 class="footer-heading">Catalog</h3>
<ul class="footer-nav-list">
<li><a><img src="{{media url="logo/stores/1/catalog.jpg"}}" alt="Catalogue"></a></li>
<li><a>Request A Catalog</a></li>
<li><a>Unsubscribe From Catalog</a></li>
</ul>
</div>
<div class="footer-links-col">
<h3 class="footer-heading">Follow Us</h3>
<ul class="footer-nav-list footer-socials">
<li><a class="footer-social facebook">&nbsp;</a></li>
<li><a class="footer-social twitter">&nbsp;</a></li>
<li><a class="footer-social instagram">&nbsp;</a></li>
<li><a class="footer-social pinterest">&nbsp;</a></li>
<li><a class="footer-social youtube">&nbsp;</a></li>
</ul>
<h3 class="footer-heading">Read Our Blog</h3>
<ul class="footer-nav-list">
<li><a>The JMC Life</a></li>
</ul>
</div>
</div>
</div>',
            'is_active' => 1,
            'stores' => [1]
        ];

        $this->moduleDataSetup->startSetup();
        /* Save CMS Block logic */
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('identifier', $identifier)->create();
        $searchResult = $this->blockRepository->getList($searchCriteria);

        if ($searchResult->getTotalCount() > 0) {
            $items = $searchResult->getItems();
            $block = array_shift($items);
        } else {
            $block = $this->blockFactory->create();
        }
        $block->addData($blockData);
        $this->blockRepository->save($block);
        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '1.0.0';
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
