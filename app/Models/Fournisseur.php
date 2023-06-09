<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fournisseur extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'rs',
        'nom',
        'prenom',
        'tel',
        'fax',
        'adr',
        'willaya',
        'rc',
        'ai',
        'mf',
    ];

    /**
     * Get all of the commandes for the Fournisseur
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class);
    }
}
