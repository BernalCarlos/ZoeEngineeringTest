<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Agent;
use App\Models\Contact;
use App\Matchers\ZipCodeDistanceMatcher;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ZipCodeDistanceMatcherTest extends TestCase
{
    use DatabaseTransactions;

    private $mockedAgent;
    private $mockedContacts;

    public function setUp()
    {
        parent::setUp();

        $this->createMockedAgent();
        $this->createMockedContacts();
    }

    public function test_it_matches_only_the_closest_contacts()
    {
        $contactMatcher = $this->app->make(ZipCodeDistanceMatcher::class);

        $matchedContacts = $contactMatcher->matchWithContacts($this->mockedAgent, [
            'radius' => 30000
        ]);

        $this->assertTrue($matchedContacts->contains($this->mockedContacts[0]));
        $this->assertTrue($matchedContacts->contains($this->mockedContacts[1]));
        $this->assertTrue($matchedContacts->contains($this->mockedContacts[2]));

        $this->assertTrue(!$matchedContacts->contains($this->mockedContacts[3]));
        $this->assertTrue(!$matchedContacts->contains($this->mockedContacts[4]));
        $this->assertTrue(!$matchedContacts->contains($this->mockedContacts[5]));
    }

    private function createMockedAgent()
    {
        $this->mockedAgent = factory(Agent::class)->create([
            'zip_code' => '00606'
        ]);
    }

    private function createMockedContacts()
    {
        $this->mockedContacts = [];

        $this->mockedContacts[] = factory(Contact::class)->create([
            'zip_code' => '00601'
        ]);
        $this->mockedContacts[] = factory(Contact::class)->create([
            'zip_code' => '00603'
        ]);
        $this->mockedContacts[] = factory(Contact::class)->create([
            'zip_code' => '00610'
        ]);
        $this->mockedContacts[] = factory(Contact::class)->create([
            'zip_code' => '00987'
        ]);
        $this->mockedContacts[] = factory(Contact::class)->create([
            'zip_code' => '00985'
        ]);
        $this->mockedContacts[] = factory(Contact::class)->create([
            'zip_code' => '00983'
        ]);
    }
}