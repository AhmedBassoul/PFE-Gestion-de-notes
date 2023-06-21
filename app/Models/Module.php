<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Responsabilite;
use App\Models\Note;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'Intitule',
        'coef_TP',
        'coef_CF',
        'user_id',
        'code_secret',
    ];

    protected $hidden = [
        
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function responsabilites()
    {
        return $this->hasMany(Responsabilite::class);
    }

}
