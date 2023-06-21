<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;
use App\Models\Session;
use App\Models\User;

class Responsabilite extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'user_id',
        'session_id',
    ];

    public $timestamps = false;

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

}
