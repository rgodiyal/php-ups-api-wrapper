<?php

namespace RahulGodiyal\PhpUpsApiWrapper;

use RahulGodiyal\PhpUpsApiWrapper\Entity\VoidShipmentQuery;
use RahulGodiyal\PhpUpsApiWrapper\Utils\HttpClient;

class VoidShipment extends Auth
{
    private const VERSION = "v2409";

    private VoidShipmentQuery $query;
    private string $shipmentIdentificationNumber;
    private object $apiResponse;

    public function __construct()
    {
        $this->query = new VoidShipmentQuery();
    }

    public function setQuery(VoidShipmentQuery $query): self
    {
        $this->query = $query;
        return $this;
    }

    public function getQuery(): VoidShipmentQuery
    {
        return $this->query;
    }

    public function setShipmentIdentificationNumber(string $shipmentIdentificationNumber): self
    {
        $this->shipmentIdentificationNumber = $shipmentIdentificationNumber;
        return $this;
    }

    public function getShipmentIdentificationNumber(): string
    {
        return $this->shipmentIdentificationNumber;
    }

    public function voidShipment(string $client_id, string $client_secret): array
    {
        $auth = $this->authenticate($client_id, $client_secret);

        if ($auth['status'] === 'fail') {
            return $auth;
        }

        $access_token = $auth['access_token'];

        $queryParams = "";
        if ($this->query->exists()) {
            $queryParams = "?" . http_build_query($this->query->toArray());
        }

        $httpClient = new HttpClient();
        $httpClient->setHeader([
            "Authorization: Bearer $access_token",
            "Content-Type: application/json",
            "transId: string",
            "transactionSrc: testing"
        ]);
        $httpClient->setUrl($this->_getAPIBaseURL() . "/api/shipments/" . self::VERSION . "/void/cancel/" . $this->shipmentIdentificationNumber . $queryParams);
        $httpClient->setMethod("DELETE");
        $this->apiResponse = $res = $httpClient->fetch();

        if (!isset($res->VoidShipmentResponse)) {
            if (isset($res->response)) {
                $error = $res->response->errors[0]->message;
            } else {
                $error = "Voiding shipment failed! Please try again.";
            }
            return ['status' => 'fail', 'msg' => $error];
        }

        if (!isset($res->VoidShipmentResponse->Status)) {
            return ['status' => 'fail', 'msg' => "Invalid Request."];
        }

        return ['status' => 'success', 'data' => $res->VoidShipmentResponse];
    }

    public function setMode(string $mode): self
    {
        parent::setMode($mode);
        return $this;
    }

    public function getResponse(): string
    {
        return json_encode($this->apiResponse);
    }
}