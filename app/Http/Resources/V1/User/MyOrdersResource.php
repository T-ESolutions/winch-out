<?php

namespace App\Http\Resources\V1\User;


use Illuminate\Http\Resources\Json\JsonResource;

class MyOrdersResource extends JsonResource
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
            'provider' => $this->provider ? new MyOrdersProviderResources($this->provider) : null,
            'order_number' => $this->order_number,
            'service_data' => $this->service ? new ServicesResources($this->service) : null,
            'distance' => $this->distance,
            'total_cost' => $this->total_cost,
        ];
    }
}
