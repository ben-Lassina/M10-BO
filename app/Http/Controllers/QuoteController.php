<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;

class QuoteController extends Controller
{
    // Fetch the daily quote
    public function dailyQuote()
    {
        // Assuming you want a random quote
        $quote = Quote::inRandomOrder()->first();

        return response()->json([
            'quote' => $quote->quote,
            'meaning' => $quote->meaning,
            'image_path' => $quote->image_path
        ]);
    }

    // Fetch quotes by language
    public function quotesByLanguage($language)
    {
        $quotes = Quote::where('language', $language)->get();

        return response()->json($quotes);
    }
}
