<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{ 
    protected $fillable = [
    'nom_entreprise','user_id','region_id', 'description','logo','cover_img','site','adresse','tel','slogan', 'secteur_id',
    ];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function offres()
    {
        return $this->hasMany(Offre::class,'id','offre_id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class,'region_id','id');
    }
    public function secteur()
    {
        return $this->belongsTo(Secteur::class,'secteur_id','id');
    }
}
