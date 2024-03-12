<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
    use SoftDeletes,HasFactory;

    protected $fillable = [
        'products_id', 'photo', 'is_default'
    ];

    protected $hidder = [

    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
        // belongsT0 -> Milik
    }


    // Mengganti alamat yang  di tampilkan dengan url  (mengganti url foto)
    public function getPhotoAttribute($value)
    {
        return url('storage/' . $value);
    }

}
