<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    
    use HasFactory;
    protected $fillable = ['client_id','date_commande','etat_commande'];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function ligneCommandes()
    {
        return $this->hasMany(LigneCommande::class);
    }
    public function Produit()
    {
        return $this->belongsToMany(Produit::class);
    }

    public function lignes()
    {
        return $this->hasMany(LigneCommande::class);
    }


}
