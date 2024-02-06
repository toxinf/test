<?php

namespace Delivery\Shipment;

/**
 * Класс доставки
 *
 * @package Delivery\Shipment
 */

class Shipment {
	private string $sourceKladr;
	private string $targetKladr;
	private string $weight;

	public function setSourceKladr(string $sourceKladr): void
	{
		$this->sourceKladr = $sourceKladr;
	}

	public function setTargetKladr(string $targetKladr): void
	{
		$this->targetKladr = $targetKladr;
	}

	public function setWeight(float $weight): void
	{
		$this->weight = $weight;
	}

	public function getSourceKladr(): string
	{
		return $this->sourceKladr;
	}

	public function getTargetKladr(): string
	{
		return $this->targetKladr;
	}

	public function getWeight(): float
	{
		return $this->weight;
	}
}