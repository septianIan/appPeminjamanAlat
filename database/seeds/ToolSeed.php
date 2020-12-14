<?php

use App\Tool;
use Illuminate\Database\Seeder;

class ToolSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'toolName' => 'Earmuff',
                'specification' => 'Spek Earmuff',
                'fund' => 'H'
            ],

            [
                'toolName' => 'Bor',
                'specification' => 'Spek Bor',
                'fund' => 'H'
            ],

            [
                'toolName' => 'Wellding Goggles',
                'specification' => 'Spek Wellding Goggles',
                'fund' => 'H'
            ],

            [
                'toolName' => 'Wellding Golves',
                'specification' => 'Spek Wellding Golves',
                'fund' => 'M'
            ],

            [
                'toolName' => 'Hose Compesor',
                'specification' => 'Spek Hose Compesor',
                'fund' => 'M'
            ],

            [
                'toolName' => 'Angle Grinder',
                'specification' => 'Spek Angle Grinder',
                'fund' => 'M'
            ],
        ];

        Tool::insert($datas);
    }
}
