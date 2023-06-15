<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TechniclOfferRequest;
use App\Models\TechnicalOffer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class TechnicalController extends Controller
{
    public function index()
    {
        $technicalOffers = TechnicalOffer::paginate(config('settings.pagination.per_page'));
        return view('technical.index', compact('technicalOffers'));
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
        if ($request->offer_type != '') {
            $filterKeys['offer_type'] = $request->offer_type;
        }
        if ($request->conversation_status != '') {
            $filterKeys['conversation_status'] = $request->conversation_status;
        }
        if(count($filterKeys) > 0){
            $technicalOffers = TechnicalOffer::where($filterKeys)->paginate(config('settings.pagination.per_page'));
        } else {
            $technicalOffers = TechnicalOffer::paginate(config('settings.pagination.per_page'));
        }

        return view('technical.index', compact('technicalOffers'));
    }

    public function view(TechnicalOffer $technicalOffer)
    {
        return view('technical.view', compact('technicalOffer'));
    }

    public function create()
    {
        return view('technical.create');
    }

    public function store(TechniclOfferRequest $request)
    {       
        TechnicalOffer::create([
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
            'offer_type' => $request->offer_type,
            'ktb_number' => $request->ktb_number,
            'quote_number' => $request->quote_number,
            'offer_date' => $request->offer_date != '' ? Carbon::parse($request->offer_date)->format('Y-m-d') : null,
            'offer_amount' => $request->offer_amount,
            'offer_follow_up' => $request->offer_follow_up != '' ? Carbon::parse($request->offer_follow_up)->format('Y-m-d') : null,
            'conversation_status' => $request->conversation_status,
            'order_number' => $request->order_number,
            'order_date' => $request->order_date != '' ? Carbon::parse($request->order_date)->format('Y-m-d') : null,
            'order_amount' => $request->order_amount,
            'execution_date' => $request->execution_date != '' ? Carbon::parse($request->execution_date)->format('Y-m-d') : null,
            'approval_date' => $request->approval_date != '' ? Carbon::parse($request->approval_date)->format('Y-m-d') : null,
            'invice_amount' => $request->invice_amount,
            'notes' => $request->notes,
        ]);

        return back()->with('status', 'Technical offer added successfully');
    }

    public function edit(TechnicalOffer $technicalOffer)
    {
        return view('technical.edit', compact('technicalOffer'));
    }

    public function update(TechniclOfferRequest $request, TechnicalOffer $technicalOffer)
    {
        $technicalOffer->get_over = $request->get_over;
        $technicalOffer->cs_order_number = $request->cs_order_number;
        $technicalOffer->received_date = $request->received_date != '' ? Carbon::parse($request->received_date)->format('Y-m-d') : null;
        $technicalOffer->received_from = $request->received_from;
        $technicalOffer->customer_number = $request->customer_number;
        $technicalOffer->technical_place = $request->technical_place;
        $technicalOffer->technical_place_address = $request->technical_place_address;
        $technicalOffer->technical_postcode = $request->technical_postcode;
        $technicalOffer->registered_by = $technicalOffer->registered_by;
        $technicalOffer->status = $request->status;
        $technicalOffer->offer_type = $request->offer_type;
        $technicalOffer->ktb_number = $request->ktb_number;
        $technicalOffer->quote_number = $request->quote_number;
        $technicalOffer->offer_date = $request->offer_date != '' ? Carbon::parse($request->offer_date)->format('Y-m-d') : null;
        $technicalOffer->offer_amount = $request->offer_amount;
        $technicalOffer->offer_follow_up = $request->offer_follow_up != '' ? Carbon::parse($request->offer_follow_up)->format('Y-m-d') : null;
        $technicalOffer->conversation_status = $request->conversation_status;
        $technicalOffer->order_number = $request->order_number;
        $technicalOffer->order_date = $request->order_date != '' ? Carbon::parse($request->order_date)->format('Y-m-d') : null;
        $technicalOffer->order_amount = $request->order_amount;
        $technicalOffer->execution_date = $request->execution_date != '' ? Carbon::parse($request->execution_date)->format('Y-m-d') : null;
        $technicalOffer->approval_date = $request->approval_date != '' ? Carbon::parse($request->approval_date)->format('Y-m-d') : null;
        $technicalOffer->invice_amount = $request->invice_amount;
        $technicalOffer->notes = $request->notes;

        $technicalOffer->save();

        return Redirect::back()->with('status', 'Updated Successfully');
    }

    public function destroy(TechnicalOffer $technicalOffer)
    {
        $technicalOffer->delete();

        return Redirect::back()->with('status', 'Deleted Successfully');
    }
}
