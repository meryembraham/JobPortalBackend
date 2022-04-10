<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condidat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'avatar',
        'tel',
        'type',
        'civilite',
        'gouvernorat',
        'date_de_naissance',
        'education',
        'competences',
        'experience',
        'langues',
        'description',
    ];
    public function documents()
    {
        return $this->hasMany(Document::class,'id','condidat_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class,'id','notification_id');
    }
    public function demandes()
    {
        return $this->hasMany(Condidature::class,'id','document_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    
}
