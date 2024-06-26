<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id','id');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }
    public function getTotalSoldQuantityAttribute()
    {
        // Calculate total sold quantity using relationship
        return $this->details()->sum('qty');
    }
    public function productComments()
    {
        return $this->hasMany(ProductComment::class,'product_id','id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class,'product_id','id');
    }
}
