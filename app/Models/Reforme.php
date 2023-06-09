<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reforme extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'sortie_id',
        'motif',
        'document_id',
    ] ;

    protected $primaryKey = 'sortie_id';

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function sortie(): BelongsTo
    {
        return $this->belongsTo(Sortie::class);
    }

}
