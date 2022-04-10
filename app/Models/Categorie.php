<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        ];
    public function offres()
    {
        return $this->hasMany(Offre::class,'offre_id','id');
    }
    public function admin()
    {
        return $this->hasOne(Admin::class,'admin_id','id');
    }
}
