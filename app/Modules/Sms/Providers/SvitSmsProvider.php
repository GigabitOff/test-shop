<?php

namespace App\Modules\Sms\Providers;

use GuzzleHttp\Client;

class SvitSmsProvider extends AbstractProvider
{
    protected $endpoint = 'http://svitsms.com/api/api.php';

    public function __construct($config)
    {
        $this->client = new Client(['base_uri' => $this->endpoint, 'verify' => false]);

        parent::__construct($config);
    }

    protected function createHeaders()
    {
        $code = base64_encode("{$this->user}:{$this->password}");

        return [
            'Accept' => 'text/xml',
            'Content-Type' => 'text/xml; charset=UTF-8',
            'Authorization' => "Basic {$code}",
        ];
    }

    protected function createXml($to, $message, $description)
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= '<request>';
        $xml .= '<operation>SENDSMS</operation>';
        $xml .= ' <message start_time="AUTO" end_time="AUTO" lifetime="24" rate="1"
desc="' . $description . '" source="' . $this->alfa . '">';
        $xml .= " <body>$message</body>";
        $xml .= " <recipient>$to</recipient>";
        $xml .= '</message>';
        $xml .= '</request>';

        return $xml;
    }

    protected function createBalanceXml()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= '<request>';
        $xml .= '<operation>GETBALANCE</operation>';
        $xml .= '</request>';

        return $xml;
    }

    public function sendMessage($to, $message, $description = '')
    {
        $xml = $this->createXml($to, $message, $description);

        try {
            $response = $this->client->post('', [
                'headers' => $this->createHeaders(),
                'body' => $xml,
            ]);

            $content = $response->getBody()->getContents();
            $node_xml = new \SimpleXMLElement($content);
            $status = (string)$node_xml->state['code'];
            $text = (string)$node_xml->state;

            if ('ACCEPT' === $status) {
                return $text;
            } else if ('INSUFFICIENTFUNDS' === $status) {
                // todo: Send event to notify
                logger('SvitSmsResponseError: No money');
            } else {
                logger('SvitSmsResponseError: ' . $content, func_get_args());
            }
        } catch (\Exception $e) {
            logger('SvitSmsError' . $e->getMessage(), $e->getTrace());
            return false;
        }

        return false;
    }

    public function getBalance()
    {
        $xml = $this->createBalanceXml();

        try {
            $response = $this->client->post('', [
                'headers' => $this->createHeaders(),
                'body' => $xml,
            ]);

            $content = $response->getBody()->getContents();
            $node_xml = new \SimpleXMLElement($content);
            $status = (string)$node_xml->state['code'];
            $balance = (string)$node_xml->balance;


            if (!$status) {
                return $balance;
            } else if ('INSUFFICIENTFUNDS' === $status) {
                // todo: Send event to notify
                logger('SvitSmsResponseError: No money');
            } else {
                logger('SvitSmsResponseError: ' . $content, func_get_args());
            }
        } catch (\Exception $e) {
            logger('SvitSmsError' . $e->getMessage(), $e->getTrace());
            return false;
        }

        return false;
    }
}
