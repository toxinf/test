<?php

namespace Delivery\Management;

use Delivery\Shipment\Shipment;
use Delivery\DeliveryService\DeliveryServiceInterface;

/**
 * Класс управления доставкой
 *
 * @package Delivery\Management
 */

class DeliveryManager {

	/**
	 * Привязывает отправление к сервису доставки
	 *
	 * @param Shipment $shipment Отправление
	 * @param DeliveryServiceInterface $deliveryService Сервис доставки
	 */

	public function assignShipmentToService(Shipment $shipment, DeliveryServiceInterface $deliveryService): void
	{
		$deliveryService->setShipment($shipment);
	}
}
