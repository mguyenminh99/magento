<?php

namespace Vnext\TrainingModule\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface TrainingSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Vnext\TrainingModule\Api\Data\TrainingInterface[]
     */
    public function getItems();

    /**
     * @param \Vnext\TrainingModule\Api\Data\TrainingInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}