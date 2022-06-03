<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User([
            'nom' => "admin",
            'prenom' => "adminp",
            'password' => Hash::make("123456789"),
            'email' => "admin1@gmail.com",
            'role' => 'admin',
            'status'=>'active',
        ]);
        $admin->save();
       
        $entreprise = new User([
            'nom' => "atti",
            'prenom' => "ali",
            'password' => Hash::make("123456789"),
            'email' => "entreprise1@gmail.com",
            'role' => 'entreprise',
            'status'=>'active',
        ]);
        $entreprise->save();
        $entreprise = new User([
            'nom' => "behi",
            'prenom' => "hajer",
            'password' => Hash::make("123456789"),
            'email' => "behihajer@gmail.com",
            'role' => 'entreprise',
            'status'=>'active',
        ]);
        $entreprise->save();
        $entreprise = new User([
            'nom' => "moldi",
            'prenom' => "youssef",
            'password' => Hash::make("123456789"),
            'email' => "moldiyoussef@gmail.com",
            'role' => 'entreprise',
            'status'=>'active',
        ]);
        $entreprise->save();
        $entreprise = new User([
            'nom' => "seher",
            'prenom' => "nadhir",
            'password' => Hash::make("123456789"),
            'email' => "sehernadhir@gmail.com",
            'role' => 'entreprise',
            'status'=>'active',
        ]);
        $entreprise->save();
        $entreprise = new User([
            'nom' => "dridi",
            'prenom' => "mohamed",
            'password' => Hash::make("123456789"),
            'email' => "dridimohamed@gmail.com",
            'role' => 'entreprise',
            'status'=>'active',
        ]);
        $entreprise->save();
        $candidat = new User([
            'nom' => "meli",
            'prenom' => "ahmed",
            'password' => Hash::make("123456789"),
            'email' => "meliahmed@gmail.com",
            'role' => 'candidat',
            'status'=>'active',
        ]);
        $candidat->save();
        $candidat = new User([
            'nom' => "koli",
            'prenom' => "meryem",
            'password' => Hash::make("123456789"),
            'email' => "kolimeryem@gmail.com",
            'role' => 'candidat',
            'status'=>'active',
        ]);
        $candidat->save();
        $candidat = new User([
            'nom' => "miledi",
            'prenom' => "hedi",
            'password' => Hash::make("123456789"),
            'email' => "miledihedi@gmail.com",
            'role' => 'candidat',
            'status'=>'active',

        ]);
        $candidat->save();
        $candidat = new User([
            'nom' => "mokni",
            'prenom' => "salma",
            'password' => Hash::make("123456789"),
            'email' => "moknisalma@gmail.com",
            'role' => 'candidat',
            'status'=>'active',
        ]);
        $candidat->save();
        $candidat = new User([
            'nom' => "samed",
            'prenom' => "ahlem",
            'password' => Hash::make("123456789"),
            'email' => "samedahlem@gmail.com",
            'role' => 'candidat',
            'status'=>'active',
        ]);
        $candidat->save();
        $candidat = new User([
            'nom' => "hajji",
            'prenom' => "adel",
            'password' => Hash::make("123456789"),
            'email' => "hajjiadel@gmail.com",
            'role' => 'candidat',
            'status'=>'active',
        ]);
        $candidat->save();


    }
}
