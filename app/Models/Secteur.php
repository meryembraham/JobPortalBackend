<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
    ];
    public function categories()
    {
        return $this->hasMany(Categorie::class,'id','categorie_id');
    }
    public function entreprises()
    {
        return $this->hasMany(Entreprise::class,'id','entreprise_id');
    }
    public function condidats()
    {
        return $this->hasMany(Condidat::class,'id','condidat_id');
    }
    public function offres()
    {
        return $this->hasMany(Offre::class,'id','offre_id');
    }
}
