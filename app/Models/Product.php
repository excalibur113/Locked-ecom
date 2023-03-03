<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'productName',
        'sku',
        'description',
        'category',
        'cover_image',
        'quantity',
        'price'
    ];

    public function images() {
        return $this->hasMany(ProductImage::class);
    }
}
