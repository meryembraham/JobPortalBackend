<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{   
    use HasFactory;
    protected $fillable = [
        'entreprise_id', 'secteur_id', 'region_id', 'experience', 'type_region','titre', 'description','type_contrat','date_debut','diplome','exigences','rythme','salaire','avantages','outils','competences','type_region','condidat_id','type'
    ];
    public function region()
    {
        return $this->belongsTo(Region::class,'region_id','id');
    }
    public function secteur()
    {
        return $this->belongsTo(Secteur::class,'secteur_id','id');
    }
   
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class,'entreprise_id','id');
    }
    public function demandes()
    {
        return $this->hasMany(Demande::class,'demande_id','id');
    }
    
    public function notifications()
    {
        return $this->hasMany(Notification::class,'id','notification_id');
    }
    
    
}
