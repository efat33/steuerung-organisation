<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\TechnicalOffer;
use App\Models\MaintenanceOffer;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfferFollowUp;
use Illuminate\Support\Facades\Log;

class AutoOfferFollowUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offerfollowup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Offer follow-up email command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $toDay = Carbon::now();
        $toDay = $toDay->format('Y-m-d');

        $technicalOffers = TechnicalOffer::where('offer_follow_up', '<=', $toDay)->where('offer_follow_up_emailed', null)->where('registered_by', '<>', null)->get();
        if(count($technicalOffers) > 0){
            foreach($technicalOffers as $item){
                Mail::to($item->user->email)->send(new OfferFollowUp($item->user->name, $item->id, 'technical'));
                $technicalOffer = TechnicalOffer::find($item->id);
                $technicalOffer->offer_follow_up_emailed = $toDay;
                $technicalOffer->save();
            }
        }
        $maintenanceOffers = MaintenanceOffer::where('offer_follow_up', '<=', $toDay)->where('offer_follow_up_emailed', null)->where('registered_by', '<>', null)->get();
        if(count($maintenanceOffers) > 0){
            foreach($maintenanceOffers as $item){
                Mail::to($item->user->email)->send(new OfferFollowUp($item->user->name, $item->id, 'maintenance'));
                $maintenanceOffer = MaintenanceOffer::find($item->id);
                $maintenanceOffer->offer_follow_up_emailed = $toDay;
                $maintenanceOffer->save();
            }
        }
        return false;
        // return Command::SUCCESS;
    }
}
