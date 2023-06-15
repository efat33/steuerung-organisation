<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use App\Models\TechnicalOffer;
use App\Models\MaintenanceOffer;

class DashboardController extends Controller
{
    public function success()
    {
        return view('dashboard.success-rate');
    }

    public function successAction(Request $request)
    {  
        $request->validate([
            'technisch_von' => ['required_with:technisch_zu'],
            'technisch_zu' => ['required_with:technisch_von'],
            'wartung_von' => ['required_with:wartung_zu'],
            'wartung_zu' => ['required_with:wartung_von'],
        ]);
    
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
        if($technicalOfferNumber != 0){
            $technicalSuccessRate = ($technicalOrderNumber/$technicalOfferNumber)*100;
            $technicalSuccessRate = number_format((float)$technicalSuccessRate, 2, '.', '');
        } else {
            $technicalSuccessRate = 0;
        }
        
        $maintenanceOffers = MaintenanceOffer::whereBetween('offer_date', [$wartungVon, $wartungZu])->get();
        $maintenanceOfferNumber = count($maintenanceOffers);
        $maintenanceOrderNumber = 0;
        foreach ($maintenanceOffers as $maintenanceOffer){ 
            if($maintenanceOffer->contact_conclusion != null)
                $maintenanceOrderNumber++;
        }
        if($maintenanceOfferNumber != 0){
            $maintenanceSuccessRate = ($maintenanceOrderNumber/$maintenanceOfferNumber)*100;
            $maintenanceSuccessRate = number_format((float)$maintenanceSuccessRate, 2, '.', '');
        } else {
            $maintenanceSuccessRate = 0;
        }

        $data = array();
        $data['technicalOfferNumber'] = $technicalOfferNumber;
        $data['technicalOrderNumber'] = $technicalOrderNumber;
        $data['technicalSuccessRate'] = $technicalSuccessRate;
        $data['maintenanceOfferNumber'] = $maintenanceOfferNumber;
        $data['maintenanceOrderNumber'] = $maintenanceOrderNumber;
        $data['maintenanceSuccessRate'] = $maintenanceSuccessRate;

        return view('dashboard.success-rate', $data);
    }

    public function quoteTime()
    {
        return view('dashboard.quote-time');
    }

    public function quoteTimeAction(Request $request)
    {  
        $request->validate([
            'technisch_von' => ['required_with:technisch_zu'],
            'technisch_zu' => ['required_with:technisch_von'],
            'wartung_von' => ['required_with:wartung_zu'],
            'wartung_zu' => ['required_with:wartung_von'],
        ]);

        $technischVon = Carbon::parse($request->technisch_von)->format('Y-m-d');
        $technischZu = Carbon::parse($request->technisch_zu)->format('Y-m-d');
        $wartungVon = Carbon::parse($request->wartung_von)->format('Y-m-d');
        $wartungZu = Carbon::parse($request->wartung_zu)->format('Y-m-d');

        $technicalOffers = TechnicalOffer::whereBetween('offer_date', [$technischVon, $technischZu])->where('received_date', '<>', null)->get();

        foreach ($technicalOffers as $technicalOffer) {
            $fdate = $technicalOffer->received_date;
            $tdate = $technicalOffer->offer_date;
            $fdate = new DateTime($fdate);
            $tdate = new DateTime($tdate);
            $interval = $fdate->diff($tdate);
            $days = $interval->format('%a');
            $days = (int) $days;
            $days = $days + 1;
            $technicalOffer['days'] = $days;
        }

        $maintenanceOffers = MaintenanceOffer::whereBetween('offer_date', [$wartungVon, $wartungZu])->where('received_date', '<>', null)->get();

        foreach ($maintenanceOffers as $maintenanceOffer) {
            $fdate = $maintenanceOffer->received_date;
            $tdate = $maintenanceOffer->offer_date;
            $fdate = new DateTime($fdate);
            $tdate = new DateTime($tdate);
            $interval = $fdate->diff($tdate);
            $days = $interval->format('%a');
            $days = (int) $days;
            $days = $days + 1;
            $maintenanceOffer['days'] = $days;
        }

        $data = array();
        $data['technicalOffers'] = $technicalOffers;
        $data['maintenanceOffers'] = $maintenanceOffers;

        return view('dashboard.quote-time', $data);
    }

