<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condidat extends Model
{
    use HasFactory;
    protected $fillable = [

        'avatar',
        'tel',
        'niveau',
        'civilite',
        'region_id',
        'secteur_id',
        'ville',
        'date_de_naissance',
        'competences',
        'langues',
        'bio',
        'user_id'
    ];
    public function documents()
    {
        return $this->hasMany(Document::class,'id','document_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class,'id','notification_id');
    }
    public function demandes()
    {
        return $this->hasMany(Demande::class,'id','demande_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class,'region_id','id');
    }
    public function secteur()
    {
        return $this->belongsTo(Secteur::class,'secteur_id','id');
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class,'id','experience_id');
    }
    public function formations()
    {
        return $this->hasMany(Formation::class,'id','formation_id');
    }
    
    
}
