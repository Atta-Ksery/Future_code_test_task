<?php

namespace App\Http\Resources\MarketingPage;

use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MarketingPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $marketingPagePhotoUrl = $this->getFirstMediaUrl('marketing_page_photo');
        return [
            'id'                        => $this->id,
            'name'                      => $this->name,
            'description'               => $this->description,
            'productType'               => $this->productType->name,
            'products'                  => ProductResource::collection($this->products),
            'numberOfProducts'          => $this->numberOfProducts(),
            'numberOfPurchasedProducts' => $this->numberOfPurchasedProducts(),
            'marketing_page_photo_URL' => $marketingPagePhotoUrl
        ];
    }
}
