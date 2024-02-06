<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once __DIR__ . '/../src/DeliveryService/DeliveryServiceInterface.php';
require_once __DIR__ . '/../src/DeliveryService/DeliveryServiceDataSourceInterface.php';
require_once __DIR__ . '/../src/Shipment/Shipment.php';
require_once __DIR__ . '/../src/DeliveryService/DeliveryServiceFast.php';
require_once __DIR__ . '/../src/DeliveryService/DeliveryServiceSlow.php';
require_once __DIR__ . '/../src/DeliveryService/DeliveryServiceFastEmulate.php';
require_once __DIR__ . '/../src/DeliveryService/DeliveryServiceSlowEmulate.php';

use Delivery\DeliveryService\DeliveryServiceFast;
use Delivery\DeliveryService\DeliveryServiceFastEmulate;
use Delivery\DeliveryService\DeliveryServiceSlow;
use Delivery\DeliveryService\DeliveryServiceSlowEmulate;
use Delivery\Management\DeliveryManager;
use Delivery\Shipment\Shipment;

// создаем объект доставки
$shipment = new Shipment();
// устанавливаем данные
$shipment->setSourceKladr('adr1');
$shipment->setTargetKladr('adr2');
$shipment->setWeight(1.1);

// расчёт быстрой доставки
$fastService = new DeliveryServiceFast(new DeliveryServiceFastEmulate('https://example.com'));
$deliveryManager = new DeliveryManager();
$deliveryManager->assignShipmentToService($shipment, $fastService);
echo $fastService->getDeliveryInfo() . '<br>';

// расчёт медленной доставки
$slowService = new DeliveryServiceSlow(new DeliveryServiceSlowEmulate('https://example.com'));
$deliveryManager->assignShipmentToService($shipment, $slowService);
echo $slowService->getDeliveryInfo() . '<br>';
