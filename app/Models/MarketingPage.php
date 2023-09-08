<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarketingPage extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'product_type_id',
        'user_id'
    ];

    public $translatable = [
        'name',
        'description'
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function productType() {
        return $this->belongsTo(ProductType::class);
    }

    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blockedUsers() {
        return $this->belongsToMany(User::class, 'blocked_users');
    }

    public function memberedUsers() {
        return $this->belongsToMany(User::class, 'members');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('marketing_page_photo')
            ->singleFile();
    }

    public function numberOfProducts() {
        return $this->products->count();
    }

    public function numberOfPurchasedProducts() {
        $numberOfPurchasedProducts = 0;
        $products = $this->products;
        foreach ($products as $product) {
            foreach ($product->orders as $order) {
                $numberOfPurchasedProducts += $order->pivot->amount;
            }
        }
        return $numberOfPurchasedProducts;
    }
}
