<?php
/**
 * Class PilotApiClientTest
 *
 * @author Cristian Jimenez <cristian@zephia.com.ar>
 */
namespace Zephia\PilotApiClient\Client\Tests\Client;
use Zephia\PilotApiClient\Client\PilotApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
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
     * Test storeLead, ok
     */
    public function testStoreLeadOk()
    {
        $client = new PilotApiClient();
        $mock = new MockHandler(
            [
                new Response(200, [], Psr7\stream_for('ABC')),
            ]
        );
        $client->getGuzzleClient()->getConfig('handler')->setHandler($mock);
        $response = $client->reverse(0.01, 0.01);
        $this->assertEquals('ABC', $response->getBody()->getContents());
    }
}