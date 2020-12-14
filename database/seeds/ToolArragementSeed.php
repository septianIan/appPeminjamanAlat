<?php

use App\ToolArragement;
use Illuminate\Database\Seeder;

class ToolArragementSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'table' => 'lemari 1',
                'rak' => '1',
                'barcode' => '101010',
                'tool_id' => '1',
                'qty' => '5',
                'goodCondition' => '5',
                'badCondition' => '0'
            ],

            [
                'table' => 'lemari 1',
                'rak' => '2',
                'barcode' => '102010',
                'tool_id' => '2',
                'qty' => '5',
                'goodCondition' => '5',
                'badCondition' => '0'
            ],

            [
                'table' => 'lemari 2',
                'rak' => '3',
                'barcode' => '103010',
                'tool_id' => '4',
                'qty' => '5',
                'goodCondition' => '5',
                'badCondition' => '0'
            ],

            [
                'table' => 'lemari 2',
                'rak' => '4',
                'barcode' => '104010',
                'tool_id' => '5',
                'qty' => '5',
                'goodCondition' => '5',
                'badCondition' => '0'
            ],

            [
                'table' => 'lemari 3',
                'rak' => '5',
                'barcode' => '105010',
                'tool_id' => '6',
                'qty' => '5',
                'goodCondition' => '5',
                'badCondition' => '0'
            ],
        ];

        ToolArragement::insert($data);
    }
}
