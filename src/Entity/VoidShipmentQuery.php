<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class VoidShipmentQuery
{
    private string $trackingNumber = "";

    public function exists()
    {
        if (!empty($this->trackingNumber)) {
            return true;
        }

        return false;
    }

    public function setTrackingNumber(string $trackingNumber): self
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    public function toArray(): array
    {
        if ($this->trackingNumber) {
            return [
                "trackingnumber" => $this->trackingNumber
            ];
        }

        return [];
    }
}