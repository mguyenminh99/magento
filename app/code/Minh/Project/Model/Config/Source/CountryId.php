<?php
namespace Minh\Project\Model\Config\Source;
use Minh\Project\Model\CountryFactory;

class CountryId implements \Magento\Framework\Option\ArrayInterface
{
    public $countryFactory;

    /**
     * @var \Magento\Framework\Convert\DataObject
     */
   
    public function __construct(
        CountryFactory $countryFactory

    )
    {
        $this->countryFactory = $countryFactory;

    }
   /**
     * Return array of options as value-label pairs, eg. value => label
     * @return array
     */
    public function toOptionArray()
    {  
        $country = $this->countryFactory->create()->getCollection();
        $arr = [];
        foreach ($country as $value){
            $arr[] = ['label' => $value['country_id'], 'value' => $value['country_id']];
        }
        return $arr;        
    }
}
