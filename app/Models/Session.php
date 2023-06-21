<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Responsabilite;
use App\Models\Module;
use App\Models\Note;
 


class Session extends Model
{
    use HasFactory;

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'Niveau',
        'Annee',
    ];

    /**
     * Summary of timestamps
     * @var
     */
    public $timestamps = false;

    /**
     * Summary of modules
     * @return mixed
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    /**
     * Summary of responsabilites
     * @return mixed
     */
    public function responsabilites()
    {
        return $this->hasMany(Responsabilite::class);
    }

    /**
     * Summary of notes
     * @return mixed
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

}
