<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WallpaperQuote extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'original_filename', 'quote_type_id', 'publish'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s A',
        'updated_at' => 'datetime:Y-m-d H:i:s A',
    ];
}
