<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
    protected $fillable = [
        'condidat_id',
        'etablissement',
        'diplome',
        'date_debut',
        'date_fin',

        ];
    public function condidat()
    {
        return $this->belongsTo(Condidat::class, 'condidat_id');
    }
}
