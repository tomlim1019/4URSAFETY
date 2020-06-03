<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'description', 'price', 'tenure', 'category_id', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function quotation()
    {
        return $this->hasMany(Quotation::class);
    }

    public function purchaseLog()
    {
        return $this->hasMany(PurchaseLog::class);
    }
}
