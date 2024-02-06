<?php

namespace Delivery\DeliveryService;

use DateTime;
use Delivery\DeliveryException;
use Delivery\Shipment\Shipment;

/**
 * Класс быстрой доставки
 *
 * @package Delivery\DeliveryService
 */

class DeliveryServiceFast implements DeliveryServiceInterface
{
	private array $deliveryData;
	private Shipment $shipment;
	private DeliveryServiceDataSourceInterface $deliveryServiceDataSource;

	public function __construct(DeliveryServiceDataSourceInterface $deliveryServiceDataSource)
	{
		$this->deliveryServiceDataSource = $deliveryServiceDataSource;
	}

	public function setShipment(Shipment $shipment): void
	{
		$this->shipment = $shipment;
	}

	/**
	 * @throws \Delivery\DeliveryException
	 */
	public function get(): DeliveryServiceInterface
	{
		$this->setDataSourceParams();
		$this->deliveryData = $this->deliveryServiceDataSource->get();
		return $this;
	}

	/**
	 * @throws \Delivery\DeliveryException
	 */
	private function setDataSourceParams(): void
	{
		if (!empty($this->shipment)) {
			$this->deliveryServiceDataSource->setParams([
				'sourceKladr' => $this->shipment->getSourceKladr(),
				'targetKladr' => $this->shipment->getTargetKladr(),
				'weight' => $this->shipment->getWeight(),
			]);
		} else {
			throw new DeliveryException('Нет данных доставки');
		}
	}

	/**
	 * @throws \Delivery\DeliveryException
	 */
	public function getDeliveryInfo(): string
	{
		if (empty($this->deliveryData)) {
			$this->get();
		}
		$data = [
			'price' => $this->deliveryData['price'],
			'date' => $this->getDeliveryDate(),
			'error' => $this->deliveryData['error'],
		];
		return json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	private function getDeliveryDate(): string
	{
		$incDays = $this->deliveryData['period'];

		// Получаем текущую дату и время
		$currentDateTime = new DateTime('now');

		// Проверяем текущее время
		$currentHour = (int) $currentDateTime->format('H'); // Получаем текущий час

		// Если текущее время после 18:00, добавляем 1 день
		if ($currentHour >= 18) {
			$incDays += 1;
		}

		// Добавляем n дней к текущей дате
		$currentDateTime->modify("+$incDays days");

		// Форматируем результат в требуемый формат
		return $currentDateTime->format('Y-m-d');
	}
}