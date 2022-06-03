<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = [
        'condidat_id',
        'nom_societe',
        'nombre_annee',
        'poste',
        'date_debut',
        'date_fin',
        'description'

        ];
        public function condidat()
        {
            return $this->belongsTo(Condidat::class, 'condidat_id');
        }
       
}
