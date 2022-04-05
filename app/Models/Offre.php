<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre', 'description','type_contrat','date_debut','diplome','exigences','rythme','salaire','avantages','outils','competences','type_region',
    ];
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
    
    public function notifications()
    {
        return $this->hasMany(Demande::class);
    }
}
