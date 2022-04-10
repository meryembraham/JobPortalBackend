<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{ 
    protected $fillable = [
    'nom_entreprise', 'description','categorie','logo','cover_img','site','rythme','adresse','tel','slogan'
    ];
    use HasFactory;
    public function user()
    {
        return $this->hasOne(User::class,'user_id','id');
    }
    public function offres()
    {
        return $this->hasMany(Offre::class,'user_id','id');
    }
}
