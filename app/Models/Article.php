<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id_art',
        'desg_art',
        'nsr_art',
        'qte_stock',
        'qte_init',
        'qte_alt',
        'n_inventaire',
        'categorie_id',
        'type_id',
        'unite_id',
        'document_id',
        'date_expiration',
    ];

    protected $primaryKey = 'id_art';

    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeArticle::class);
    }

    public function unite(): BelongsTo
    {
        return $this->belongsTo(Unite::class);
    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function catalogues(): BelongsToMany
    {
        return $this->belongsToMany(Catalogue::class,'article_catalogue','article_id','catalogue_id')->withPivot([
            "quantity","prix"
        ]);
    }

    public function sorties(): BelongsToMany
    {
        return $this->belongsToMany(Sortie::class,'article_sortie','article_id','sortie_id')->withPivot([
            "quantity","prix","observation","referance",
        ]);
    }

    public function inventaires(): BelongsToMany
    {
        return $this->belongsToMany(Inventaire::class,'article_inventaire','article_id','inventaire_id')->withPivot([
            "quantity","prix","n_inventaire","n_referance",
        ]);
    }

    public function receptions(): BelongsToMany
    {
        return $this->belongsToMany(Reception::class,'article_reception','article_id','reception_id')->withPivot([
            "quantity","prix","n_inventaire",
        ]);
    }




}
