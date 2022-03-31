<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'detail'
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
    public function condidatures()
    {
        return $this->hasMany(Condidature::class);
    }
    public function notifications()
    {
        return $this->hasMany(Condidature::class);
    }
}
