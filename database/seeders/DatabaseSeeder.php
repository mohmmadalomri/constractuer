<?php

namespace Database\Seeders;

use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Profession;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaymentsSeeder::class);
//        $this->call(UserSeeder::class);
//        $this->call(CompanySeeder::class);
//        $this->call(ClientSeeder::class);
//        $this->call(ProjectSeeder::class);
//        $this->call(ExpenseSeeder::class);
//        $this->call(InvoiceSeeder::class);
//        $this->call(TeamSeeder::class);
//        $this->call(TaskSeeder::class);
//        $this->call(ItemSeeder::class);
//        $this->call(RequestSeeder::class);
//        $this->call(ProfessionSeeder::class);
//        $this->call(ExpenseSeeder::class);
//        $this->call(ProjectSeeder::class);
//        $this->call(InvoiceSeeder::class);
//        $this->call(TeamSeeder::class);
//        $this->call(JobSeeder::class);
//        $this->call(QuoteSeeder::class);








//        $admin = User::factory()->create();
//        $company = Company::factory()->create([
//            'user_id'=>$admin->id
//        ]);
//        $this->call(ProfessionSeeder::class);
//
//        $employee = Employee::factory()->count(10)->create([
//            'user_id'=>$admin->id,
//            'company_id'=>$company->id,
//            'profession_id'=>1
//        ]);
//        $user = User::factory()->count(10)->create([
//            'name' => Str::random(10),
//            'email' => Str::random(10) . '@email.com',
//            'phone' => Str::uuid(10),
//            'phone' => random_int(10, 98999),
//            'birth_day' => random_int(10, 98999),
//            'image' => Str::random(10),
//            'password' => Hash::make('password'),
//        ]);
//
//        $company = Company::factory()->count(10)->create([
//            'name' => Str::random(10),
//            'logo' => Str::random(10),
//            'email' => Str::random(10),
//            'phone' => Str::random(10),
//            'link_website' => Str::random(10),
//            'address_1' => Str::random(10),
//            'country' => Str::random(10),
//            'governorate' => Str::random(10),
//            'city' => Str::random(10),
//            'zip_code' => Str::random(10),
//            'user_id' => random_int(1, 10),
//        ]);
//
//
//        $profession = Profession::factory()->count(10)->create([
//            'name' => Str::random(10),
//            'describe' => Str::random(10),
//            'image' => Str::random(10),
//            'company_id' => 2,
//        ]);


//        DB::table('professions')->insert([
//            'name'=> \Illuminate\Support\Str::random(10),
//            'describe'=> \Illuminate\Support\Str::random(10),
//            'image'=> \Illuminate\Support\Str::random(10),
//            'company_id'=> 1,
//
//        ]);


    }


}
