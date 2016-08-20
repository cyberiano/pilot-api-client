<?php
/**
 * Class PilotApiClientTest
 *
 * @author Mauro Moreno <moreno.mauro.emanuel@gmail.com>
 */
namespace Zephia\PilotApiClient\Tests\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Subscriber\Mock;
use Zephia\PilotApiClient\Client\PilotApiClient;
use Zephia\PilotApiClient\Exception\InvalidArgumentException;
use Zephia\PilotApiClient\Exception\LogicException;
use Zephia\PilotApiClient\Model\LeadData;

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
     * @expectedException InvalidArgumentException
     */
    public function testStoreLeadAppKeyIsEmpty()
    {
        $client = new PilotApiClient([
            'debug' => true
        ]);
        $mock = new Mock([new Response(200, [], Stream::factory('{"success":false,"message":"Error","data":"No se indico el parametro requerido appKey"}'))]);
        $client->getGuzzleClient()->getEmitter()->attach($mock);
        $client->storeLead(new LeadData([
            'firstname' => 'Test',
            'lastname' => 'Test',
            'contact_type_id' => 1,
            'business_type_id' => 1,
            'suborigin_id' => "FFFF0000",
        ]));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testStoreLeadAppKeyIsWrong()
    {
        $client = new PilotApiClient([
            'debug' => true,
            'app_key' => 'APP-WRONG-KEY'
        ]);
        $mock = new Mock([new Response(200, [], Stream::factory('{"success":false,"message":"Error","data":"No se encontro la key APP-WRONG-KEY"}'))]);
        $client->getGuzzleClient()->getEmitter()->attach($mock);
        $client->storeLead(new LeadData([
            'firstname' => 'Test',
            'lastname' => 'Test',
            'contact_type_id' => 1,
            'business_type_id' => 1,
            'suborigin_id' => "FFFF0000",
        ]));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testStoreLeadWrongSuboriginId()
    {
        $client = new PilotApiClient([
            'debug' => true,
            'app_key' => 'APP-KEY'
        ]);
        $mock = new Mock([new Response(200, [], Stream::factory('{"success":false,"message":"Error","data":"(3.0) El codigo de origen del dato FFFF0000no existe."}'))]);
        $client->getGuzzleClient()->getEmitter()->attach($mock);
        $client->storeLead(new LeadData([
            'firstname' => 'Test',
            'phone' => '123456',
            'contact_type_id' => 1,
            'business_type_id' => 1,
            'suborigin_id' => "WRONG-SUB-ORIGIN-ID",
        ]));
    }

    /**
     * @expectedException \Exception
     */
    public function testStoreLeadServerError()
    {
        $client = new PilotApiClient([
            'debug' => true,
            'app_key' => 'APP-KEY'
        ]);
        $mock = new Mock([new Response(500, [], Stream::factory('Internal Server Error'))]);
        $client->getGuzzleClient()->getEmitter()->attach($mock);
        $client->storeLead(new LeadData([
            'firstname' => 'Test',
            'phone' => '123456',
            'contact_type_id' => 1,
            'business_type_id' => 1,
            'suborigin_id' => "FFFF0000",
        ]));
    }

    public function testStoreLeadDebugOk()
    {
        $client = new PilotApiClient([
            'debug' => true,
            'app_key' => 'APP-KEY'
        ]);
        $mock = new Mock([new Response(200, [], Stream::factory('{"success":true,"message":"Success","data":{"message":"(3.0) El servicio de carga de datos se ejecuto correctamente en modo DEBUG.","success":true}}'))]);
        $client->getGuzzleClient()->getEmitter()->attach($mock);
        $response = $client->storeLead(new LeadData([
            'firstname' => 'Test',
            'phone' => '123456',
            'contact_type_id' => 1,
            'business_type_id' => 1,
            'suborigin_id' => "FFFF0000",
        ]));
        $this->assertTrue($response->success);
        $this->assertEquals('Success', $response->message);
        $this->assertEquals('(3.0) El servicio de carga de datos se ejecuto correctamente en modo DEBUG.', $response->data->message);
    }

    public function testStoreLeadOk()
    {
        $client = new PilotApiClient([
            'debug' => false,
            'app_key' => 'APP-KEY'
        ]);
        $mock = new Mock([new Response(200, [], Stream::factory('{"success":true,"message":"Success","data":{"message":"(3.2) El servicio de carga de datos se ejecuto correctamente.","assigned_user_id":1234,"success":true,"id":1}}'))]);
        $client->getGuzzleClient()->getEmitter()->attach($mock);
        $response = $client->storeLead(new LeadData([
            'firstname' => 'Test',
            'phone' => '123456',
            'contact_type_id' => 1,
            'business_type_id' => 1,
            'suborigin_id' => "FFFF0000",
        ]));
        $this->assertTrue($response->success);
        $this->assertEquals('Success', $response->message);
        $this->assertEquals('(3.2) El servicio de carga de datos se ejecuto correctamente.', $response->data->message);
        $this->assertEquals(1234, $response->data->assigned_user_id);
        $this->assertEquals(1, $response->data->id);
    }

    /**
     * @expectedException LogicException
     */
    public function testSetAppKeyEmpty()
    {
        $client = new PilotApiClient();
        $client->getAppKey();
    }

    public function testSetAppKeyOk()
    {
        $client = new PilotApiClient([
            'app_key' => 'APP-KEY'
        ]);

        $this->assertEquals($client, $client->setAppKey('NEW-APP-KEY'));
        $this->assertEquals('NEW-APP-KEY', $client->getAppKey());
    }
}