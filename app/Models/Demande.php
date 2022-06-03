<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;
    protected $fillable = [
        'status','message','offre_id','condidat_id'
    ];
    public function condidat()
    {
        return $this->belongsTo(Condidat::class,'condidat_id','id');
    }
    public function offre()
    {
        return $this->belongsTo(Offre::class,'offre_id','id');
    }


}
