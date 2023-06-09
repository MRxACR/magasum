<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCommande extends Model
{
    use HasFactory;
    
    public $timestamps = false;
   
    protected $fillable = [
        'desg',
    ];
}
