<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'cv',
        'cover_letter',
    ];
    public function condidat()
    {
        return $this->belongsTo(Condidat::class,'condidat_id','id');
    }

}
