<?php

use App\Student;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
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
                'nim' => '123',
                'name' => 'septain aditama',
                'majors' => 'TI',
                'address' => 'Bojonegoro'
            ],

            [
                'nim' => '1234',
                'name' => 'ian marmoyo',
                'majors' => 'TI',
                'address' => 'Bojonegoro'
            ],

            [
                'nim' => '12345',
                'name' => 'Yono',
                'majors' => 'TI',
                'address' => 'Bojonegoro'
            ],

            [
                'nim' => '123456',
                'name' => 'david',
                'majors' => 'TM',
                'address' => 'Bojonegoro'
            ],

            [
                'nim' => '1234567',
                'name' => 'setan',
                'majors' => 'TI',
                'address' => 'Bojonegoro'
            ],
        ];

        Student::insert($datas);
    }
}
