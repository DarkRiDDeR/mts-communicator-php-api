<?php

namespace MtsCommunicator;

class Send
{
    private $client;
    public $naming;

    public function __construct( Client $client, $naming = null )
    {
        $this->client = $client;
        $this->naming = $naming;
    }

    protected function addParamMsids ( array &$params, $phones )
    {
        $params['msids'] = [];
        foreach ($phones as $phone)
        {
            $params['msids'][] = Client::preparePhone($phone);
        }
    }

    protected function addParamMsidsAndMessages ( array &$params, array $phonesAndMessages )
    {
        $params['msidsAndMessages'] = [];
        foreach ($phonesAndMessages as $arItem)
        {
            $params['msidsAndMessages'][] = [
                'Msid' => Client::preparePhone($arItem[0]),
                'Message' => $arItem[1]
            ];
        }
    }

    protected function addParamNaming (&$params, $naming)
    {
        if (!empty($naming) || !empty($naming = $this->naming))
        {
            $params['naming'] = $naming;
        }
    }

    /**
     * @param $message
     * @param $phone
     * @param null $naming
     * @return Response
     */
    public function message ($message, $phone, $naming = null)
    {
        $params['message'] = $message;
        $params['msid'] = Client::preparePhone($phone);
        $this->addParamNaming($params, $naming);
        return $this->client->request('SendMessages', $params);
    }

    /**
     * @param $sendMessageResult
     * @return Response
     */
    public function messageResponse ( $sendMessageResult )
    {
        $params['SendMessageResult'] = $sendMessageResult   ;
        return $this->client->request('SendMessageResponse', $params);
    }


    public function messageAtDate ( $message, $phone, $scheduledSendDate, $naming = null )
    {
        $params['message'] = $message;
        $params['scheduledSendDate'] = $scheduledSendDate;
        $params['msid'] = Client::preparePhone($phone);
        $this->addParamNaming($params, $naming);
        return $this->client->request('SendMessageAtDate    ', $params);
    }

    /**
     * @param int $sendMessageAtDateResult
     * @return Response
     */
    public function messageAtDateResponse ( $sendMessageAtDateResult )
    {
        $params['SendMessageAtDateResult'] = $sendMessageAtDateResult;
        return $this->client->request('SendMessageAtDateResponse', $params);
    }

    public function messageToMultipleSubscribers ($message, array $phones, $naming = null)
    {
        $params['message'] = $message;
        $this->addParamMsids($params, $phones);
        $this->addParamNaming($params, $naming);
        return $this->client->request('SendMessageToMultipleSubscribers', $params);
    }

    /**
     * @param array $sendMessageToMultipleSubscribersResult
     * @return Response
     */
    public function messageToMultipleSubscribersResponse ( array $sendMessageToMultipleSubscribersResult )
    {
        $params['SendMessageToMultipleSubscribersResult'] = $sendMessageToMultipleSubscribersResult;
        return $this->client->request('SendMessageToMultipleSubscribersResponse', $params);
    }

    public function messageToMultipleSubscribersAtDate ( $message, array $phones, $scheduledSendDate, $naming = null )
    {
        $params['message'] = $message;
        $params['scheduledSendDate'] = $scheduledSendDate;
        $this->addParamMsids($params, $phones);
        $this->addParamNaming($params, $naming);
        return $this->client->request('SendMessageToMultipleSubscribersAtDate', $params);
    }

    /**
     * @param array $sendMessageToMultipleSubscribersAtDateResult
     * @return Response
     */
    public function messageToMultipleSubscribersAtDateResponse ( array $sendMessageToMultipleSubscribersAtDateResult )
    {
        $params['SendMessageToMultipleSubscribersAtDateResult'] = $sendMessageToMultipleSubscribersAtDateResult;
        return $this->client->request('SendMessageToMultipleSubscribersAtDateResponse', $params);
    }

    public function messageWithValidityPeriod ( $message, $phone, $validityPeriod, $naming = null )
    {
        $params['message'] = $message;
        $params['validityPeriod'] = $validityPeriod;
        $params['msid'] = Client::preparePhone($phone);
        $this->addParamNaming($params, $naming);
        return $this->client->request('SendMessageWithValidityPeriod', $params);
    }

    /**
     * @param int $sendMessageWithValidityPeriodResult
     * @return Response
     */
    public function messageWithValidityPeriodResponse ( $sendMessageWithValidityPeriodResult )
    {
        $params['SendMessageWithValidityPeriodResult'] = $sendMessageWithValidityPeriodResult;
        return $this->client->request('SendMessageWithValidityPeriodResponse', $params);
    }

    public function messages ( $message, array $phones, $naming = null )
    {
        $params['message'] = $message;
        $this->addParamMsids($params, $phones);
        $this->addParamNaming($params, $naming);
        return $this->client->request('SendMessages', $params);
    }

    /**
     * @param array $sendMessagesResult
     * @return Response
     */
    public function messagesResponse ( array $sendMessagesResult )
    {
        $params['SendMessageToMultipleSubscribersAtDateResult'] = $sendMessagesResult;
        return $this->client->request('SendMessagesResponse', $params);
    }

    public function messagesAtDate ( $message, array $phones, $scheduledSendDate, $naming = null )
    {
        $params['message'] = $message;
        $params['scheduledSendDate'] = $scheduledSendDate;
        $this->addParamMsids($params, $phones);
        $this->addParamNaming($params, $naming);
        return $this->client->request('SendMessagesAtDate   ', $params);
    }

