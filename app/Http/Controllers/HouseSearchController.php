<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\House;

class HouseSearchController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = House::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->bedrooms);
        }

        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', $request->bathrooms);
        }

        if ($request->filled('storeys')) {
            $query->where('storeys', $request->storeys);
        }

        if ($request->filled('garages')) {
            $query->where('garages', $request->garages);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        return response()->json($query->get());
    }
}
