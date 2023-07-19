<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mockery\Generator\StringManipulation\Pass\Pass;

class BookingResource extends JsonResource
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
            'travel_trip_detail' => new TravelTripResource($this->travelTrip),
            'user_detail' => new UserResource($this->user),
            'passengers_detail' => PassengerResource::collection($this->passengers),
            'total_price' => $this->total_price,
            'status' => $this->status,
            'payment_proof' => $this->payment_proof,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
