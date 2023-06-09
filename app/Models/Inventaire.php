<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventaire extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        "champs",
    ];
    
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class,'article_inventaire','inventaire_id','article_id')->withPivot([
            "quantity","n_inventaire","n_referance","prix"
        ]);
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}
