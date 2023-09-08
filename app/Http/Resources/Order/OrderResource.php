<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type'              => $this->type,
            'total_price'       => $this->total_price,
            'order_datetime'    => $this->order_datetime,
            'seller_id'         => $this->seller->id,
            'seller_name'       => $this->seller->first_name . $this->seller->last_name,
            'products'          => ProductResource::collection($this->products)
        ];
    }
}
