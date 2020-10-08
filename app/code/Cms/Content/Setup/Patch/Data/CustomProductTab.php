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

class CustomProductTab implements DataPatchInterface
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
        $identifier = 'custom.product.tab';
        $blockData = [
            'title' => 'Custom Product Tab',
            'identifier' => $identifier,
            'content' => '
<p>Got questions? Need advice? Our customer service team is just a click or call away.</p>
<ul>
    <li>
        <a href="tel:8445325625">844-532-JMCL (5625)</a>
        <span>Monday-Friday, 9:30am - 5:30pm EST</span>
    </li>
    <li>
        <a href="#">Contact a Personal Stylist</a>
    </li>
    <li>
        <a href="#">customerservice@jmclaughlin.com</a>
    </li>
    <li>
        <a href="#">Live Chat</a>
    </li>
</ul>',
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
