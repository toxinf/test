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
	 * Привязывает сервис доставки к отправлению и устанавливает отправление в сервисе доставки
	 *
	 * @param Shipment $shipment Отправление
	 * @param DeliveryServiceInterface $deliveryService Сервис доставки
	 */

	public function assignDeliveryServiceToShipment(Shipment $shipment, DeliveryServiceInterface $deliveryService): void
	{
		$deliveryService->setShipment($shipment);
	}
}
