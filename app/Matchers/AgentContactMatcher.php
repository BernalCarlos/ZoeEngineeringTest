<?php
namespace App\Matchers;

use App\Models\Agent;

interface AgentContactMatcher
{
    const DEFAULT_RADIUS = 30000;

    /**
     * Returns a list of contacts that make a match with the supplied agent, based on the matcher implementation.
     *
     * @param Agent $agent
     * @param array $options Optional.
     *
     * @return array Array of contacts
     */
    public function matchWithContacts(Agent $agent, $options = []);
}
