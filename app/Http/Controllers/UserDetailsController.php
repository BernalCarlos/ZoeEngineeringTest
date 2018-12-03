<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserDetailsController extends Controller
{
    public function index()
    {
        $loggedAgent = Auth::user();

        return view('user-details', [
            'agent' => $loggedAgent
        ]);
    }
}