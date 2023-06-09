<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reception extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'num',
        'facture_id',
        'livraison_id',
        'document_id',
        'date',
        'num_marche',
        'num_consultation',
        'num_ods',
    ];

    /**
     * Get the document that owns the Reception
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
    /**
     * Get the document that owns the Reception
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function facture(): BelongsTo
    {
        return $this->belongsTo(Facture::class);
    }
    /**
     * Get the document that owns the Reception
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function livraison(): BelongsTo
    {
        return $this->belongsTo(Livraison::class);
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class,'article_reception','reception_id','article_id')->withPivot([
            "quantity","prix","n_inventaire"
        ]);
    }

}
