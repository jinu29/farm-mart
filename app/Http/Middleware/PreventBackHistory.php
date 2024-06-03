<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $headers = [
            'Cache-Control' => 'nocache, no-store, max-age=0, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => 'Sat, 26 Jul 1997 05:00:00 GMT'
        ];
        
        $response = $next($request);
        
        foreach($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        if($request->is('register')){
            // dd(Auth::user()->id);
            //  dd($request->all());
            $address = new Address;
            if ($request->has('customer_id')) {
                $address->user_id   = $request->customer_id;
            } else {
                $address->user_id   = Auth::user()->id;
            }
            $address->address       = $request->address;
            $address->country_id    = $request->country_id;
            $address->state_id      = $request->state_id;
            $address->city_id       = $request->city_id;
            $address->longitude     = $request->longitude;
            $address->latitude      = $request->latitude;
            $address->postal_code   = $request->postal_code;
            $address->phone         = $request->phone;
            $address->save();
        }
 
        return $response;
    }
}
