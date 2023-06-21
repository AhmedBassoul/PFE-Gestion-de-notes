<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Responsabilite;
use App\Models\Module;
use App\Models\Session;
use App\Models\Note;



/**
 * Summary of User
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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


    /**
     * Summary of sessions
     * @return mixed
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }



    /**
     * Summary of modules
     * @return mixed
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }


    /**
     * Summary of notes
     * @return mixed
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }


    /**
     * Summary of responsabilites
     * @return mixed
     */
    public function responsabilites()
    {
        return $this->hasMany(Responsabilite::class);
    }

}
