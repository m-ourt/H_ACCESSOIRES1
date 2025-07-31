<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $isNewUser = $user->created_at->greaterThan(Carbon::now()->subDay());

   
        return Inertia::render('Dashboard', [
            'user' => auth()->user(),
            'isNewUser' => $isNewUser,
            'products' => Product::all()
        ]);
    }
}
