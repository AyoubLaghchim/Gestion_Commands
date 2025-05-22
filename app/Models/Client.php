<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = ['nom','telephone','adresse','user_id'] ;

    use HasFactory;
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
