<?php

namespace Delivery\DeliveryService;

/**
 * Класс для эмуляции получения данных от сервиса медленной доставки
 *
 * @package Delivery\DeliveryService
 */

class DeliveryServiceSlowEmulate implements DeliveryServiceDataSourceInterface
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
		$days = mt_rand(2, 40);
		return [
			'coefficient' => (float) mt_rand(1, 10) + (mt_rand(1, 99) / 100),
			'date' => date('Y-m-d', strtotime("+$days days")),
			'error' => rand(1, 4) === 1 ? 'Какая-то ошибка' : '',
		];
	}
}