<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'role',
        'password',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function sent()
    {
        return $this->hasMany(Message::class, 'from_id','id');
    }
    public function received()
    {
        return $this->hasMany(Message::class, 'to_id','id');
    }
    public function entreprise()
    {
        return $this->belongsTo(entreprise::class,'user_id','id');
    }
    public function condidat()
    {
        return $this->belongsTo(Condidat::class,'user_id','id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class,'user_id','id');
    }
    
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
