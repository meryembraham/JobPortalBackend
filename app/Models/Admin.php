<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}