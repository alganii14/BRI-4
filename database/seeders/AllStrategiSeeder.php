<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AllStrategiSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AumDpkSeeder::class,
            LayeringSeeder::class,
            MerchantSavolSeeder::class,
            NonDebiturVolBesarSeeder::class,
            OptimalisasiBusinessClusterSeeder::class,
            PenurunanMerchantSeeder::class,
            PenurunanPrioritasRitelMikroSeeder::class,
            PerusahaanAnakSeeder::class,
            QlolaNonDebiturSeeder::class,
            QlolaNonaktifSeeder::class,
            UserAktifCasaKecilSeeder::class,
            PenurunanCasaBrilinkSeeder::class,
        ]);
    }
}
