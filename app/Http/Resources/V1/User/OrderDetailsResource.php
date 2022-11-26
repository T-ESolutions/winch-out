<?php

namespace App\Http\Resources\V1\User;

use App\Http\Resources\ServicesResources;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
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
            'Status_history' => OrderStatusResource::collection($this->Order_status),
            'location_summary' => [
                'pick_up' => $this->Order_Address ? $this->Order_Address->pickup_address : "",
                'drop_off' => $this->Order_Address ? $this->Order_Address->drop_off_address : ""
            ],
            'service_summary' => [
                'service_name' => $this->service_data->title,
                'service_cost' => $this->service_cost,
            ],
            'extra_service_summary' => $this->Order_extra_services,
            'vehicle_information' => [
                'mark' => $this->brand_data->title,
                'model' => $this->modell_data->title,
                'year' => $this->car_year,
                'color' => $this->car_color,
            ],
            'additional_info' => [
                'images' => $this->User_Order_images,
                'description' => $this->notes
            ],
            'Questions' => OrderQuestionResource::collection($this->Order_Questions),
            'invoice' => [
                'Distance' => $this->distance,
                'Price_p/k' => $this->price_km,
                'Distance_cost' => $this->price_km_cost,
                'free_km' => $this->free_km,
                'free_km_cost' => $this->free_km_cost,
                'total_distance_cost' => $this->total_distance_cost,
                'extra_service_cost' => $this->extra_service_cost,
                'car_brand_cost' => $this->car_category_cost,
                'discount' => $this->discount,
                'vat' => $this->vat,
                'total_cost' => $this->total_cost,
            ]

        ];
    }
}
