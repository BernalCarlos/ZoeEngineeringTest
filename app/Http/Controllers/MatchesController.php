<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Matchers\AgentContactMatcher;
use App\Matchers\ZipCodeDistanceMatcher;

class MatchesController extends Controller
{
    private $agentContactMatcher;

    public function __construct(AgentContactMatcher $agentContactMatcher)
    {
        $this->middleware('auth');

        $this->agentContactMatcher = $agentContactMatcher;
    }

    public function index(Request $request)
    {
        $loggedAgent = Auth::user();
        $matchOptions = [
            'radius' => $request->get('search_radius') ?: ZipCodeDistanceMatcher::DEFAULT_RADIUS,
        ];

        $matchedContacts = $this->agentContactMatcher->matchWithContacts($loggedAgent, $matchOptions);

        return view('matches', [
            'agent' => $loggedAgent,
            'matchedContacts' => $matchedContacts,
            'searchRadius' => $matchOptions['radius'],
        ]);
    }
}
