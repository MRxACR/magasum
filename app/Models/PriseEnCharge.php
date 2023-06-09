<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriseEnCharge extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "sortie_id",
        "document_id",
        "fonction",
    ];

    protected $primaryKey = 'sortie_id';
    
    public function sortie(): BelongsTo
    {
        return $this->belongsTo(Sortie::class);
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
}
