<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\Booking;
use App\Models\TravelTrip;
use Illuminate\Http\Request;
use App\Http\Resources\BookingResource;
use App\Models\Passengers;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::where('user_id', $request->user()->id)->get();

        if ($bookings->isEmpty()) {
            return response()->json([
                'status' => 'Error 404',
                'message' => 'Bookings not found',
            ], 404);
        }

        return response()->json([
            'status' => 'Success 200',
            'message' => 'Bookings retrieved successfully',
            'bookings' => BookingResource::collection($bookings),
        ], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'travel_trip_id' => 'required|exists:travel_trips,id',
            'passengers' => 'required|array',
            'passengers.name.*' => 'required|string',
            'passengers.phone_number.*' => 'required|string|max:13',
            'payment_proof' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $travelTrip = TravelTrip::find($request->travel_trip_id);

        if ($request->hasFile('payment_proof')) {
            $paymentProofName = $request->file('payment_proof')->store('payment_proof', 'public');
        }

        $totalPassengers = count($validatedData['passengers']);
        $totalPrice = $travelTrip->price * $totalPassengers;
        $booking = Booking::create([
            'travel_trip_id' => $request->travel_trip_id,
            'user_id' => $request->user()->id,
            'total_passengers' => $totalPassengers,
            'total_price' => $totalPrice,
            'payment_proof' => $paymentProofName ?? null,
        ]);

        for ($i = 0; $i < $totalPassengers; $i++) {
            Passengers::create([
                'booking_id' => $booking->id,
                'name' => $request->passengers['name'][$i],
                'phone_number' => $request->passengers['phone_number'][$i],
            ]);
        }

        return response()->json([
            'status' => 'Success 200',
            'message' => 'Booking created successfully',
            'booking' => new BookingResource($booking),
        ], 200);
    }

    public function uploadPaymentProof(Request $request, $id)
    {
        $validatedData = $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'status' => 'Error 404',
                'message' => 'Booking not found',
            ], 404);
        }

        if ($booking->user_id != $request->user()->id) {
            return response()->json([
                'status' => 'Error 403',
                'message' => 'Forbidden',
            ], 403);
        }

        $paymentProofName = $request->file('payment_proof')->store('payment_proof', 'public');

        $booking->update([
            'payment_proof' => $paymentProofName,
        ]);

        return response()->json([
            'status' => 'Success 200',
            'message' => 'Payment proof uploaded successfully',
            'booking' => new BookingResource($booking),
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'status' => 'Error 404',
                'message' => 'Booking not found',
            ], 404);
        }
        if ($booking->user_id != $request->user()->id) {
            return response()->json([
                'status' => 'Error 403',
                'message' => 'Forbidden',
            ], 403);
        }

        return response()->json([
            'status' => 'Success 200',
            'message' => 'Booking retrieved successfully',
            'booking' => new BookingResource($booking),
        ], 200);
    }

    public function cancel(Request $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'status' => 'Error 404',
                'message' => 'Booking not found',
            ], 404);
        }
        if ($booking->user_id != $request->user()->id) {
            return response()->json([
                'status' => 'Error 403',
                'message' => 'Forbidden',
            ], 403);
        }

        if ($booking->status == 'cancelled') {
            return response()->json([
                'status' => 'Error 400',
                'message' => 'Booking already cancelled',
            ], 400);
        }

        $booking->update([
            'status' => 'cancelled',
        ]);

        return response()->json([
            'status' => 'Success 200',
            'message' => 'Booking cancelled successfully',
            'booking' => new BookingResource($booking),
        ], 200);
    }
}
