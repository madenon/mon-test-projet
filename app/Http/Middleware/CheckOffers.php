<?php

namespace App\Http\Middleware;

use App\Models\Campaign;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Offer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;


class CheckOffers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { $offers = Offer::all();
        $campaigns=Campaign::all();
        foreach ($campaigns as $campaign) {
            if ($campaign->start_date && $campaign->end_date) {
                $now = Carbon::now(); // Set the current time to UTC+1
        
                $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $campaign->start_date, $campaign->timezone);;
                $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $campaign->end_date, $campaign->timezone);
                $start_date->setTimezone('UTC');
                $end_date->setTimezone('UTC');
              
        
                if ($start_date->isPast() && !$end_date->isPast()) {
                    $campaign->is_active = true;
                    $campaign->save();
                } else {$campaign->is_active = false;
                    $campaign->save();}
            }
        }
        
        

        foreach ($offers as $offer) {
            if($offer->expiration_date){
            if (Carbon::parse($offer->expiration_date)->isPast()) {
                // Expire the offer by deleting it
                $offer->delete();
                // Alternatively, you can update the status or perform other actions
            }}
            $launchDate=$offer->launch_date;
            if ( $launchDate && Carbon::parse($launchDate)->isPast()){
                $offer->launch_date=null;
                $offer->save();
            }
        }
       
        return $next($request);
    }
}