    public function employeeEvaluation()
    {
        return view('dashboard.employee-evaluation');
    }

    public function employeeEvaluationAction(Request $request)
    {  
        $request->validate([
            'technisch_von' => ['required_with:technisch_zu'],
            'technisch_zu' => ['required_with:technisch_von'],
            'wartung_von' => ['required_with:wartung_zu'],
            'wartung_zu' => ['required_with:wartung_von'],
        ]);

        $technischVon = Carbon::parse($request->technisch_von)->format('Y-m-d');
        $technischZu = Carbon::parse($request->technisch_zu)->format('Y-m-d');
        $wartungVon = Carbon::parse($request->wartung_von)->format('Y-m-d');
        $wartungZu = Carbon::parse($request->wartung_zu)->format('Y-m-d');

        $technicalOffers = TechnicalOffer::whereBetween('offer_date', [$technischVon, $technischZu])->groupBy('registered_by')->selectRaw('count(*) as total_offer, registered_by')->get(); 

        $technicalOrders = TechnicalOffer::whereBetween('order_date', [$wartungVon, $wartungZu])->groupBy('registered_by')->selectRaw('count(*) as total_order, registered_by')->get(); 

        foreach ($technicalOffers as $technicalOffer) {            
            foreach ($technicalOrders as $technicalOrder) {
                if ($technicalOffer->registered_by == $technicalOrder->registered_by){
                    $technicalOffer['total_order'] = $technicalOrder->total_order;
                }
            }
        }

        $maintenanceOffers = MaintenanceOffer::whereBetween('offer_date', [$wartungVon, $wartungZu])->groupBy('registered_by')->selectRaw('count(*) as total_offer, registered_by')->get(); 

        $maintenanceOrders = MaintenanceOffer::whereBetween('contact_conclusion', [$wartungVon, $wartungZu])->groupBy('registered_by')->selectRaw('count(*) as total_order, registered_by')->get(); 

        foreach ($maintenanceOffers as $maintenanceOffer) {            
            foreach ($maintenanceOrders as $maintenanceOrder) {
                if ($maintenanceOffer->registered_by == $maintenanceOrder->registered_by){
                    $maintenanceOffer['total_order'] = $maintenanceOrder->total_order;
                }
            }
        }

        $data = array();
        $data['technicalOffersOrders'] = $technicalOffers;
        $data['maintenanceOffersOrders'] = $maintenanceOffers;

        return view('dashboard.employee-evaluation', $data);
    }

    public function ktbEvaluation()
    {
        return view('dashboard.ktb-evaluation');
    }

