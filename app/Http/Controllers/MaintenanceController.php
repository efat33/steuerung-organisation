<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\MaintenanceOffer;
use App\Models\User;
use App\Http\Requests\MaintenanceOfferRequest;
use App\Mail\MailToWorker;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Jobs\EmailWorkerJob;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenanceOffers = MaintenanceOffer::latest()->paginate(config('settings.pagination.per_page'));
        return view('maintenance.index', compact('maintenanceOffers'));
    }

    public function view(MaintenanceOffer $maintenanceOffer)
    {
        $file_name = $maintenanceOffer['file_name'];
        $filesArray = explode('/ ', $file_name);
        return view('maintenance.view', compact('maintenanceOffer', 'filesArray'));
    }

    public function create()
    {
        $users = User::where('user_type', 'worker')->get();
        return view('maintenance.create', compact('users'));
    }

    public function store(MaintenanceOfferRequest $request)
    {       
        $maintenanceOfferId = MaintenanceOffer::create([
            'get_over' => $request->get_over,
            'cs_order_number' => $request->cs_order_number,
            'received_date' => $request->received_date != '' ? Carbon::parse($request->received_date)->format('Y-m-d') : null,
            'received_from' => $request->received_from,
            'customer_number' => $request->customer_number,
            'contact_person' => $request->contact_person,
            'contact_number' => $request->contact_number,
            'technical_place' => $request->technical_place,
            'technical_place_address' => $request->technical_place_address,
            'technical_postcode' => $request->technical_postcode,
            'registered_by' => $request->registered_by,
            'status' => $request->status,
            'offer_type' => $request->offer_type,
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
        ])->id;

        if ($request->hasfile('pdf_file')) {
            $filesArray = array();
            foreach ($request->pdf_file as $file) {
                $originalName = $file->getClientOriginalName();
                $originalName = basename($originalName, ".pdf");

                $extension = $file->extension();
                $fileName = $originalName.'_'.time(); 
                $fileName = str_replace(' ', '_', $fileName); 
                $fileName = str_replace('-', '_', $fileName); 
                $fileName = $fileName.'.'.$extension;
                
                $file->move(public_path('uploads'), $fileName);

                array_push($filesArray, $fileName);             
            }
            $filesString = implode("/ ",$filesArray);

            $technicalOffer = MaintenanceOffer::find($maintenanceOfferId);
            $technicalOffer->file_name = $filesString;
            $technicalOffer->save();
        }

        if ($request->registered_by){
            $user = User::find($request->registered_by);
            //Mail::to($user->email)->send(new MailToWorker($user->name, $maintenanceOfferId, 'maintenance'));
            dispatch(new EmailWorkerJob($user->email, $user->name, $maintenanceOfferId, 'maintenance'));
        }

        return back()->with('status', 'Maintenance offer added successfully');
    }

    public function edit(MaintenanceOffer $maintenanceOffer)
    {
        $users = User::where('user_type', 'worker')->get();
        $file_name = $maintenanceOffer['file_name'];
        $filesArray = explode('/ ', $file_name);
        return view('maintenance.edit', compact('maintenanceOffer', 'users', 'filesArray'));
    }

    public function update(MaintenanceOfferRequest $request, MaintenanceOffer $maintenanceOffer)
    {
        if ($request->registered_by != $maintenanceOffer->registered_by){
            $user = User::find($request->registered_by);
            //Mail::to($user->email)->send(new MailToWorker($user->name, $maintenanceOffer->id, 'maintenance'));
            dispatch(new EmailWorkerJob($user->email, $user->name, $maintenanceOffer->id, 'maintenance'));
        }

        $maintenanceOffer->get_over = $request->get_over;
        $maintenanceOffer->cs_order_number = $request->cs_order_number;
        $maintenanceOffer->received_date = $request->received_date != '' ? Carbon::parse($request->received_date)->format('Y-m-d') : null;
        $maintenanceOffer->received_from = $request->received_from;
        $maintenanceOffer->customer_number = $request->customer_number;
        $maintenanceOffer->contact_person = $request->contact_person;
        $maintenanceOffer->contact_number = $request->contact_number;
        $maintenanceOffer->technical_place = $request->technical_place;
        $maintenanceOffer->technical_place_address = $request->technical_place_address;
        $maintenanceOffer->technical_postcode = $request->technical_postcode;
        $maintenanceOffer->registered_by = $request->registered_by;
        $maintenanceOffer->status = $request->status;
        $maintenanceOffer->offer_type = $request->offer_type;
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

        $filesArray = array();
        $finalFilesArray = array();
        if ($request->hasfile('pdf_file')) {
            foreach ($request->pdf_file as $file) {
                $originalName = $file->getClientOriginalName();
                $originalName = basename($originalName, ".pdf");

                $extension = $file->extension();
                $fileName = $originalName.'_'.time(); 
                $fileName = str_replace(' ', '_', $fileName); 
                $fileName = str_replace('-', '_', $fileName); 
                $fileName = $fileName.'.'.$extension;
                
                $file->move(public_path('uploads'), $fileName);

                array_push($filesArray, $fileName); 

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
                
                if($maintenanceOffer->file_name){
                    $existed_file_name = $maintenanceOffer['file_name'];
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
            $maintenanceOffer->file_name = $finalFilesString;
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
          
                $existed_file_name = $maintenanceOffer['file_name'];
                $existedFilesArray = explode('/ ', $existed_file_name);

                $finalFilesArray = array_diff($existedFilesArray, $filesArray);

                if ($finalFilesArray){
                    $finalFilesString = implode("/ ",$finalFilesArray);
                    $maintenanceOffer->file_name = $finalFilesString;
                } else {
                    $maintenanceOffer->file_name = Null;
                }
            } 
        }
        $maintenanceOffer->save();

        return Redirect::back()->with('status', 'Updated Successfully');
    }

    public function destroy(MaintenanceOffer $maintenanceOffer)
    {
        $maintenanceOffer->delete();

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
            if (request()->filled('package')) {
                $filterKeys['package'] = request()->package;
            }

            if(count($filterKeys) > 0 || $keyword != '') {
                $users = User::where('user_type', 'worker')->get();
                $maintenanceOffers = MaintenanceOffer::where($filterKeys)
                        ->where(function ($query) use ($keyword) {
                            $query->orWhere('id', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('customer_number', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('contact_number', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('contact_person', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('technical_place', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('technical_postcode', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('ktb_number', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('quote_number', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('cs_order_number', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('received_from', 'LIKE', '%'.$keyword.'%');
                        })
                        ->paginate(config('settings.pagination.per_page'));
                if(count($maintenanceOffers) == 0){
                    $data['is_form_submit'] = true;
                    return view('maintenance.search', $data)->with('status', 'Keine Übereinstimmung gefunden.');
                }
                $data['maintenanceOffers'] = $maintenanceOffers;
                $data['is_form_submit'] = true;
                return view('maintenance.search', $data);
            } else {
                $data['is_form_submit'] = true;
                return view('maintenance.search', $data)->with('status', 'Geben Sie die Schlüssel im Formular oben ein.');
            }
        }
        return view('maintenance.search', $data);
    }
}
