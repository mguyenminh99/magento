<?php
namespace Vnext\TrainingModule\Plugin\Magento\Catalog\Model\Product;

class Product 
{

    public function afterGetPrice(\Magento\Catalog\Model\Product $subject ,$price){
       $price = 20000;
       return $price;
     }

    public function afterGetSku(\Magento\Catalog\Model\Product $subject, $price){
        $price = 'vnext';
        return $price;
    }

    public function afterGetName(\Magento\Catalog\Model\Product $subject,$name)
    {
        return "Minh - " . $name;
    }
}
