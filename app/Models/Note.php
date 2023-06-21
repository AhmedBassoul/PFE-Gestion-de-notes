<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Etudiant;
use app\Models\Module;
use app\Models\Session;
use app\Models\User;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'module_id',
        'session_id',
        'CF_N',
        'TP_N',
        'MG_N',
        'CF_R',
        'MG_R',
        'user_id'
    ];

    public $timestamps = false;

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