    /**
     * @param array $sendMessagesAtDateResult
     * @return Response
     */
    public function messagesAtDateResponse ( array $sendMessagesAtDateResult )
    {
        $params['SendMessagesAtDateResult'] = $sendMessagesAtDateResult;
        return $this->client->request('SendMessagesAtDateResponse', $params);
    }

    public function messagesAtDateWithValidityPeriod ( $message, array $phones, $scheduledSendDate, $validityPeriod, $naming = null )
    {
        $params['message'] = $message;
        $params['scheduledSendDate'] = $scheduledSendDate;
        $params['validityPeriod'] = $validityPeriod;
        $this->addParamMsids($params, $phones);
        $this->addParamNaming($params, $naming);
        return $this->client->request('SendMessages', $params);
    }

    /**
     * @param array $sendMessagesAtDateWithValidityPeriodResult
     * @return Response
     */
    public function messagesAtDateWithValidityPeriodResponse ( array $sendMessagesAtDateWithValidityPeriodResult )
    {
        $params['SendMessagesAtDateWithValidityPeriodResult'] = $sendMessagesAtDateWithValidityPeriodResult;
        return $this->client->request('SendMessagesAtDateWithValidityPeriodResponse', $params);
    }

    /**
     * @param array $phonesAndMessages. Example: [["71236548795", "message 1"], ["79635874522", "message 2"]]
     * @param $scheduledSendDate
     * @param $validityPeriod
     * @param null $naming
     * @return Response
     */
    public function variousMessages ( array $phonesAndMessages, $scheduledSendDate, $validityPeriod, $naming = null )
    {
        $this->addParamMsidsAndMessages($params, $phonesAndMessages);
        $params['scheduledSendDate'] = $scheduledSendDate;
        $params['validityPeriod'] = $validityPeriod;
        $this->addParamNaming($params, $naming);
        return $this->client->request('SendVariousMessages', $params);
    }

    /**
     * @param array $sendVariousMessagesResult
     * @return Response
     */
    public function variousMessagesResponse ( array $sendVariousMessagesResult )
    {
        $params['SendVariousMessagesResult'] = $sendVariousMessagesResult;
        return $this->client->request('SendVariousMessagesResponse', $params);
    }

    public function messagesWithValidityPeriod ( $message, array $phones, $validityPeriod, $naming = null )
    {
        $params['message'] = $message;
        $params['validityPeriod'] = $validityPeriod;
        $this->addParamMsids($params, $phones);
        $this->addParamNaming($params, $naming);
        return $this->client->request('SendMessagesWithValidityPeriod', $params);
    }

    /**
     * @param array $sendMessagesWithValidityPeriodResult
     * @return Response
     */
    public function messagesWithValidityPeriodResponse ( array $sendMessagesWithValidityPeriodResult )
    {
        $params['SendMessagesWithValidityPeriodResult'] = $sendMessagesWithValidityPeriodResult;
        return $this->client->request('SendMessagesWithValidityPeriodResponse', $params);
    }

    /**
     * @param array $phonesAndMessages
     * @param $scheduledSendDate
     * @param $validityPeriod
     * @param bool $useViberOnly
     * @param null $naming
     * @return Response
     */
    public function viberMessages ( array $phonesAndMessages, $scheduledSendDate, $validityPeriod, $useViberOnly, $naming = null )
    {
        $this->addParamMsidsAndMessages($params, $phonesAndMessages);
        $params['scheduledSendDate'] = $scheduledSendDate;
        $params['validityPeriod'] = $validityPeriod;
        $params['useViberOnly'] = $useViberOnly;
        $this->addParamNaming($params, $naming);
        return $this->client->request('SendViberMessages', $params);
    }

    /**
     * @param array $sendViberMessagesResult
     * @return Response
     */
    public function viberMessagesResponse ( array $sendViberMessagesResult )
    {
        $params['SendViberMessagesResult'] = $sendViberMessagesResult;
        return $this->client->request('SendViberMessagesResponse', $params);
    }

    public function viberMessagesWithFallback ( array $phonesAndMessages, $scheduledSendDate, $validityPeriod, $useViberOnly, $naming = null )
    {
        $params['msidsAndMessages'] = [];
        foreach ($phonesAndMessages as $arItem)
        {
            $params['msidsAndMessages'][] = [
                'Msid' => Client::preparePhone($arItem[0]),
                'Message' => $arItem[1],
                'FallbackMessage' => $arItem[2]
            ];
        }
        $params['scheduledSendDate'] = $scheduledSendDate;
        $params['validityPeriod'] = $validityPeriod;
        $params['useViberOnly'] = $useViberOnly;
        $this->addParamNaming($params, $naming);
        return $this->client->request('SendViberMessagesWithFallback', $params);
    }

    /**
     * @param array $sendViberMessagesWithFallbackResult
     * @return Response
     */
    public function viberMessagesWithFallbackResponse ( array $sendViberMessagesWithFallbackResult )
    {
        $params['SendViberMessagesWithFallbackResult'] = $sendViberMessagesWithFallbackResult;
        return $this->client->request('SendViberMessagesWithFallbackResponse', $params);
    }
}