<?php

namespace App\Http\Resources\V1\User;

use App\Http\Resources\ServicesResources;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'provider' => $this->provider ? new MyOrdersProviderResources($this->provider) : null,
            'order_number' => $this->order_number,
            'service_data' => $this->service ? new ServicesResources($this->service_data) : null,

        ];
    }
}
