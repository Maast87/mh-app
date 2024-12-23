<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user() ? [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'subscribed' => $request->user()->subscribed('prod_RRxWAeh2UK6qtl'),
                    'subscribed_to_monthly' => $request->user()->subscribedToPrice('price_1QZ3biDgwQ2kaUkEaEyAxWbH', 'prod_RRxWAeh2UK6qtl'),
                    'subscribed_to_yearly' => $request->user()->subscribedToPrice('price_1QZ3bEDgwQ2kaUkE5yC5gqO0', 'prod_RRxWAeh2UK6qtl'),
                ] : null,
            ],
        ];
    }
}
