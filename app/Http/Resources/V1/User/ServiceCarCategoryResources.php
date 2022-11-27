<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCarCategoryResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'car_category' => $this->car_category->title,
            'price' => $this->price,
            'price_km' => $this->price_km,
            'free_km' => $this->free_km,
            'vat' => $this->vat,
        ];
    }
}
