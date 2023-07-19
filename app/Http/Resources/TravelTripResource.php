<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TravelTripResource extends JsonResource
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
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'departure_city' => $this->departure_city,
            'destination_city' => $this->destination_city,
            'price' => 'Rp. ' . number_format($this->price, 0, ',', '.'),
            'travel_company' => new TravelResource($this->travel),
        ];
    }
}
