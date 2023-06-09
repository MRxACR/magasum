<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
        'livraison_id',
        'num',
        'date',
    ];

    /**
     * Get the user that owns the Livraison
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function livraison(): BelongsTo
    {
        return $this->belongsTo(Livraison::class);
    }
}
