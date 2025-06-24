<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class ShippingRatingOptions
{
    private bool $negotiatedRatesIndicator = false;
    private bool $frsShipmentIndicator = false;
    private bool $rateChartIndicator = false;

    public function exists(): bool
    {
        return $this->negotiatedRatesIndicator || $this->frsShipmentIndicator || $this->rateChartIndicator;
    }

    public function setNegotiatedRatesIndicator(bool $negotiatedRatesIndicator): self
    {
        $this->negotiatedRatesIndicator = $negotiatedRatesIndicator;
        return $this;
    }

    public function getNegotiatedRatesIndicator(): bool
    {
        return $this->negotiatedRatesIndicator;
    }

    public function setFrsShipmentIndicator(bool $frsShipmentIndicator): self
    {
        $this->frsShipmentIndicator = $frsShipmentIndicator;
        return $this;
    }

    public function getFrsShipmentIndicator(): bool
    {
        return $this->frsShipmentIndicator;
    }

    public function setRateChartIndicator(bool $rateChartIndicator): self
    {
        $this->rateChartIndicator = $rateChartIndicator;
        return $this;
    }

    public function getRateChartIndicator(): bool
    {
        return $this->rateChartIndicator;
    }

    public function toArray(): array
    {
        $options = [];

        if ($this->negotiatedRatesIndicator) {
            $options["NegotiatedRatesIndicator"] = "";
        }

        if ($this->frsShipmentIndicator) {
            $options["FRSShipmentIndicator"] = "";
        }

        if (!empty($this->rateChartIndicator)) {
            $options["RateChartIndicator"] = "";
        }

        return $options;
    }
}