<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CheckoutController extends Controller
{
   // STripe Checkout
    public function createCheckout(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $billing = $request->input('billing');
            if (!in_array($billing, ['monthly', 'yearly'])) {
                return response()->json(['error' => 'Invalid billing parameter'], 400);
            }

            $price_id = $billing === 'monthly'
                ? 'price_1QiCBgFllnWu1kBS8o06btGE'
                : 'price_1QiCBgFllnWu1kBS0rDzxGN4';

            $checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price' => $price_id,
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',
                'success_url' => route('stripe.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
                'cancel_url' => route('stripe.cancel'),
            ]);

            return redirect()->away($checkout_session->url);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handleSuccess(Request $request)
    {
        $session_id = $request->query('session_id');

        if (!$session_id) {
            return response()->json(['error' => 'Missing session_id parameter'], 400);
        }

        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $session = Session::retrieve($session_id);

            if ($session->payment_status === 'paid') {
                return view('stripe.success', ['session' => $session]);
            } else {
                return view('stripe.failed');
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handleCancel()
    {
        return view('stripe.cancel');
    }
}
