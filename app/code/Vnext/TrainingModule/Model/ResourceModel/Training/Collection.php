<?php
/**
 * Copyright © NinePoints Co., Ltd All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vnext\TrainingModule\Model\ResourceModel\Training;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'localstore_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Vnext\TrainingModule\Model\Training::class,
            \Vnext\TrainingModule\Model\ResourceModel\Training::class
        );
    }
}