    public function ktbEvaluationAction(Request $request)
    {  
        $request->validate([
            'technical_ktb_number' => ['required_with:technisch_von', 'required_with:technisch_zu'],
            'technisch_von' => ['required_with:technical_ktb_number', 'required_with:technisch_zu'],
            'technisch_zu' => ['required_with:technical_ktb_number', 'required_with:technisch_von'],
            'maintenance_ktb_number' => ['required_with:wartung_von', 'required_with:wartung_zu'],
            'wartung_von' => ['required_with:maintenance_ktb_number', 'required_with:wartung_zu'],
            'wartung_zu' => ['required_with:maintenance_ktb_number', 'required_with:wartung_von'],
        ]);

        $technicalKtbNumber = $request->technical_ktb_number;
        $technischVon = Carbon::parse($request->technisch_von)->format('Y-m-d');
        $technischZu = Carbon::parse($request->technisch_zu)->format('Y-m-d');
        $maintenanceKtbNumber = $request->maintenance_ktb_number;
        $wartungVon = Carbon::parse($request->wartung_von)->format('Y-m-d');
        $wartungZu = Carbon::parse($request->wartung_zu)->format('Y-m-d');  

        $technicalOffers = TechnicalOffer::whereBetween('offer_date', [$technischVon, $technischZu])->where('ktb_number',  $technicalKtbNumber)->selectRaw('sum(offer_amount) as total_offer_amount, count(*) as total_offer')->get();

        $technicalOrders = TechnicalOffer::whereBetween('order_date', [$technischVon, $technischZu])->where('ktb_number',  $technicalKtbNumber)->selectRaw('sum(order_amount) as total_order_amount, count(*) as total_order')->get();

        $maintenanceOffers = MaintenanceOffer::whereBetween('offer_date', [$wartungVon, $wartungZu])->where('ktb_number',  $maintenanceKtbNumber)->selectRaw('sum(offer_amount) as total_offer_amount, count(*) as total_offer')->get();

        $maintenanceOders = MaintenanceOffer::whereBetween('contact_conclusion', [$wartungVon, $wartungZu])->where('ktb_number',  $maintenanceKtbNumber)->selectRaw('sum(sum_per_year) as total_order_amount, count(*) as total_order')->get();

        $data = array();
        $data['technicalKtbNumber'] = $technicalKtbNumber;
        $data['technicalOffers'] = $technicalOffers;
        $data['technicalOrders'] = $technicalOrders;
        $data['maintenanceKtbNumber'] = $maintenanceKtbNumber;
        $data['maintenanceOffers'] = $maintenanceOffers;
        $data['maintenanceOders'] = $maintenanceOders;

        return view('dashboard.ktb-evaluation', $data);
    }

    public function difference()
    {
        return view('dashboard.difference');
    }

    public function differenceAction(Request $request)
    {
        $request->validate([
            'technisch_von' => ['required_with:technisch_zu'],
            'technisch_zu' => ['required_with:technisch_von'],
            'wartung_von' => ['required_with:wartung_zu'],
            'wartung_zu' => ['required_with:wartung_von'],
        ]);

        $technischVon = Carbon::parse($request->technisch_von)->format('Y-m-d');
        $technischZu = Carbon::parse($request->technisch_zu)->format('Y-m-d');
        $wartungVon = Carbon::parse($request->wartung_von)->format('Y-m-d');
        $wartungZu = Carbon::parse($request->wartung_zu)->format('Y-m-d');

        $technicalOffers = TechnicalOffer::whereBetween('offer_date', [$technischVon, $technischZu])->where('received_date', '<>', null)->get();

        foreach ($technicalOffers as $technicalOffer){ 
            $difference = $technicalOffer->offer_amount - $technicalOffer->invice_amount;
            $difference = number_format((float)$difference, 2, '.', '');
            if($technicalOffer->offer_amount != 0){
                $percent = ($difference/$technicalOffer->offer_amount) * 100;
                $percent = number_format((float)$percent, 2, '.', '');
            } else {
                $percent = 0;
            }
            $technicalOffer['difference']= $difference;
            $technicalOffer['percent']= $percent;
        }

        $maintenanceOffers = MaintenanceOffer::whereBetween('offer_date', [$wartungVon, $wartungZu])->where('received_date', '<>', null)->get();

        foreach ($maintenanceOffers as $maintenanceOffer){ 
            $difference = $maintenanceOffer->offer_amount - $maintenanceOffer->sum_per_year;
            $difference = number_format((float)$difference, 2, '.', '');
            if($maintenanceOffer->sum_per_year != 0){
                $percent = ($difference/$maintenanceOffer->sum_per_year) * 100;
                $percent = number_format((float)$percent, 2, '.', '');
            } else {
                $percent = 0;
            }
            $maintenanceOffer['difference']= $difference;
            $maintenanceOffer['percent']= $percent;
        }

        $data = array();
        $data['technicalOffers'] = $technicalOffers;
        $data['maintenanceOffers'] = $maintenanceOffers;

        return view('dashboard.difference', $data);
    }

    public function receivedVia()
    {
        return view('dashboard.evaluation-received-via');
    }

