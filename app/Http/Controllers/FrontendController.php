<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use App\Models\Building;

class FrontendController extends Controller
{
    public function index()
    {
        $response = Http::get('http://127.0.0.1:8000/api/buildings')->json();

        $event = [];
        $building = [];
        // dd($response);

        foreach ($response as $item) {
            if ($item['categories_id'] == 1) {
                $event[] = $item;
            } elseif ($item['categories_id'] == 2) {
                $building[] = $item;
            }
        }


        // dd($event);
        return view('home', compact('event', 'building'));
    }

    public function show($id)
    {
        // $responses = Http::get('http://127.0.0.1:8000/api/buildings/' . $id)->json();
        // $response = $responses['0'];
        $response = Building::with('owner', 'category')->find($id);
        // dd($response);
        return view('single-page', compact('response'));
    }
    public function rentBuilding(Request $request)
    {
        $validatedData = $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'total_amount' => 'required|numeric',
        ]);

        $validatedData['renter_id'] = auth()->id();

        $response = Http::post('http://127.0.0.1:8000/api/transactions', $validatedData);

        $responseData = $response->json();

        if ($response->successful()) {
            $transactionId = $responseData['transaction']['id'];
            return redirect()->route('payment', ['id' => $transactionId])->with('success', 'Rental request submitted successfully.');
        } else {
            return back()->with('error', 'Failed to submit rental request. Please try again.');
        }
    }

    public function payment($id)
    {
        // Fetch transaction details if needed
        $transaction = Http::get("http://127.0.0.1:8000/api/transactions/{$id}")->json();

        return view('payment', compact('transaction'));
    }

    public function generateInvoice(Request $request)
    {
        $validatedData = $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
        ]);

        $response = Http::post('http://127.0.0.1:8000/api/invoices', $validatedData);

        if ($response->successful()) {
            $invoiceId = $response->json('id');
            return redirect()->route('view.invoice', ['id' => $invoiceId])->with('success', 'Invoice generated successfully.');
        } else {
            return back()->with('error', 'Failed to generate invoice. Please try again.');
        }
    }

    public function viewInvoice($id)
    {
        $response = Http::get("http://127.0.0.1:8000/api/invoices/{$id}");

        if ($response->successful()) {
            $data = $response->json();
            $invoice = $data;
            $transaction = $data['transaction'];
            $building = $transaction['building'];
            $renter = $transaction['renter'];
            $seller = $building['owner'];
            return view('invoices.show', compact('invoice', 'transaction', 'building', 'renter', 'seller'));
        } else {
            return back()->with('error', 'Failed to fetch invoice details.');
        }
    }

    public function items()
    {
        $response = Http::get('http://127.0.0.1:8000/api/buildings')->json();
        $items = $this->paginateCollection(collect($response), 9); // 9 items per page
        return view('items', ['items' => $items]);
    }

    public function filterItems(Request $request)
    {
        $response = Http::get('http://127.0.0.1:8000/api/buildings')->json();

        $filteredItems = collect($response)->filter(function ($item) use ($request) {
            $matchesAddress = !$request->filled('address') || stripos($item['address'], $request->address) !== false;
            $matchesType = !$request->filled('type') || $item['categories_id'] == $request->type;
            $matchesMinPrice = !$request->filled('min_price') || $item['rent_price'] >= $request->min_price;
            $matchesMaxPrice = !$request->filled('max_price') || $item['rent_price'] <= $request->max_price;

            return $matchesAddress && $matchesType && $matchesMinPrice && $matchesMaxPrice;
        });

        $event = $this->paginateCollection($filteredItems->where('categories_id', 1)->values(), 9);
        $building = $this->paginateCollection($filteredItems->where('categories_id', 2)->values(), 9);

        return view('items', [
            'event' => $event,
            'building' => $building,
            'filters' => $request->all()
        ]);
    }

    private function paginateCollection($items, $perPage)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $total = $items->count();

        $results = $items->slice(($page - 1) * $perPage, $perPage)->all();

        return new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
    }

    public function createListing()
    {

        $users = \App\Models\User::get();
        $buildings = \App\Models\Building::with('owner', 'category')->get();
        $categories = \App\Models\BuildingCategory::get();
        // return view('buildings.create', compact('buildings', 'users', 'categories'));
        // $categories = Http::get('http://127.0.0.1:8000/api/building-categories')->json();
        return view('create-listing', compact('buildings', 'users', 'categories'));
    }

    public function storeListing(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required',
            'construction_type' => 'required',
            'year_built' => 'required|integer',
            'units_in_building' => 'required|integer',
            'bathrooms' => 'required|integer',
            'bedrooms' => 'required|integer',
            'flooring' => 'required',
            'amenities' => 'required',
            'cooling' => 'required',
            'other_features' => 'required',
            'pictures' => 'nullable|json',
            'rent_price' => 'required|numeric',
        ]);

        $details = [
            'Construction Type' => $validatedData['construction_type'],
            'Year Built' => $validatedData['year_built'],
            'Units in Building' => $validatedData['units_in_building'],
            'Bathrooms' => $validatedData['bathrooms'],
            'Bedrooms' => $validatedData['bedrooms'],
            'Flooring' => $validatedData['flooring'],
            'Amenities' => $validatedData['amenities'],
            'Cooling' => $validatedData['cooling'],
            'Other Features' => $validatedData['other_features'],
        ];
        // dd($request->categories_id);

        $building = Building::create([
            'description' => $validatedData['description'],
            'details' => $details,
            'pictures' => $validatedData['pictures'],
            'rent_price' => $validatedData['rent_price'],
            'owner_id' => auth()->id(),
            'address' => $request->address,
            'categories_id' => 2,
        ]);

        return redirect()->route('building.show', $building->id)->with('success', 'Building created successfully.');
    }

    public function userTransactions()
    {
        $userId = auth()->id();
        $transactions = \App\Models\Transaction::where('renter_id', $userId)->get();

        return view('user-transactions', compact('transactions'));
    }
}
