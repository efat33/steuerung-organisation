<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TechniclOfferRequest;
use App\Mail\MailToWorker;
use App\Models\TechnicalOffer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Jobs\EmailWorkerJob;

class TechnicalController extends Controller
{
    public function index()
    {
        $technicalOffers = TechnicalOffer::latest()->paginate(config('settings.pagination.per_page'));
        return view('technical.index', compact('technicalOffers'));
    }

    public function view(TechnicalOffer $technicalOffer)
    {
        $file_name = $technicalOffer['file_name'];
        $filesArray = explode('/ ', $file_name);
        return view('technical.view', compact('technicalOffer', 'filesArray'));
    }

    public function create()
    {
        $users = User::where('user_type', 'worker')->get();
        return view('technical.create', compact('users'));
    }

    public function store(TechniclOfferRequest $request)
    {       
        $technicalOfferId = TechnicalOffer::create([
            'get_over' => $request->get_over,
            'cs_order_number' => $request->cs_order_number,
            'received_date' => $request->received_date != '' ? Carbon::parse($request->received_date)->format('Y-m-d') : null,
            'received_from' => $request->received_from,
            'customer_number' => $request->customer_number,
            'contact_person' => $request->contact_person,
            'customer_email_address' => $request->customer_email_address,
            'contact_number' => $request->contact_number,
            'technical_place' => $request->technical_place,
            'technical_place_address' => $request->technical_place_address,
            'technical_postcode' => $request->technical_postcode,
            'registered_by' => $request->registered_by,
            'status' => $request->status,
            'offer_type' => $request->offer_type,
            'civil_technical_acceptance' => $request->civil_technical_acceptance,
            'ktb_number' => $request->ktb_number,
            'quote_number' => $request->quote_number,
            'offer_date' => $request->offer_date != '' ? Carbon::parse($request->offer_date)->format('Y-m-d') : null,
            'offer_amount' => $request->offer_amount != '' ? str_replace(',','.',$request->offer_amount) : null,
            'offer_follow_up' => $request->offer_follow_up != '' ? Carbon::parse($request->offer_follow_up)->format('Y-m-d') : null,
            'conversation_status' => $request->conversation_status,
            'order_number' => $request->order_number,
            'order_date' => $request->order_date != '' ? Carbon::parse($request->order_date)->format('Y-m-d') : null,
            'order_amount' => $request->order_amount,
            'execution_date' => $request->execution_date != '' ? Carbon::parse($request->execution_date)->format('Y-m-d') : null,
            'approval_date' => $request->approval_date != '' ? Carbon::parse($request->approval_date)->format('Y-m-d') : null,
            'invice_amount' => $request->invice_amount,
            'notes' => $request->notes,
        ])->id;

        if ($request->hasfile('pdf_file')) {
            $files_not_previewed = $request->files_not_previewed;
            $filesNotPreviewedArray = explode('.pdf', $files_not_previewed);
            array_pop($filesNotPreviewedArray);
            $filesArray = array();
            foreach ($request->pdf_file as $file) {
                $originalName = $file->getClientOriginalName();
                $originalName = basename($originalName, ".pdf");

                $extension = $file->extension();
                $fileName = $originalName.'_'.time(); 
                $fileName = str_replace(' ', '_', $fileName); 
                $fileName = str_replace('-', '_', $fileName); 
                $fileName = $fileName.'.'.$extension;
    
                $isMatched = in_array($originalName, $filesNotPreviewedArray);
                if(!$isMatched){
                    $file->move(public_path('uploads'), $fileName);
                    array_push($filesArray, $fileName);
                }                 
            }
            $filesString = implode("/ ",$filesArray);

            $technicalOffer = TechnicalOffer::find($technicalOfferId);
            $technicalOffer->file_name = $filesString;
            $technicalOffer->save();
        }
        
        if ($request->registered_by){
            $user = User::find($request->registered_by);
            //Mail::to($user->email)->send(new MailToWorker($user->name, $technicalOfferId, 'technical'));
            dispatch(new EmailWorkerJob($user->email, $user->name, $technicalOfferId, 'technical'));
        }

        return back()->with('status', 'Technical offer added successfully');
    }

