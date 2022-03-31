<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;
    public function condidat()
    {
        return $this->belongsTo(Condidat::class);
    }
    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
