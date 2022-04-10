<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'fromID',
        'ToID',
        'contenu',
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id','id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
    public function offre()
    {
        return $this->belongsTo(Offre::class,'offre_id','id');
    }
}
