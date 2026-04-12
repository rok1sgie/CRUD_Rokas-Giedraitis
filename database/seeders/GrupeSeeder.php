<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grupe;

class GrupeSeeder extends Seeder
{
    public function run(): void
    {
        $grupes = [
            ['kodas' => 'PS24', 'pavadinimas' => 'Programų sistemos 24'],
            ['kodas' => 'IST24', 'pavadinimas' => 'Informacinių sistemų technologijos 24'],
            ['kodas' => 'IST25', 'pavadinimas' => 'Informacinių sistemų technologijos 25'],
        ];

        foreach ($grupes as $grupe) {
            Grupe::firstOrCreate(
                ['kodas' => $grupe['kodas']],
                ['pavadinimas' => $grupe['pavadinimas']]
            );
        }
    }
}