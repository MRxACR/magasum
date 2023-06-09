<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Catalogue extends Model
{

    use HasFactory,SoftDeletes;
    protected $fillable = [
        "fournisseur_id",
        "tva",
    ];

    /**
     * Get the user that owns the catalogue
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fournisseur(): BelongsTo
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class,'article_catalogue','catalogue_id','article_id')->withPivot([
            "quantity","prix"
        ]);
    }

    /**
     * Get the user associated with the catalogue
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function commande(): HasOne
    {
        return $this->hasOne(Commande::class);
    }
}
