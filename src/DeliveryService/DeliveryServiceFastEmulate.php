<?php

namespace Delivery\DeliveryService;

/**
 * Класс для эмуляции получения данных от сервиса быстрой доставки
 *
 * @package Delivery\DeliveryService
 */

class DeliveryServiceFastEmulate implements DeliveryServiceDataSourceInterface
{
	private string $baseUrl;
	private array $params;

	public function __construct(string $baseUrl)
	{
		$this->baseUrl = $baseUrl;
	}

	public function setParams(array $params): bool
	{
		$this->params = $params;
		return true;
	}

	public function getParams($params): array
	{
		return $params;
	}

	public function get(): array
	{
		return [
			'price' => (float) mt_rand(500, 5000) + (mt_rand(1, 99) / 100),
			'period' => mt_rand(2, 40),
			'error' => rand(1, 4) === 1 ? 'Какая-то ошибка' : '',
		];
	}
}