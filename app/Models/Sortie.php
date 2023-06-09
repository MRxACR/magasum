<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sortie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        "num",
        "nom",
        "prenom",
        'date',
        'type',
        'signer',
    ];

    protected $primaryKey = 'id';

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class,'article_sortie','sortie_id','article_id')->withPivot([
            "quantity","observation","referance","prix","n_quantity"
        ]);
    }

    public function prise_en_charge(): HasOne
    {
        return $this->hasOne(PriseEnCharge::class);
    }

    public function bon_de_sortie(): HasOne
    {
        return $this->hasOne(BonSortie::class);
    }

    public function reforme()
    {
        return $this->hasOne(Reforme::class);
    }


}
