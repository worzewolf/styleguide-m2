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

class FooterBottomLinks implements DataPatchInterface
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
        $identifier = 'footer.bottom';
        $blockData = [
            'title' => 'Footer Bottom',
            'identifier' => $identifier,
            'content' => '<div class="item">&nbsp;</div>
<div class="footer-logo item"><a>Privacy</a> <img src="{{media url="logo/stores/1/logo-abrev.png"}}" alt="small-logo" width="32" height="32"> <a>Terms</a></div>',
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
