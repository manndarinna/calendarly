<?php

use App\Konsultacija;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KonsultacijaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);
        $k1 = Konsultacija::create([
            'naziv' => Str::random(20),
            'opis' => Str::random(135),
            'zakazao_id' => 1,
            'datum' => Carbon::today()->addDays(rand(6, 365))->addHours(rand(0, 100)),
            'max_prijava' => 10,
            'broj_prijava' => 0

        ]);
        $k1->prijavljeni()->attach([$user2->id, $user3->id]);
        $k1->povecaj();
        $k1->povecaj();

        $k2 = Konsultacija::create([
            'naziv' => Str::random(20),
            'opis' => Str::random(135),
            'zakazao_id' => 2,
            'datum' => Carbon::today()->addDays(rand(6, 365))->addHours(rand(0, 100)),
            'max_prijava' => 10,
            'broj_prijava' => 0

        ]);
        $k2->prijavljeni()->attach([$user3->id, $user1->id]);
        $k2->povecaj();
        $k2->povecaj();

        $k3 = Konsultacija::create([
            'naziv' => Str::random(20),
            'opis' => Str::random(135),
            'zakazao_id' => 3,
            'datum' => Carbon::today()->addDays(rand(6, 365))->addHours(rand(0, 100)),
            'max_prijava' => 10,
            'broj_prijava' => 0

        ]);
        $k3->prijavljeni()->attach([$user2->id, $user1->id]);
        $k3->povecaj();
        $k3->povecaj();

        $k4 = Konsultacija::create([
            'naziv' => Str::random(20),
            'opis' => Str::random(135),
            'zakazao_id' => 3,
            'datum' => Carbon::today()->addDays(rand(6, 365))->addHours(rand(0, 100)),
            'max_prijava' => 10,
            'broj_prijava' => 0

        ]);
        $k4->prijavljeni()->attach([$user2->id, $user1->id]);
        $k4->povecaj();
        $k4->povecaj();
    }
}
