<?php

use App\PrivatanCas;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PrivatanCasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PrivatanCas::create([
            'zakazao_id' => 1,
            'rezervisao_id' => 2,
            'datum' => Carbon::today()->addDays(rand(6, 365)),
            'trajanje' => rand(3600, 10800),
        ]);
        PrivatanCas::create([
            'zakazao_id' => 2,
            'rezervisao_id' => 3,
            'datum' => Carbon::today()->addDays(rand(6, 365)),
            'trajanje' => rand(3600, 10800),
        ]);
        PrivatanCas::create([
            'zakazao_id' => 3,
            'rezervisao_id' => 2,
            'datum' => Carbon::today()->addDays(rand(6, 365)),
            'trajanje' => rand(3600, 10800),
        ]);
        PrivatanCas::create([
            'zakazao_id' => 3,
            'rezervisao_id' => 1,
            'datum' => Carbon::today()->addDays(rand(6, 365)),
            'trajanje' => rand(3600, 10800),
        ]);
    }
}
