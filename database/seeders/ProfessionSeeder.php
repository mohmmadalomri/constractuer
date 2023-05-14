<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Profession::factory()->count(20)->create();

//        $professions=[
//            [
//                'name'=>'superadmin',
//                'describe'=>'idasofdihsap',
//                'image'=>'url_image',
//                'company_id'=>1
//            ],
//            [
//                'name'=>'admin',
//                'describe'=>'idasofdihsap',
//                'image'=>'url_image',
//                'company_id'=>1
//            ],
//            [
//                'name'=>'editor',
//                'describe'=>'idasofdihsap',
//                'image'=>'url_image',
//                'company_id'=>1
//            ],
//            [
//                'name'=>'engineer',
//                'describe'=>'idasofdihsap',
//                'image'=>'url_image',
//                'company_id'=>1
//            ],
//            [
//                'name'=>'supervisor',
//                'describe'=>'idasofdihsap',
//                'image'=>'url_image',
//                'company_id'=>1
//            ],
//            [
//                'name'=>'Account manager',
//                'describe'=>'idasofdihsap',
//                'image'=>'url_image',
//                'company_id'=>1
//            ],
//            [
//                'name'=>'Accountant',
//                'describe'=>'idasofdihsap',
//                'image'=>'url_image',
//                'company_id'=>1
//            ],
//            [
//                'name'=>'employee',
//                'describe'=>'idasofdihsap',
//                'image'=>'url_image',
//                'company_id'=>1
//            ],
//        ];
//
//        Profession::insert($professions);
    }
}
