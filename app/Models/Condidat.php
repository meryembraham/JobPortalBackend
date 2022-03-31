<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condidat extends Model
{
    use HasFactory;
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function condidatures()
    {
        return $this->hasMany(Condidature::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
