<?php

use RahulGodiyal\PhpUpsApiWrapper\Entity\VoidShipmentQuery;
use RahulGodiyal\PhpUpsApiWrapper\VoidShipment;

require_once('./vendor/autoload.php');

$client_id = "xxxxxxxxxxxxxxxx"; // UPS Client ID
$client_secret = "xxxxxxxxxxxxxxx"; // UPS Client Secret

// Shipment identification number to void
$shipmentIdentificationNumber = "1Zxxxxxxxxxxxxxxxx"; // Replace with actual shipment ID

/********* Void Shipment Query *********/
$query = new VoidShipmentQuery(); // optional
$query->setTrackingNumber(""); // optional
/********* End Void Shipment Query *********/

/************ Void Shipment **********/
$voidShipment = new VoidShipment();
$voidShipmentRes = $voidShipment
    ->setQuery($query) // optional
    ->setShipmentIdentificationNumber($shipmentIdentificationNumber)
//     ->setMode('PROD') // optional - uncomment for production
    ->voidShipment($client_id, $client_secret);
/************ End Void Shipment **********/

echo '<pre>'; print_r($voidShipmentRes); echo '</pre>';
