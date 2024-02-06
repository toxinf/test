<?php

namespace Delivery\DeliveryService;

use Delivery\Shipment\Shipment;

/**
 * Класс медленной доставки
 *
 * @package Delivery\DeliveryService
 */

class DeliveryServiceSlow implements DeliveryServiceInterface
{
	private array $deliveryData;
	private float $baseCost = 150;
	private Shipment $shipment;
	private DeliveryServiceDataSourceInterface $deliveryServiceDataSource;

	public function __construct(DeliveryServiceDataSourceInterface $deliveryServiceDataSource)
	{
		$this->deliveryServiceDataSource = $deliveryServiceDataSource;
	}

	public function setBaseCost(float $baseCost)
	{
		$this->baseCost = $baseCost;
	}

	public function setShipment(Shipment $shipment): void
	{
		$this->shipment = $shipment;
	}

	public function get(): DeliveryServiceInterface
	{
		$this->deliveryServiceDataSource->setParams([
			'sourceKladr' => $this->shipment->getSourceKladr(),
			'targetKladr' => $this->shipment->getTargetKladr(),
			'weight' => $this->shipment->getWeight(),
		]);
		$this->deliveryData = $this->deliveryServiceDataSource->get();
		return $this;
	}

	public function getDeliveryInfo(): string
	{
		if (empty($this->deliveryData)) {
			$this->get();
		}
		$data = [
			'price' => $this->getDeliveryCost(),
			'date' => $this->deliveryData['date'],
			'error' => $this->deliveryData['error'],
		];
		return json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	private function getDeliveryCost(): string
	{
		return $this->baseCost * $this->deliveryData['coefficient'];
	}
}