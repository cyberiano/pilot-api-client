<?php
/**
 * Class PilotApiClient
 *
 * @author Cristian Jimenez <cristian@zephia.com.ar>
 */

namespace Zephia\PilotApiClient\Client;

use GuzzleHttp\Client as GuzzleClient;
use Zephia\PilotApiClient\Exception\InvalidArgumentException;
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

        $this->appKey = $config['app_key'];
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
        if (empty($lead_data)) {
            throw new InvalidArgumentException("Lead Data is empty.");
        }

        $form_params = [
            'debug' => $this->debug,
            'action' => 'create',
            'appkey' => $this->appKey,
        ];

        $form_params = array_merge($form_params, $lead_data->toArray());

        if (!empty($notification_email)) {
            $form_params['notification_email'] = $notification_email;
        }

        $response = $this->guzzleClient->post(self::BASE_URI, [
            'body' => $form_params
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new InvalidArgumentException(
                $response->getBody()->getContents()
            );
        } else {
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
}
