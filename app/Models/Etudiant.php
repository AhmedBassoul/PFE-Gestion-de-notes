<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Note;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'Code',
        'Nom',
        'Prenom',
        'CNE',
        'CNI',
    ];

    public $timestamps = false;
    
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    
    
}
