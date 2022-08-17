<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'price',
        'body',
        'category_id',
        'preview_desc'
    ];

    public function category() {
        return $this->belongsTo(ProductCategory::class);
    }
}
