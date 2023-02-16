<?php

declare(strict_types=1);

namespace skymin\ServerSettingFrom\elements;

final class StepSlider implements Element{

	/** @param string[] $options */
	public function __construct(
		private readonly string $text,
		private readonly array $options,
		private readonly int $defaultIndex
	){}

	public function jsonSerialize() : array{
		return [
			'type' => 'step_slider',
			'text' => $this->text,
			'steps' => $this->options,
			'default' => $this->defaultIndex
		];
	}
}