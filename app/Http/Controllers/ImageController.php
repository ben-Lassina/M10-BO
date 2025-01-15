<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    // Fetch images by letter (e.g., A, B, etc.)
    public function fetchByLetter($letter)
    {
        \Log::info("Fetching images for letter: $letter");

        $images = Image::where('letter', $letter)->get();

        if ($images->isEmpty()) {
            \Log::warning("No images found for letter: $letter");
            return response()->json([], 404);
        }

        \Log::info("Images found: " . $images->count());
        return response()->json($images);
    }

    // Search for images based on the query
    public function search(Request $request)
    {
        $query = $request->input('query');

        \Log::info("Search query: $query");

        $images = Image::where('title', 'like', "%$query%")
                        ->orWhere('letter', 'like', "%$query%")
                        ->get();

        if ($images->isEmpty()) {
            \Log::warning("No results found for search query: $query");
            return response()->json([], 404);
        }

        \Log::info("Search results count: " . $images->count());
        return response()->json($images);
    }
}
