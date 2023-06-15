<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\MaintenanceOffer;
use App\Http\Requests\MaintenanceOfferRequest;
use Illuminate\Support\Facades\Redirect;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenanceOffers = MaintenanceOffer::paginate(config('settings.pagination.per_page'));
        return view('maintenance.index', compact('maintenanceOffers'));
    }

    public function indexAction(Request $request)
    {
        $filterKeys = array();
        if ($request->get_over != '') {
            $filterKeys['get_over'] = $request->get_over;
        }
        if ($request->status != '') {
            $filterKeys['status'] = $request->status;
        }
        if ($request->conversation_status != '') {
            $filterKeys['conversation_status'] = $request->conversation_status;
        }
        if ($request->package != '') {
            $filterKeys['package'] = $request->package;
        }
        if(count($filterKeys) > 0){
            $maintenanceOffers = MaintenanceOffer::where($filterKeys)->paginate(config('settings.pagination.per_page'));
        } else {
            $maintenanceOffers = MaintenanceOffer::paginate(config('settings.pagination.per_page'));
        }
        
        return view('maintenance.index', compact('maintenanceOffers'));
    }

    public function view(MaintenanceOffer $maintenanceOffer)
    {
        return view('maintenance.view', compact('maintenanceOffer'));
    }

    public function create()
    {
        return view('maintenance.create');
    }

    public function store(MaintenanceOfferRequest $request)
    {       
        MaintenanceOffer::create([
            'get_over' => $request->get_over,
            'cs_order_number' => $request->cs_order_number,
            'received_date' => $request->received_date != '' ? Carbon::parse($request->received_date)->format('Y-m-d') : null,
            'received_from' => $request->received_from,
            'customer_number' => $request->customer_number,
            'technical_place' => $request->technical_place,
            'technical_place_address' => $request->technical_place_address,
            'technical_postcode' => $request->technical_postcode,
            'registered_by' => auth()->user()->id,
            'status' => $request->status,
            'ktb_number' => $request->ktb_number,
            'quote_number' => $request->quote_number,
            'offer_date' => $request->offer_date != '' ? Carbon::parse($request->offer_date)->format('Y-m-d') : null,
            'offer_amount' => $request->offer_amount,
            'offer_follow_up' => $request->offer_follow_up != '' ? Carbon::parse($request->offer_follow_up)->format('Y-m-d') : null,
            'conversation_status' => $request->conversation_status,
            'maintenance_contact' => $request->maintenance_contact,
            'contact_conclusion' => $request->contact_conclusion != '' ? Carbon::parse($request->contact_conclusion)->format('Y-m-d') : null,
            'package' => $request->package,
            'sum_per_year' => $request->sum_per_year,
        ]);

        return back()->with('status', 'Technical offer added successfully');
    }

    public function edit(MaintenanceOffer $maintenanceOffer)
    {
        return view('maintenance.edit', compact('maintenanceOffer'));
    }

    public function update(MaintenanceOfferRequest $request, MaintenanceOffer $maintenanceOffer)
    {
        $maintenanceOffer->get_over = $request->get_over;
        $maintenanceOffer->cs_order_number = $request->cs_order_number;
        $maintenanceOffer->received_date = $request->received_date != '' ? Carbon::parse($request->received_date)->format('Y-m-d') : null;
        $maintenanceOffer->received_from = $request->received_from;
        $maintenanceOffer->customer_number = $request->customer_number;
        $maintenanceOffer->technical_place = $request->technical_place;
        $maintenanceOffer->technical_place_address = $request->technical_place_address;
        $maintenanceOffer->technical_postcode = $request->technical_postcode;
        $maintenanceOffer->registered_by = $maintenanceOffer->registered_by;
        $maintenanceOffer->status = $request->status;
        $maintenanceOffer->ktb_number = $request->ktb_number;
        $maintenanceOffer->quote_number = $request->quote_number;
        $maintenanceOffer->offer_date = $request->offer_date != '' ? Carbon::parse($request->offer_date)->format('Y-m-d') : null;
        $maintenanceOffer->offer_amount = $request->offer_amount;
        $maintenanceOffer->offer_follow_up = $request->offer_follow_up != '' ? Carbon::parse($request->offer_follow_up)->format('Y-m-d') : null;
        $maintenanceOffer->conversation_status = $request->conversation_status;
        $maintenanceOffer->maintenance_contact = $request->maintenance_contact;
        $maintenanceOffer->contact_conclusion = $request->contact_conclusion != '' ? Carbon::parse($request->contact_conclusion)->format('Y-m-d') : null;
        $maintenanceOffer->package = $request->package;;
        $maintenanceOffer->sum_per_year = $request->sum_per_year;

        $maintenanceOffer->save();

        return Redirect::back()->with('status', 'Updated Successfully');
    }

    public function destroy(MaintenanceOffer $maintenanceOffer)
    {
        $maintenanceOffer->delete();

        return Redirect::back()->with('status', 'Deleted Successfully');
    }
}
