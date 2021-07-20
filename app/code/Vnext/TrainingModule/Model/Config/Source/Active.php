<?php
namespace Vnext\TrainingModule\Model\Config\Source;


class Active implements \Magento\Framework\Option\ArrayInterface

{
     /**
     * Return array of options as value-label pairs, eg. value => label
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            'active' => 'Active',
            'disable' => 'Disable',
        ];
    }
}
