<?php
namespace Custom\CategoryAttribute\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory.
     *
     * @var EavSetupFactory
     */
    private $_eavSetupFactory;
    protected $categorySetupFactory;

    /**
     * Init.
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory, \Magento\Catalog\Setup\CategorySetupFactory $categorySetupFactory)
    {
        $this->_eavSetupFactory = $eavSetupFactory;
        $this->categorySetupFactory = $categorySetupFactory;
    }

    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);
        $setup = $this->categorySetupFactory->create(['setup' => $setup]);    
        $setup->removeAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'mp_new_attribute' );          
        $eavSetup->addAttribute(
			\Magento\Catalog\Model\Category::ENTITY,
			'mp_new_attribute',
			[
				'type'         => 'varchar',
				'label'        => 'Mageplaza Attribute',
				'input'        => 'text',
				'sort_order'   => 100,
				'source'       => '',
				'global'       => 1,
				'visible'      => true,
				'required'     => false,
				'user_defined' => false,
				'default'      => null,
				'group'        => 'Custom Category Attribute content',
				'backend'      => ''
			]
		);
    }
}

?>