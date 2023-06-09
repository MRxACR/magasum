<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "num",
        "date",
        "denomination",
        "code",
        "adresse",
        "telephone",
        "fix",
        "object",
        "catalogue_id",
        "fournisseur_id",
        "type_commande_id",
        "document_id",
    ];

    
    /**
     * Get the user that owns the Commande
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catalogue(): BelongsTo
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeCommande::class,'type_commande_id','id');
    }

    public function fournisseur(): BelongsTo
    {
        return $this->belongsTo(Fournisseur::class);
    }
        /**
     * Get the user that owns the BonSortie
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
    
    /**
     * Get the livraison associated with the Commande
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function livraison(): HasOne
    {
        return $this->hasOne(Livraison::class);
    }

}
