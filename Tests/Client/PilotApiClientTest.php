<?php
/**
 * Class PilotApiClientTest
 *
 * @author Mauro Moreno <moreno.mauro.emanuel@gmail.com>
 */
namespace Zephia\PilotApiClient\Tests\Client;

use Zephia\PilotApiClient\Client\PilotApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;
use Zephia\PilotApiClient\Exception\InvalidArgumentException;
use Zephia\PilotApiClient\Model\LeadData;

/**
 * Class NominatimClientTest
 * @package MauroMoreno\Client\Tests\Client
 */
class PilotApiClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test valid client
     */
    public function testValidClient()
    {
        $client = new PilotApiClient();
        $this->assertInstanceOf(Client::class, $client->getGuzzleClient());
    }

    /**
     * @expectedException        InvalidArgumentException
     */
    public function testLeadDataIsEmpty()
    {
        $client = new PilotApiClient();
        $client->storeLead(new LeadData());
    }

    /**
     * Test storeLead, ok
     */
    public function testStoreLeadOk()
    {
        $client = new PilotApiClient();
        //$mock = new Mock([new Response(200)]);
        $client->getGuzzleClient();
        $response = $client->storeLead(new LeadData([
            'firstname' => 'Test',
            'contact_type_id' => 1,
            'business_type_id' => 1,
            'suborigin_id' => "FFFF0000",
        ]));
    }
}