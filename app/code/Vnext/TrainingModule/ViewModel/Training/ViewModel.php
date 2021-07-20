<?php

namespace Vnext\TrainingModule\ViewModel\Training;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class ViewModel implements ArgumentInterface
{
    protected $TrainingFactory;

    /**
     * @var TrainingRepositoryInterface
     */
    protected $TrainingRepository;

    /**
     * @var TrainingInterface
     */
    protected $TrainingModel;

    protected $TrainingCollectionFactory;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;


    /**
     * Test constructor.
     * @param \Vnext\TrainingModule\Model\TrainingFactory $TrainingFactory
     * @param \Vnext\TrainingModule\Api\Data\TrainingInterface $TrainingModel
     * @param \Vnext\TrainingModule\Api\TrainingRepositoryInterface $TrainingRepository,
     */
    public function __construct(
        \Vnext\TrainingModule\Model\TrainingFactory $TrainingFactory,
        \Vnext\TrainingModule\Api\Data\TrainingInterface $TrainingModel,
        \Vnext\TrainingModule\Api\TrainingRepositoryInterface $TrainingRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->TrainingFactory = $TrainingFactory;
        $this->TrainingModel = $TrainingModel;
        $this->TrainingRepository = $TrainingRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getListDataTraining()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $searchResult = $this->TrainingRepository->getStudentById(9);
        // $items = $searchResult->getItems();

        return $searchResult;

    }

    public function getTitle()
    {
      return 'Hello World';
    }

}