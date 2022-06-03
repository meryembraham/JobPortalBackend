<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $document = new Document([
            'condidat_id' =>1,
            'cv' =>'cv',
            'cover_letter' => 'cover_letter',
        ]);
        $document->save();
        $document = new Document([
            'condidat_id' =>2,
            'cv' =>'cv',
            'cover_letter' => 'cover_letter',
        ]);
        $document->save();
        $document = new Document([
            'condidat_id' =>3,
            'cv' =>'cv',
            'cover_letter' => 'cover_letter',
        ]);
        $document->save();
        $document = new Document([
            'condidat_id' =>4,
            'cv' =>'cv',
            'cover_letter' => 'cover_letter',
        ]);
        $document->save();
        $document = new Document([
            'condidat_id' =>5,
            'cv' =>'cv',
            'cover_letter' => 'cover_letter',
        ]);
        $document->save();//
    }
}
