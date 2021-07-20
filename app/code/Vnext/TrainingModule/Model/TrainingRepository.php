<?php

namespace Vnext\TrainingModule\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vnext\TrainingModule\Api\Data\TrainingInterface;
use Vnext\TrainingModule\Api\Data\TrainingSearchResultInterfaceFactory;
use Vnext\TrainingModule\Api\TrainingRepositoryInterface;
use Vnext\TrainingModule\Model\ResourceModel\Training;
use Vnext\TrainingModule\Model\ResourceModel\Training\CollectionFactory;
use Magento\Framework\App\RequestInterface;

/**
 * Class TrainingRepository
 * @author Suman kar(suman.jis@gmail.com)
 */
class TrainingRepository implements TrainingRepositoryInterface
{

    /**
     * @var TrainingFactory
     */
    private $TrainingFactory;

    /**
     * @var Training
     */
    private $TrainingResource;

    /**
     * @var TrainingCollectionFactory
     */
    private $TrainingCollectionFactory;

    /**
     * @var TrainingSearchResultInterfaceFactory
     */
    private $searchResultFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var RequestInterface
     */
    protected $request;

    public function __construct(
        TrainingFactory $TrainingFactory,
        Training $TrainingResource,
        CollectionFactory $TrainingCollectionFactory,
        TrainingSearchResultInterfaceFactory $TrainingSearchResultInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        RequestInterface $request
    ) {
        $this->TrainingFactory = $TrainingFactory;
        $this->TrainingResource = $TrainingResource;
        $this->TrainingCollectionFactory = $TrainingCollectionFactory;
        $this->searchResultFactory = $TrainingSearchResultInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->request = $request;
    }

    /**
     * @param int $id
     * @return \Vnext\TrainingModule\Api\Data\TrainingInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id)
    {
        $Training = $this->TrainingFactory->create();
        $this->TrainingResource->load($Training, $id);
        if (!$Training->getId()) {
            throw new NoSuchEntityException(__('Unable to find Training with ID "%1"', $id));
        }
        return $Training;
    }

    /**
     * @param \Vnext\TrainingModule\Api\Data\TrainingInterface $Training
     * @return \Vnext\TrainingModule\Api\Data\TrainingInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(TrainingInterface $Training)
    {
        $this->TrainingResource->save($Training);
        return $Training;
    }

    /**
     * @param \Vnext\TrainingModule\Api\Data\TrainingInterface $Training
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(TrainingInterface $Training)
    {
        try {
            $this->TrainingResource->delete($Training);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }

        return true;

    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Vnext\TrainingModule\Api\Data\TrainingSearchResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->TrainingCollectionFactory->create();
        // foreach ($filter as $key=>$item){
        //     $collection->addFieldToFilter($key, $item);
        // }
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }

    /**
     * @param int $id
     * @return \Vnext\TrainingModule\Api\Data\TrainingInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStudentById($id)
    {
        $training = $this->TrainingFactory->create();
        $this->TrainingResource->load($training, $id);
        if (!$training->getId()) {
            throw new NoSuchEntityException(__('Unable to find Training with ID "%1"', $id));
        }
        return $training;
    }

    /**
     * @param int $id
     * @return \Vnext\TrainingModule\Api\Data\TrainingInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById($id)
    {
        $training = $this->TrainingFactory->create();
        $training->load($id);
        $training->delete();
    }

     /**
     * @param \Vnext\TrainingModule\Api\Data\TrainingInterface $student
     * @return \Vnext\TrainingModule\Api\Data\TrainingInterface
     */
    public function createStudent(TrainingInterface $student)
    {
        $this->TrainingResource->save($student);
        return $student;
        
    }

     /**
      * @param \Vnext\TrainingModule\Api\Data\TrainingInterface $student
      * @return \Vnext\TrainingModule\Api\Data\TrainingInterface
      */
    public function updateStudent(TrainingInterface $student){
        $id = $student->getEntityId();
        $query = $this->TrainingFactory->create()->getCollection()->addFieldToFilter('entity_id', $id)->getFirstItem();
        if($query->getData()){
                $query->setData('name', $student->getName());
                $query->setData('email', $student->getEmail());
                $query->setData('address', $student->getAddress());
                $query->setData('gender', $student->getGender());
                $query->setData('slug', $student->getSlug());
                $query->save();
            } 
        return $query;

    }

}