<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class ShipmentCharge
{
    private $type = "01";

    private BillShipper $billShipper;

    public function exists()
    {
        return $this->billShipper->exists();
    }

    public function __construct()
    {
        $this->billShipper = new BillShipper();
    }

    public function setBillShipper(BillShipper $billShipper): self
    {
        $this->billShipper = $billShipper;
        return $this;
    }

    public function getBillShipper(): BillShipper
    {
        return $this->billShipper;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function toArray(): array
    {
        $shipmentCharge = [
            "Type" => $this->type
        ];

        if ($this->billShipper->exists()) {
            $shipmentCharge["BillShipper"] = $this->billShipper->toArray();
        }

        return $shipmentCharge;
    }
}
