<?php
namespace Minh\Project\Model;

class Country extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    protected function _construct()
	{
		$this->_init('Minh\Project\Model\ResourceModel\Country');
	}

	public function getIdentities()
	{
		return [$this->getCountryId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}
