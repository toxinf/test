<?php

namespace Delivery\DeliveryService;

/**
 * Интерфейс источника получения данных для доставки
 *
 * @package Delivery\DeliveryService
 */

interface DeliveryServiceDataSourceInterface {
	public function setParams(array $params): bool;
	public function getParams($params): array;
	public function get(): array;
}