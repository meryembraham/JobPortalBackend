<?php

namespace Database\Seeders;

use App\Models\Condidat;
use Illuminate\Database\Seeder;

class CondidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candidat = new Condidat([
            'user_id' =>7,
            'avatar' =>"photo",
            'tel' =>232425,
            'niveau'=>'etudiant',
            'secteur_id'=>2,

            'competences' => 'competence',
            'ville'=>'ksar hellal',
            'langues' =>'anglais, français, arabe',

            'bio' => "Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless. Some quick example text to build on the card title and bulk the card's content Moltin gives you platform.

            As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience lies in successfully conceptualizing, designing, and modifying consumer products specific to interior design and home furnishings.",
            'region_id' =>4,
            'civilite' => 'homme',
            'date_de_naissance'=>'25-01-2000',


        ]);
        $candidat->save();
        $candidat = new Condidat([
            'user_id' =>8,
            'avatar' =>"avatar",
            'tel' =>232425,

            'niveau'=>'etudiant',
            'secteur_id'=>1,
            'ville'=>'ville',
            'competences' => 'competences',

            'langues' =>'anglais, français, arabe',
            'bio' =>  "Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless. Some quick example text to build on the card title and bulk the card's content Moltin gives you platform.

            As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience lies in successfully conceptualizing, designing, and modifying consumer products specific to interior design and home furnishings.",
            'region_id' =>19,
            'civilite' => 'femme',
            'date_de_naissance'=>'25-01-2000',
           
            
        ]);
        $candidat->save();
        $candidat = new Condidat([
            'user_id' =>9,
            'avatar' =>"avatar",
            'tel' =>232425,

            'niveau'=>'avec experience',
            'secteur_id'=>2,

            'competences' => 'competences',
            'ville'=>'moknine',
            'langues' =>'anglais, français, arabe',
            'bio' =>  "Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless. Some quick example text to build on the card title and bulk the card's content Moltin gives you platform.

            As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience lies in successfully conceptualizing, designing, and modifying consumer products specific to interior design and home furnishings.",
            'region_id' =>2,
            'civilite' => 'homme',
            'date_de_naissance'=>'25-01-2000',

            
        ]);
        $candidat->save();
        $candidat = new Condidat([
            'user_id' =>10,
            'avatar' =>"avatar",
            'tel' =>232425,
            'secteur_id'=>1,

            'niveau'=>'débutant',
            'ville'=>'bouhjar',
            'competences' => 'competences',

            'langues' =>'anglais, français, arabe',
            'bio' => "Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless. Some quick example text to build on the card title and bulk the card's content Moltin gives you platform.

            As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience lies in successfully conceptualizing, designing, and modifying consumer products specific to interior design and home furnishings.",
            'region_id' =>3,
            'civilite' => 'femme',
          
            'date_de_naissance'=>'25-02-2000',
         
            
        ]);
        $candidat->save();
        $candidat = new Condidat([
            'user_id' =>11,
            'avatar' =>"avatar",
            'tel' =>232425,
            'niveau'=>'etudiant',
            'secteur_id'=>3,
            'competences' => 'competences',
            'langues' =>'anglais, français, arabe',
            'bio' => "Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless. Some quick example text to build on the card title and bulk the card's content Moltin gives you platform.

            As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience lies in successfully conceptualizing, designing, and modifying consumer products specific to interior design and home furnishings.",
            'ville'=>'ksar hellal',
            'region_id' =>18,
            'civilite' => 'homme',
            'date_de_naissance'=>'25-05-2000',
            
       
            
        ]);
        $candidat->save();
        $candidat = new Condidat([
            'user_id' =>12,
            'avatar' =>"avatar",
            'tel' =>232425,
            'niveau'=>'etudiant',
            'secteur_id'=>3,
            'competences' => 'competences',
            'ville'=>'monastir',
            'langues' =>'anglais, français, arabe',

            'bio' =>  "Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless. Some quick example text to build on the card title and bulk the card's content Moltin gives you platform.

            As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience lies in successfully conceptualizing, designing, and modifying consumer products specific to interior design and home furnishings.",
            'region_id' =>22,
            'civilite' => 'femme',
            'date_de_naissance'=>'25-03-2000',

            
        ]);
        $candidat->save();//
    }
}
