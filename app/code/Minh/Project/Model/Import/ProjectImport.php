<?php
/**
* Created by PhpStorm.
* User: admin
* Date: 6/11/20
* Time: 1:52 PM
*/

namespace Minh\Project\Model\Import;

use Minh\Project\Model\Import\ProjectImport\RowValidatorInterface as ValidatorInterface;
use Magento\ImportExport\Model\Import\ErrorProcessing\ProcessingErrorAggregatorInterface;
use Magento\Framework\App\ResourceConnection;

class ProjectImport extends \Magento\ImportExport\Model\Import\Entity\AbstractEntity
{
    const ID = 'region_id';
    const COUNTRY_ID = 'country_id';
    const CODE = 'code';
    const DEFAULT_NAME = 'default_name';
    const TABLE_Entity = 'directory_country_region';
    /** * Validation failure message template definitions * * @var array */
    protected $_messageTemplates = [ ValidatorInterface::ERROR_TITLE_IS_EMPTY => 'Name is empty',
];

   protected $_permanentAttributes = [self::ID];
   /**
    * If we should check column names
    *
    * @var bool
    */
   protected $needColumnCheck = true;
    /**
     * @var \Magento\Customer\Model\GroupFactory
     */
   protected $groupFactory;
   /**
    * Valid column names
    *
    * @array
    */
   protected $validColumnNames = [
       self::ID,
       self::COUNTRY_ID,
       self::CODE,
       self::DEFAULT_NAME,
   ];

   /**
    * Need to log in import history
    *
    * @var bool
    */
   protected $logInHistory = true;

   protected $_validators = [];


   /**
    * @var \Magento\Framework\Stdlib\DateTime\DateTime
    */
   protected $_connection;
   protected $_resource;

    /**
     * CustomImport constructor.
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     * @param \Magento\ImportExport\Helper\Data $importExportData
     * @param \Magento\ImportExport\Model\ResourceModel\Import\Data $importData
     * @param ResourceConnection $resource
     * @param \Magento\ImportExport\Model\ResourceModel\Helper $resourceHelper
     * @param \Magento\Framework\Stdlib\StringUtils $string
     * @param ProcessingErrorAggregatorInterface $errorAggregator
     * @param \Magento\Customer\Model\GroupFactory $groupFactory
     */
   public function __construct(
       \Magento\Framework\Json\Helper\Data $jsonHelper,
       \Magento\ImportExport\Helper\Data $importExportData,
       \Magento\ImportExport\Model\ResourceModel\Import\Data $importData,
       \Magento\Framework\App\ResourceConnection $resource,
       \Magento\ImportExport\Model\ResourceModel\Helper $resourceHelper,
       \Magento\Framework\Stdlib\StringUtils $string,
       ProcessingErrorAggregatorInterface $errorAggregator,
       \Magento\Customer\Model\GroupFactory $groupFactory
   ) {
       $this->jsonHelper = $jsonHelper;
       $this->_importExportData = $importExportData;
       $this->_resourceHelper = $resourceHelper;
       $this->_dataSourceModel = $importData;
       $this->_resource = $resource;
       $this->_connection = $resource->getConnection(\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION);
       $this->errorAggregator = $errorAggregator;
       $this->groupFactory = $groupFactory;
   }


   public function getValidColumnNames()
   {
       return $this->validColumnNames;
   }

   /**
    * Entity type code getter.
    *
    * @return string
    */
   public function getEntityTypeCode()
   {
       return 'directory_country_region';
   }

   /**
    * Row validation.
    *
    * @param array $rowData
    * @param int $rowNum
    * @return bool
    */
   public function validateRow(array $rowData, $rowNum)
   {
       if (isset($this->_validatedRows[$rowNum])) {
           return !$this->getErrorAggregator()->isRowInvalid($rowNum);
       }
       $this->_validatedRows[$rowNum] = true;
       return !$this->getErrorAggregator()->isRowInvalid($rowNum);
   }

   /**
    * Create Advanced message data from raw data.
    *
    * @throws \Exception
    * @return bool Result of operation.
    */
   protected function _importData()
   {
       $this->saveEntity();
       return true;
   }
   /**
    * Save entity
    *
    * @return $this
    */
   public function saveEntity()
   {
       $this->saveAndReplaceEntity();
       return $this;
   }

