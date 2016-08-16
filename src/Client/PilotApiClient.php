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
    private $notification_email;
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

        $config = array_merge($config, $defaults);

        $this->appKey = $config['app_key'];
        $this->debug = $config['debug'];

        $this->guzzleClient = new GuzzleClient();
    }

    /**
     * Store lead
     *
     * @param array $lead_data Lead data array.
     * See documentation at http://www.pilotsolution.com.ar/home/api.php (Array keys without 'pilot_' prefix)
     * Example:
     * $lead_data = ['firstname' => 'John', 'lastname' = 'Doe', 'phone' => '+543512345678', 'email' => 'john.doe@domain.com'];
     *
     * @param int $business_type_id Código numérico del tipo negocio del dato (1: 0km, 2: Usados, 3: Plan de Ahorro)
     * @param int $contact_type_id Código numérico del tipo de contacto del dato (1: Electrónico, 2: Telefónico , 3: Entrevista)
     * @return string Pilot API response
     */
    public function storeLead(LeadData $lead_data, $notification_email = '')
    {
        if (empty($lead_data)) {
            throw new InvalidArgumentException("Lead Data is empty.");
        }

        /*$pilot_lead_data = [];

        foreach ($lead_data as $key => $value) {
            $pilot_lead_data['pilot_' . $key] = $value;
        }*/

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

        if ($response->getStatusCode() != 200) {
            throw new \InvalidArgumentException(
                $response->getBody()->getContents()
            );
        } else {
            return $response->getBody()->getContents();
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
