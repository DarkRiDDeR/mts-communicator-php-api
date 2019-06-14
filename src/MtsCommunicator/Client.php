<?php


namespace MtsCommunicator;

use SoapClient;
use SoapFault;
use MtsCommunicator\Response;

/**
 * Class Client for https://mcommunicator.ru/M2M/m2m_api.asmx
 * @package MtsCommunicator
 */
class Client
{
    /**
     * @var string
     */
    private $login;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $token;
    /**
     * @var string
     */
    protected $wsdlUrl = 'http://www.mcommunicator.ru/m2m/m2m_api.asmx?WSDL';

    /**
     * @var SoapClient
     */
    private $client;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        $soapOptions = ['soap_version' => SOAP_1_2];
        if ($this->token) {
            $soapOptions['stream_context'] = stream_context_create([
                'http' => [
                    'header' => 'Authorization: Bearer ' . $this->token
                ]
            ]);
        }
        $this->client = new SoapClient($this->wsdlUrl, $soapOptions);
    }

    public function request($function, array $params)
    {
        if ($this->login && $this->password)
        {
            $params['login'] = $this->login;
            $params['password'] = md5($this->password);
        }
        $response = new Response();
        try {
            $response->result = $this->client->{$function}($params);
        } catch (SoapFault $e) {
            $response->error = $e->getMessage();
        }
        return $response;
    }

    public static function preparePhone($phone)
    {
        $phone = preg_replace('/\D/', '', $phone);
        if (strlen($phone) === 10)
        {
            return '7' . $phone;
        }
        if (strpos($phone, '8') === 0)
        {
            return '7' . substr($phone, 1);
        }
        return $phone;
    }
}