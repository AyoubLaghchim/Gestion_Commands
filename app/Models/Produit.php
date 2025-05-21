<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    //
    use HasFactory;
    protected $fillable= ['nom','prix_unitaire','description','stock','categorie_id'];
    // app/Models/Produit.php

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function ligneCommandes()
    {
        return $this->hasMany(LigneCommande::class);
    }
    

}
