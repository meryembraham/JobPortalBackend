<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $fillable = [
        'longitude', 'latitude','nom'];
    public function offres()
    {
        return $this->hasMany(Offre::class,'offre_id','id');
    }
    public function entreprises()
    {
        return $this->hasMany(Entreprise::class,'entreprise_id','id');
    }
    public function condidats()
    {
        return $this->hasMany(Condidat::class,'condidat_id','id');
    }
}
