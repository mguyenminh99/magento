<?php

namespace Vnext\TrainingModule\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $date;

    public function __construct(
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        $this->date = $date;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $dataSeen = [
            [
                'name' => 'An',
                'gender' => 'Nam',
                'address' => 'Ninh binh',
                'dob' => '1/1/1999',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'name' => 'Nam',
                'gender' => 'Nam',
                'address' => 'Ha Noi',
                'dob' => '1/2/1997',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'name' => 'Nữ',
                'gender' => 'Nữ',
                'address' => 'Ha Noi',
                'dob' => '1/3/1996',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'name' => 'Long',
                'gender' => 'Nam',
                'address' => 'Ha Noi',
                'dob' => '1/4/2021',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'name' => 'Ha',
                'gender' => 'Nam',
                'address' => 'Hai Phong',
                'dob' => '1/5/2012',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'name' => 'Canh',
                'gender' => 'Nam',
                'address' => 'Ninh Thuan',
                'dob' => '1/6/2015',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'name' => 'Lan',
                'gender' => 'Nữ',
                'address' => 'Ha noi',
                'dob' => '1/9/2020',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'name' => 'Vinh',
                'gender' => 'Nam',
                'address' => 'Ha noi',
                'dob' => '2/1/2001',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'name' => 'An',
                'gender' => 'Nam',
                'address' => 'Ha noi',
                'dob' => '1/1/2021',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'name' => 't1et',
                'gender' => 'Nam',
                'address' => 'Ninh binh',
                'dob' => '6/1/2002',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'name' => 'CB',
                'gender' => 'Nam',
                'address' => 'Ha noi',
                'dob' => '12/1/2020',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'name' => 'Co',
                'gender' => 'Nam',
                'address' => 'Ha noi',
                'dob' => '13/3/2021',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
        ];

        foreach($dataSeen as $data) {
            $setup->getConnection()->insert($setup->getTable('students'), $data);
        }
    }
}
?>