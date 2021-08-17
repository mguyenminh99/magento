<?php
namespace Minh\Project\Model;
class Regions extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	protected function _construct()
	{
		$this->_init('Minh\Project\Model\ResourceModel\Regions');
	}

	public function getIdentities()
	{
		return [$this->getRegionId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}