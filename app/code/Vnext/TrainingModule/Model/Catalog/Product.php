<?php
namespace Vnext\TrainingModule\Model\Catalog;

use Magento\TestFramework\Event\Magento;

class Product extends \Magento\Catalog\Model\Product
{
    
   /**
    * rewrite function getName
    */
    public function getName(){
        $name = $this->_getData(self::NAME);
        $sku = $this->_getData(self::SKU);
        return $name . ' - ' . $sku;
    }

   
}
