<?php

namespace Vnext\TrainingModule\Api;

use Vnext\TrainingModule\Api\Data\TrainingInterface;

interface TrainingRepositoryInterface
{
    /**
     * @param int $id
     * @return \Vnext\TrainingModule\Api\Data\TrainingInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Vnext\TrainingModule\Api\Data\TrainingInterface $Training
     * @return \Vnext\TrainingModule\Api\Data\TrainingInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Vnext\TrainingModule\Api\Data\TrainingInterface $Training);

    /**
     * @param \Vnext\TrainingModule\Api\Data\TrainingInterface $Training
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Vnext\TrainingModule\Api\Data\TrainingInterface $Training);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Vnext\TrainingModule\Api\Data\TrainingSearchResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
	 * GET for Post api
	 * @param string $param
	 * @return string
	 */
	
	//public function getPost($param);

    /**
     * @param int $id
     * @return \Vnext\TrainingModule\Api\Data\TrainingInterface
     */
    public function getStudentById($id);


    /**
     * @param int $id
     * @return \Vnext\TrainingModule\Api\Data\TrainingInterface
     */
    public function deleteById($id);

    /**
     * @param \Vnext\TrainingModule\Api\Data\TrainingInterface $student
     * @return \Vnext\TrainingModule\Api\Data\TrainingInterface
     */
    public function createStudent(\Vnext\TrainingModule\Api\Data\TrainingInterface $student);

    /**
     * @param \Vnext\TrainingModule\Api\Data\TrainingInterface $student
     * @return \Vnext\TrainingModule\Api\Data\TrainingInterface
     */
    public function updateStudent(\Vnext\TrainingModule\Api\Data\TrainingInterface $student);

    
}