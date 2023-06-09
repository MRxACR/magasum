<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BonSortie extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "sortie_id",
        "document_id",
        "service",
    ];

    protected $primaryKey = 'sortie_id';

    //protected $keyType = 'string';


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
