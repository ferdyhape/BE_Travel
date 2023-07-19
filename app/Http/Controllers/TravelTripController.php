<?php

namespace App\Http\Controllers;

use App\Models\TravelTrip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TravelTripResource;

class TravelTripController extends Controller
{
    // show list of trip with travel company data
    public function index()
    {
        return response()->json([
            'status' => 'Success 200',
            'message' => 'Travel trips retrieved successfully',
            'travel_trips' => TravelTripResource::collection(TravelTrip::all()),
        ], 200);
    }

    // filter travel trips
    public function filter(Request $request)
    {
        try {
            $query = TravelTrip::query();

            if ($request->has('min_price')) {
                $minPrice = $request->min_price;
                $query->where('price', '>=', $minPrice);
            }

            if ($request->has('max_price')) {
                $maxPrice = $request->max_price;
                $query->where('price', '<=', $maxPrice);
            }

            if ($request->has('departure_city')) {
                $departureCity = $request->departure_city;
                $query->where('departure_city', $departureCity);
            }

            if ($request->has('destination_city')) {
                $destinationCity = $request->destination_city;
                $query->where('destination_city', $destinationCity);
            }

            if ($request->has('min_departure_time')) {
                $minDepartureTime = $request->min_departure_time;
                $query->where('departure_time', '>=', $minDepartureTime);
            }

            if ($request->has('max_departure_time')) {
                $maxDepartureTime = $request->max_departure_time;
                $query->where('departure_time', '<=', $maxDepartureTime);
            }

            $travelTrips = $query->get();

            if ($travelTrips->isEmpty()) {
                return response()->json([
                    'status' => 'Error 404',
                    'message' => 'Travel trips not found',
                ], 404);
            }

            return response()->json([
                'status' => 'Success 200',
                'message' => 'Travel trips retrieved successfully',
                'travel_trips' => TravelTripResource::collection($travelTrips),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Error 500',
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
