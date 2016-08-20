<?php
/**
 * Class PilotApiClient
 *
 * @author Cristian Jimenez <cristian@zephia.com.ar>
 * @author Mauro Moreno     <moreno.mauro.emanuel@gmail.com>
 */

namespace Zephia\PilotApiClient\Client;

use GuzzleHttp\Client as GuzzleClient;
use Zephia\PilotApiClient\Exception\InvalidArgumentException;
use Zephia\PilotApiClient\Exception\LogicException;
use Zephia\PilotApiClient\Model\LeadData;

class PilotApiClient
{
    /**
     * Pilot API URI
     */
    const BASE_URI = 'http://www.pilotsolution.com.ar/api/webhooks/welcome.php';

    private $appKey;
    private $debug;
    private $guzzleClient;

    /**
     * PilotApi constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $defaults = [
            'debug' => false,
            'app_key' => null,
        ];

        $config = array_merge($defaults, $config);

        if (!empty($config['app_key'])) {
            $this->setAppKey($config['app_key']);
        }
        $this->debug = $config['debug'];

        $this->guzzleClient = new GuzzleClient();
    }

    /**
     * Stores a lead
     *
     * @param LeadData $lead_data
     * @param string $notification_email
     *
     * @throws InvalidArgumentException
     *
     * @return mixed
     */
    public function storeLead(LeadData $lead_data, $notification_email = '')
    {
        $form_params = [
            'debug' => $this->debug,
            'action' => 'create',
            'appkey' => $this->getAppKey(),
        ];

        $form_params = array_merge($form_params, $lead_data->toArray());

        if (!empty($notification_email)) {
            $form_params['notification_email'] = $notification_email;
        }

        $response = $this->guzzleClient->post(self::BASE_URI, [
            'body' => $form_params
        ]);

        if ($response->getStatusCode() === 200) {
            $content = json_decode($response->getBody()->getContents());
            if ($content->success === false) {
                throw new InvalidArgumentException($content->data);
            }
            return $content;
        }
    }

    /**
     * @return GuzzleClient
     */
    public function getGuzzleClient()
    {
        return $this->guzzleClient;
    }

    /**
     * @param $app_key
     *
     * @return $this
     */
    public function setAppKey($app_key)
    {
        $this->appKey = $app_key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAppKey()
    {
        if (empty($this->appKey)) {
            throw new LogicException('App Key is undefined.');
        }
        return $this->appKey;
    }
}
