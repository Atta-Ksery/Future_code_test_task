<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $productPhotoUrl = $this->getFirstMediaUrl('product_photo');

        return [
            'id'                        => $this->id,
            'name'                      => $this->name,
            'description'               => $this->description,
            'price'                     => $this->price,
            'product_photo_URL'         => $productPhotoUrl,
            'discount_percentage'       => $this->discount_percentage,
            'discount_start_datetime'   => $this->discount_start_datetime,
            'discount_end_datetime'   => $this->discount_end_datetime,
        ];
    }
}
