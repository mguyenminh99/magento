<?php
namespace Vnext\TrainingModule\Model\Config\Source;

class Sort implements \Magento\Framework\Option\ArrayInterface

{
     /**
     * Return array of options as value-label pairs, eg. value => label
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            'desc' => 'DESC',
            'asc' => 'ASC',
        ];
    }
}
