<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SuccessRateRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function success()
    {
        return view('dashboard.success-rate');
    }

    public function successAction(SuccessRateRequest $request)
    {  
        $technischVon = Carbon::parse($request->technisch_von)->format('Y-m-d');
        $technischZu = Carbon::parse($request->technisch_zu)->format('Y-m-d');
        $wartungVon = Carbon::parse($request->wartung_von)->format('Y-m-d');
        $wartungZu = Carbon::parse($request->wartung_zu)->format('Y-m-d');

        $technicalOffers = DB::table('technical_offers')->whereBetween('offer_date', [$technischVon, $technischZu])->where('offer_date', '<>', null)->get();

        $technicalOfferNumber = count($technicalOffers);
        $technicalOrderNumber = 0;
        foreach ($technicalOffers as $technicalOffer){ 
            if($technicalOffer->order_date != null)
                $technicalOrderNumber++;
        }
        $technicalSuccessRate = ($technicalOrderNumber/$technicalOfferNumber)*100;

        // $maintenanceOffers = DB::table('maintenance_offers')->whereBetween('offer_date', [$technischVon, $technischZu])->where('offer_date', '<>', null)->get();

        // $technicalOfferNumber = count($technicalOffers);
        // $technicalOrderNumber = 0;
        // foreach ($technicalOffers as $technicalOffer){ 
        //     if($technicalOffer->order_date != null)
        //         $technicalOrderNumber++;
        // }
        // $technicalSuccessRate = ($technicalOrderNumber/$technicalOfferNumber)*100;

        $data = array();
        $data['technicalOfferNumber'] = $technicalOfferNumber;
        $data['technicalOrderNumber'] = $technicalOrderNumber;
        $data['technicalSuccessRate'] = $technicalSuccessRate;

        // return back()->with('data', $data);
        return view('dashboard.success-rate', $data);
    }
}