    public function edit(TechnicalOffer $technicalOffer)
    {
        $users = User::where('user_type', 'worker')->get();
        $file_name = $technicalOffer['file_name'];
        $filesArray = explode('/ ', $file_name);
        return view('technical.edit', compact('technicalOffer', 'users', 'filesArray'));
    }

    public function update(TechniclOfferRequest $request, TechnicalOffer $technicalOffer)
    {
        if ($request->registered_by != $technicalOffer->registered_by){
            $user = User::find($request->registered_by);
            //Mail::to($user->email)->send(new MailToWorker($user->name, $technicalOffer->id, 'technical'));
            dispatch(new EmailWorkerJob($user->email, $user->name, $technicalOffer->id, 'technical'));
        }
        
        $technicalOffer->get_over = $request->get_over;
        $technicalOffer->cs_order_number = $request->cs_order_number;
        $technicalOffer->received_date = $request->received_date != '' ? Carbon::parse($request->received_date)->format('Y-m-d') : null;
        $technicalOffer->received_from = $request->received_from;
        $technicalOffer->customer_number = $request->customer_number;
        $technicalOffer->contact_person = $request->contact_person;
        $technicalOffer->customer_email_address = $request->customer_email_address;
        $technicalOffer->contact_number = $request->contact_number;
        $technicalOffer->technical_place = $request->technical_place;
        $technicalOffer->technical_place_address = $request->technical_place_address;
        $technicalOffer->technical_postcode = $request->technical_postcode;
        $technicalOffer->registered_by = $request->registered_by;
        $technicalOffer->status = $request->status;
        $technicalOffer->offer_type = $request->offer_type;
        $technicalOffer->civil_technical_acceptance = $request->civil_technical_acceptance;
        $technicalOffer->ktb_number = $request->ktb_number;
        $technicalOffer->quote_number = $request->quote_number;
        $technicalOffer->offer_date = $request->offer_date != '' ? Carbon::parse($request->offer_date)->format('Y-m-d') : null;
        $technicalOffer->offer_amount = $request->offer_amount != '' ? str_replace(',','.',$request->offer_amount) : null;
        $technicalOffer->offer_follow_up = $request->offer_follow_up != '' ? Carbon::parse($request->offer_follow_up)->format('Y-m-d') : null;
        $technicalOffer->conversation_status = $request->conversation_status;
        $technicalOffer->order_number = $request->order_number;
        $technicalOffer->order_date = $request->order_date != '' ? Carbon::parse($request->order_date)->format('Y-m-d') : null;
        $technicalOffer->order_amount = $request->order_amount;
        $technicalOffer->execution_date = $request->execution_date != '' ? Carbon::parse($request->execution_date)->format('Y-m-d') : null;
        $technicalOffer->approval_date = $request->approval_date != '' ? Carbon::parse($request->approval_date)->format('Y-m-d') : null;
        $technicalOffer->invice_amount = $request->invice_amount;
        $technicalOffer->notes = $request->notes;

        $filesArray = array();
        $finalFilesArray = array();
        if ($request->hasfile('pdf_file')) {
            $files_not_previewed = $request->files_not_previewed;
            $filesNotPreviewedArray = explode('.pdf', $files_not_previewed);
            array_pop($filesNotPreviewedArray);
            foreach ($request->pdf_file as $file) {
                $originalName = $file->getClientOriginalName();
                $originalName = basename($originalName, ".pdf");

                $extension = $file->extension();
                $fileName = $originalName.'_'.time(); 
                $fileName = str_replace(' ', '_', $fileName); 
                $fileName = str_replace('-', '_', $fileName); 
                $fileName = $fileName.'.'.$extension;

                $isMatched = in_array($originalName, $filesNotPreviewedArray);
                if(!$isMatched){
                    $file->move(public_path('uploads'), $fileName);
                    array_push($filesArray, $fileName);
                }
                
                $filesDeleteArray = array();
                if ($request->files_to_delete) {
                    $filesToDelete = $request->files_to_delete;
                    $filesToDeleteArray = explode('pdf', $filesToDelete);

                    foreach ($filesToDeleteArray as $item) {
                        $item = $item.'pdf';
                        array_push($filesDeleteArray, $item);
                    }
                    array_pop($filesDeleteArray);
    
                    foreach ($filesDeleteArray as $item) {
                        if(File::exists(public_path('uploads/'.$item))){
                            File::delete(public_path('uploads/'.$item));
                        }
                    }
                }
                
                if($technicalOffer->file_name){
                    $existed_file_name = $technicalOffer['file_name'];
                    $existedFilesArray = explode('/ ', $existed_file_name);
                    $finalFilesArray = array_merge($existedFilesArray, $filesArray);
                } else {
                    $finalFilesArray = $filesArray;
                }
                if($filesDeleteArray){
                    $finalFilesArray = array_diff($finalFilesArray, $filesDeleteArray);
                }
            }
            $finalFilesString = implode("/ ",$finalFilesArray);
            $technicalOffer->file_name = $finalFilesString;
        } else {
            if ($request->files_to_delete) {
                $filesToDelete = $request->files_to_delete;
                $filesToDeleteArray = explode('pdf', $filesToDelete);

                foreach ($filesToDeleteArray as $item) {
                    $item = $item.'pdf';
                    array_push($filesArray, $item);
                }
                array_pop($filesArray);

                foreach ($filesArray as $item) {
                    if(File::exists(public_path('uploads/'.$item))){
                        File::delete(public_path('uploads/'.$item));
                    }
                }
          
                $existed_file_name = $technicalOffer['file_name'];
                $existedFilesArray = explode('/ ', $existed_file_name);

                $finalFilesArray = array_diff($existedFilesArray, $filesArray);

                if ($finalFilesArray){
                    $finalFilesString = implode("/ ",$finalFilesArray);
                    $technicalOffer->file_name = $finalFilesString;
                } else {
                    $technicalOffer->file_name = Null;
                }
            } 
        }
        $technicalOffer->save();

        return Redirect::back()->with('status', 'Updated Successfully');
    }

