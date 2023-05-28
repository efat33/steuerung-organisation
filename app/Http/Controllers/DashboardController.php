<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\TechnicalOffer;

class DashboardController extends Controller
{
    public function success()
    {
        return view('dashboard.success-rate');
    }

    public function successAction(Request $request)
    {  
        $technischVon = Carbon::parse($request->technisch_von)->format('Y-m-d');
        $technischZu = Carbon::parse($request->technisch_zu)->format('Y-m-d');
        $wartungVon = Carbon::parse($request->wartung_von)->format('Y-m-d');
        $wartungZu = Carbon::parse($request->wartung_zu)->format('Y-m-d');

        $technicalOffers = TechnicalOffer::whereBetween('offer_date', [$technischVon, $technischZu])->get();

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

        return view('dashboard.success-rate', $data);
    }

    public function employeeEvaluation()
    {
        return view('dashboard.employee-evaluation');
    }

    public function employeeEvaluationAction(Request $request)
    {  
        $technischVon = Carbon::parse($request->technisch_von)->format('Y-m-d');
        $technischZu = Carbon::parse($request->technisch_zu)->format('Y-m-d');
        $wartungVon = Carbon::parse($request->wartung_von)->format('Y-m-d');
        $wartungZu = Carbon::parse($request->wartung_zu)->format('Y-m-d');

        // $technicalOffers = DB::table('technical_offers')->whereBetween('offer_date', [$technischVon, $technischZu])->get();
        // $technicalOffers = TechnicalOffer::groupBy('registered_by')->whereBetween('offer_date', [$technischVon, $technischZu])->get();
        DB::statement("SET SQL_MODE=''");
        $technicalOffers = TechnicalOffer::groupBy('registered_by')->whereBetween('offer_date', [$technischVon, $technischZu])->get();

        echo '<pre>';
        print_r($technicalOffers);

        foreach ($technicalOffers as $technicalOffer){ 
            // echo '---'.$technicalOffer->user->name;
        }

        exit();

        

        

        $data = array();

        // return back()->with('data', $data);
        return view('dashboard.employee-evaluation', $data);
    }
}
