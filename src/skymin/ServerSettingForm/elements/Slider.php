<?php

declare(strict_types=1);

namespace skymin\ServerSettingFrom\elements;

final class Slider implements Element{

	private float $default;

	public function __construct(
		private readonly string $text,
		private readonly float $min,
		private readonly float $max,
		private readonly float $step = 1.0,
		float $default = null
	){
		if($default === null){
			$default = $this->min;
		}
		$this->default = $default;
	}

	public function jsonSerialize() : array{
		return [
			'type' => 'slider',
			'text' => $this->text,
			'min' => $this->min,
			'max' => $this->max,
			'default' => $this->default,
			'step' => $this->step
		];
	}
}