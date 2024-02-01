<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livraison extends Model
{
    use HasFactory;
    protected $fillable = [
        'commande_id',
        'catalogue_id',
        'commande_num',
        'commande_date',
        'num',
        'date',
    ];

    /**
     * Get the user that owns the Livraison
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }

    public function catalogue(): BelongsTo
    {
        return $this->belongsTo(Catalogue::class);
    }
}