    public function receivedViaAction(Request $request)
    {  
        $request->validate([
            'technisch_von' => ['required_with:technisch_zu'],
            'technisch_zu' => ['required_with:technisch_von'],
            'wartung_von' => ['required_with:wartung_zu'],
            'wartung_zu' => ['required_with:wartung_von'],
        ]);

        $technischVon = Carbon::parse($request->technisch_von)->format('Y-m-d');
        $technischZu = Carbon::parse($request->technisch_zu)->format('Y-m-d');
        $wartungVon = Carbon::parse($request->wartung_von)->format('Y-m-d');
        $wartungZu = Carbon::parse($request->wartung_zu)->format('Y-m-d');  

        $technicalOffers = TechnicalOffer::whereBetween('received_date', [$technischVon, $technischZu])->groupBy('get_over')->selectRaw('count(*) as total_received, get_over')->get();

        $totalTechnicalReceived = 0;

        foreach ($technicalOffers as $technicalOffer){ 
            $totalTechnicalReceived = $totalTechnicalReceived + $technicalOffer->total_received;
        }
        
        if($totalTechnicalReceived != 0){
            foreach ($technicalOffers as $technicalOffer){ 
                $percent = ($technicalOffer->total_received/$totalTechnicalReceived) * 100;
                $percent = number_format((float)$percent, 2, '.', '');
                $technicalOffer['percent']= $percent;
            }
        } else {
            foreach ($technicalOffers as $technicalOffer){ 
                $technicalOffer['percent']= 0;
            }
        }

        $maintenanceOffers = MaintenanceOffer::whereBetween('received_date', [$wartungVon, $wartungZu])->groupBy('get_over')->selectRaw('count(*) as total_received, get_over')->get();

        $totalmaintenanceReceived = 0;

        foreach ($maintenanceOffers as $maintenanceOffer){ 
            $totalmaintenanceReceived = $totalmaintenanceReceived + $maintenanceOffer->total_received;
        }
        
        if($totalmaintenanceReceived != 0){
            foreach ($maintenanceOffers as $maintenanceOffer){ 
                $percent = ($maintenanceOffer->total_received/$totalmaintenanceReceived) * 100;
                $percent = number_format((float)$percent, 2, '.', '');
                $maintenanceOffer['percent']= $percent;
            }
        } else {
            foreach ($technicalOffers as $technicalOffer){ 
                $maintenanceOffer['percent']= 0;
            }
        }

        $data = array();
        $data['technicalOffers'] = $technicalOffers;
        $data['maintenanceOffers'] = $maintenanceOffers;

        return view('dashboard.evaluation-received-via', $data);
    }

    public function evaluationAfterInterview()
    {
        return view('dashboard.evaluation-after-interview');
    }

    public function evaluationAfterInterviewAction(Request $request)
    {  
        $request->validate([
            'technisch_von' => ['required_with:technisch_zu'],
            'technisch_zu' => ['required_with:technisch_von'],
            'wartung_von' => ['required_with:wartung_zu'],
            'wartung_zu' => ['required_with:wartung_von'],
        ]);
        
        $technischVon = Carbon::parse($request->technisch_von)->format('Y-m-d');
        $technischZu = Carbon::parse($request->technisch_zu)->format('Y-m-d');
        $wartungVon = Carbon::parse($request->wartung_von)->format('Y-m-d');
        $wartungZu = Carbon::parse($request->wartung_zu)->format('Y-m-d');  

        $technicalOffers = TechnicalOffer::whereBetween('received_date', [$technischVon, $technischZu])->groupBy('conversation_status')->selectRaw('count(*) as total_received, conversation_status')->get();

        $maintenanceOffers = MaintenanceOffer::whereBetween('received_date', [$wartungVon, $wartungZu])->groupBy('conversation_status')->selectRaw('count(*) as total_received, conversation_status')->get();
        
        $data = array();
        $data['technicalOffers'] = $technicalOffers;
        $data['maintenanceOffers'] = $maintenanceOffers;

        return view('dashboard.evaluation-after-interview', $data);
    }
}