<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Offer;
use Illuminate\Support\Carbon;

class CheckOffers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { $offers = Offer::all();

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
