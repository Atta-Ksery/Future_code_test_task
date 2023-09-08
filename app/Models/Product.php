<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;
    protected $fillable = [
        'name',
        'description',
        'price',
        'basic_value',
        'amount',
        'marketing_page_id'
    ];

    public $translatable = [
        'name',
        'description'
    ];

    public function orders() {
        return $this->belongsToMany(Order::class)
                    ->withPivot('amount');
    }

    public function marketingPage() {
        return $this->belongsTo(MarketingPage::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('product_photo')
            ->singleFile();
    }

    public function numberOfPurchases() {

    }
}
