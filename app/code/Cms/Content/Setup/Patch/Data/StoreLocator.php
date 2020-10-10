<?php
/**
 * @package     Cms\Content
 * @version     1.0.0
 * @author Ivan Havryliuk ivan.havryliuk95@gmail.com.
 * @copyright 2020 worzewolf.
 */

namespace Cms\Content\Setup\Patch\Data;

use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

class StoreLocator implements DataPatchInterface
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
        $identifier = 'stores.locator';
        $blockData = [
            'title' => 'Stores Locator',
            'identifier' => $identifier,
            'content' => '
<div class="stores-service-wrap">
<div class="stores-locator"><a href="#" class="stores-locator-link">stores</a></div>
<div class="customer-service-wrapper">customer service
<div class="customer-service-dropdown"><span class="service-title">we\'re here to help</span>
<span>844-532-JMCL (5625) M-F, 9:30am - 5:30pm EST</span>
<ul>
<li><a href="#" class="customer-service-link">email us</a></li>
<li><a href="#" class="customer-service-link">contact us</a></li>
<li><a href="#" class="customer-service-link">track your order</a></li>
<li><a href="#" class="customer-service-link">return policy</a></li>
<li><a href="#" class="customer-service-link">sigh up for email</a></li>
<li><a href="#" class="customer-service-link">faq</a></li>
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
