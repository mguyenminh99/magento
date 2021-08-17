<?php
/**
 * Copyright © NinePoints Co., Ltd All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Minh\Project\Model\ResourceModel\Country;


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
            \Minh\Project\Model\Country::class,
            \Minh\Project\Model\ResourceModel\Country::class
        );
    }
}
