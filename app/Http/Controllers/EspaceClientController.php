<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Inertia\Inertia;
class EspaceClientController extends Controller
{
     public function index(Request $request)
    {
       return Inertia::render('espace-client', [
        'user' => auth()->user(),
        'isNewUser' => auth()->user()->created_at->diffInMinutes(now()) < 5,
    ]);
    }
}


