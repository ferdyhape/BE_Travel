<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;

class TravelCompanyController extends Controller
{
    // show list of travel company data
    public function index()
    {
        $travels = Travel::all();
        return response()->json([
            'status' => 'Success 200',
            'message' => 'Travels retrieved successfully',
            'travels' => TravelResource::collection($travels),
        ], 200);
    }
}
