<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'id',
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
        return $this->hasOne(entreprise::class,'entreprise_id','id');
    }
    public function condidat()
    {
        return $this->hasOne(Condidat::class,'condidat_id','id');
    }
    public function admin()
    {
        return $this->hasOne(Admin::class,'admin_id','id');
    }
    
    
    public function getUserId(Request $request)
    {
        $user = Auth::user(); // Retrieve the currently authenticated user...
        $id = Auth::id(); // Retrieve the currently authenticated user's ID...

        
       /* $user = $request->user(); // returns an instance of the authenticated user...
        $id = $request->user()->id; // Retrieve the currently authenticated user's ID...

        
        $user = auth()->user(); // Retrieve the currently authenticated user...
        $id = auth()->id();  // Retrieve the currently authenticated user's ID...*/
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
