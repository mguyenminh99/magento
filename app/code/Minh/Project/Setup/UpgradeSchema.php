<?php
namespace Minh\Project\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
{
    $setup->startSetup();

    if (version_compare($context->getVersion(), '1.0.0') == -1) {

        $table = $setup->getTable('directory_country_region');

        $setup->getConnection()
            ->addIndex(
                $table,
                $setup->getIdxName(
                    $table,
                    [ 'code', 'default_name', 'country_id'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    
                ),
                [ 'code', 'default_name', 'country_id'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                
            )
        ;
    }

    $setup->endSetup();
}
}