   /**
    * Replace entity data
    *
    * @return $this
    */
   public function replaceEntity()
   {
       $this->saveAndReplaceEntity();
       return $this;
   }
   /**
    * Deletes entity data from raw data.
    *
    * @return $this
    */
   public function deleteEntity()
   {
       $listTitle = [];
       while ($bunch = $this->_dataSourceModel->getNextBunch()) {
           foreach ($bunch as $rowNum => $rowData) {
               $this->validateRow($rowData, $rowNum);
               if (!$this->getErrorAggregator()->isRowInvalid($rowNum)) {
                   $rowTtile = $rowData[self::ID];
                   $listTitle[] = $rowTtile;
               }
               if ($this->getErrorAggregator()->hasToBeTerminated()) {
                   $this->getErrorAggregator()->addRowToSkip($rowNum);
               }
           }
       }
       if ($listTitle) {
           $this->deleteEntityFinish(array_unique($listTitle),self::TABLE_Entity);
       }
       return $this;
   }

   /**
    * Save and replace entity
    *
    * @return $this
    * @SuppressWarnings(PHPMD.CyclomaticComplexity)
    * @SuppressWarnings(PHPMD.NPathComplexity)
    */
   protected function saveAndReplaceEntity()
   {
       $behavior = $this->getBehavior();
       $listTitle = [];
       while ($bunch = $this->_dataSourceModel->getNextBunch()) {
           $entityList = [];
           foreach ($bunch as $rowNum => $rowData) {
               if (!$this->validateRow($rowData, $rowNum)) {
                   $this->addRowError(ValidatorInterface::ERROR_TITLE_IS_EMPTY, $rowNum);
                   continue;
               }
               if ($this->getErrorAggregator()->hasToBeTerminated()) {
                   $this->getErrorAggregator()->addRowToSkip($rowNum);
                   continue;
               }

               $rowTtile= $rowData[self::ID];
               $listTitle[] = $rowTtile;
               $entityList[$rowTtile][] = [
                   self::ID => $rowData[self::ID],
                   self::COUNTRY_ID => $rowData[self::COUNTRY_ID],
                   self::CODE => $rowData[self::CODE],
                   self::DEFAULT_NAME => $rowData[self::DEFAULT_NAME],
               ];
           }
           if (\Magento\ImportExport\Model\Import::BEHAVIOR_REPLACE == $behavior) {
               if ($listTitle) {
                   if ($this->deleteEntityFinish(array_unique(  $listTitle), self::TABLE_Entity)) {
                       $this->saveEntityFinish($entityList, self::TABLE_Entity);
                   }
               }
           } elseif (\Magento\ImportExport\Model\Import::BEHAVIOR_APPEND == $behavior) {
               $this->saveEntityFinish($entityList, self::TABLE_Entity);
           }
       }
       return $this;
   }

   /**
    * Save custom data.
    *
    * @param array $entityData
    * @param string $table
    * @return $this
    */
   protected function saveEntityFinish(array $entityData, $table)
   {
       if ($entityData) {
           $tableName = $this->_connection->getTableName($table);
           $entityIn = [];
           foreach ($entityData as $id => $entityRows) {
               foreach ($entityRows as $row) {
                   $entityIn[] = $row;
               }
           }
           if ($entityIn) {
               $this->_connection->insertOnDuplicate($tableName, $entityIn,[
                   self::ID,
                   self::COUNTRY_ID,
                   self::CODE,
                   self::DEFAULT_NAME
               ]);
           }
       }
       return $this;
   }

   /**
    * Delete custom data.
    *
    * @param array $entityData
    * @param string $table
    * @return $this
    */
   protected function deleteEntityFinish(array $ids, $table)
   {
       if ($table && count($ids) > 0) {
           try {
               $this->countItemsDeleted += $this->_connection->delete(
                   $this->_connection->getTableName($table),
                   $this->_connection->quoteInto('id IN (?)', $ids)
               );
               return true;
           } catch (\Exception $e) {
               return false;
           }

       } else {
           return false;
       }
   }
}
