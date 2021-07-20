<?php
namespace Vnext\TrainingModule\Model\Config\Source;

class Training implements \Magento\Framework\Option\ArrayInterface
{
     /**
     * Return array of options as value-label pairs, eg. value => label
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            'entity_id' => 'ENTITY_ID',
            'name' => 'Name',
            'dob' => 'Date of birth'
        ];
    }
}
