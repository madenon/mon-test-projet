<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'id' => 1,
                'name' => 'Bas-Rhin', 
                'region_id' => 1,
                'department_number' => 67,
            ],
            [
                'id' => 2,
                'name' => 'Haut-Rhin', 
                'region_id' => 1,
                'department_number' => 68,
            ]
        ];

        Department::insert($departments);
    }
}
