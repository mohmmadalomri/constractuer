<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use App\Models\Project;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create();
        $company = Company::factory()->create([
            'user_id'=>$admin->id
        ]);
        $this->call(ProfessionSeeder::class);
        
        $employee = Employee::factory()->create([
            'user_id'=>$admin->id,
            'company_id'=>$company->id,
            'profession_id'=>1
        ]);
    
        

    }
}
