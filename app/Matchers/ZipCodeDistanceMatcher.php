<?php
namespace App\Matchers;

use App\Models\Agent;
use App\Models\Contact;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ZipCodeDistanceMatcher implements AgentContactMatcher
{
    /**
     * Returns a list of contacts that make a match with the supplied agent, based on the zip code distances.
     *
     * @param Agent $agent
     * @param array $options Optional.
     *
     * @return Collection Collection of contacts
     */
    public function matchWithContacts(Agent $agent, $options = [])
    {
        $options = $this->parseOptions($options);

        $closestZipCodes = $this->getZipCodesClosestTo($agent->zip_code, $options['radius']);

        return Contact::whereIn('zip_code', $closestZipCodes)->get();
    }

    protected function parseOptions($options)
    {
        $options['radius'] = isset($options['radius']) ? $options['radius'] : self::DEFAULT_RADIUS;

        return $options;
    }

    protected function getZipCodesClosestTo($originZipCode, $radius)
    {
        $query = "SELECT z2.zip_code, ST_DistanceSphere(z1.geom, z2.geom) as distance FROM zip_codes as z1 JOIN zip_codes as z2 
            ON ST_DWithin(z1.geom::geography, z2.geom::geography, ?)
            WHERE z1.zip_code = ?
            order by distance;";

        $closestZipCodes = DB::select($query, [
            $radius,
            $originZipCode
        ]);

        return array_pluck($closestZipCodes, 'zip_code');
    }
}