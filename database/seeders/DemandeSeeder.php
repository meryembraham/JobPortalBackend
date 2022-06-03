<?php

namespace Database\Seeders;

use App\Models\Demande;
use Illuminate\Database\Seeder;

class DemandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $demande = new Demande([
            'nom' => "demande 1",
        ]);
        $demande->save();
        $demande = new Demande([
            'nom' => "demande 2",
        ]);
        $demande->save();
        $demande = new Demande([
            'nom' => "demande 3",
        ]);
        $demande->save();
        $demande = new Demande([
            'nom' => "demande 4",
        ]);
        $demande->save();
        $demande = new Demande([
            'nom' => "demande 5",
        ]);
        $demande->save();
        $demande = new Demande([
            'nom' => "demande 6",
        ]);
        $demande->save();//
    }
}