    public function destroy(TechnicalOffer $technicalOffer)
    {
        if($technicalOffer->file_name) {
            $finalsArray = explode("/ ", $technicalOffer->file_name);
            foreach ($finalsArray as $item) {
                if(File::exists(public_path('uploads/'.$item))){
                    File::delete(public_path('uploads/'.$item));
                }
            }
        }
        $technicalOffer->delete();

        return Redirect::back()->with('status', 'Deleted Successfully');
    }

    public function search()
    {
        $users = User::where('user_type', 'worker')->get();
        $data = array();
        $data['users'] = $users;
        $data['is_form_submit'] = false;

        if(request()->has('_token')){
            $keyword = '';
            $filterKeys = array();
            if(request()->filled('keyword')){
                $keyword = request()->keyword;
            }
            if (request()->filled('registered_by')) {
                $filterKeys['registered_by'] = request()->registered_by;
            }
            if (request()->filled('get_over')) {
                $filterKeys['get_over'] = request()->get_over;
            }
            if (request()->filled('status')) {
                $filterKeys['status'] = request()->status;
            }
            if (request()->filled('offer_type')) {
                $filterKeys['offer_type'] = request()->offer_type;
            }
            if (request()->filled('conversation_status')) {
                $filterKeys['conversation_status'] = request()->conversation_status;
            }
            if(count($filterKeys) > 0 || $keyword != '') {
                $technicalOffers = TechnicalOffer::where($filterKeys)
                        ->where(function ($query) use ($keyword) {
                            $query->orWhere('id', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('customer_number', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('contact_number', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('contact_person', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('technical_place', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('technical_place_address', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('technical_postcode', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('ktb_number', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('quote_number', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('order_number', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('cs_order_number', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('received_from', 'LIKE', '%'.$keyword.'%');
                        })
                        ->paginate(config('settings.pagination.per_page'));
                if(count($technicalOffers) == 0){
                    $data['is_form_submit'] = true;
                    return view('technical.search', $data)->with('status', 'Keine Übereinstimmung gefunden.');
                }
                $data['technicalOffers'] = $technicalOffers;
                $data['is_form_submit'] = true;
                return view('technical.search', $data);
            } else {
                $data['is_form_submit'] = true;
                return view('technical.search', $data)->with('status', 'Geben Sie die Schlüssel im Formular oben ein.');
            }
        }
        return view('technical.search', $data);
    }
}
