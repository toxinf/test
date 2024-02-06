<?php

namespace Delivery\DeliveryService;

use Delivery\Shipment\Shipment;

/**
 * Интерфейс сервиса доставки
 *
 * @package Delivery\DeliveryService
 */

interface DeliveryServiceInterface
{
	public function setShipment(Shipment $shipment): void;
	public function get(): DeliveryServiceInterface;
	public function getDeliveryInfo(): string;
}