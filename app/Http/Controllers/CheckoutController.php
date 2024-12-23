<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $plan = 'price_1QZ3biDgwQ2kaUkEaEyAxWbH')
    {
        return $request->user()
            ->newSubscription('prod_RRxWAeh2UK6qtl', $plan)
            ->checkout([
                'success_url' => route('success'),
                'cancel_url' => route('subscribe'),
            ]);
    }
}
