<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Make sure User model exists

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = User::where('name', 'LIKE', "%{$query}%")
                        // ->orWhere('email', 'LIKE', "%{$query}%")
                        ->get();

        return response()->json($results);
    }
}
