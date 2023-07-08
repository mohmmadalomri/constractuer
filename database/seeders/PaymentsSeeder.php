<?php

namespace Database\Seeders;

use App\Models\PaymentSeeder;
use App\Models\Request;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_seeders')->delete();

        $payment_seeder = [
            [
                'name' => 'paypal'
            ],
            [
                'name' => 'cheque'
            ],
            [
                'name' => 'Bank transfer'
            ],
            [
                'name' => 'hand by hand'
            ]
        ];

        foreach ($payment_seeder as $n) {
            DB::table('payment_seeders')->insert($n);
        }
    }
}

