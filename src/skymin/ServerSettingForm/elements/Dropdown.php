<?php

declare(strict_types=1);

namespace skymin\ServerSettingForm\elements;

final class dropdown implements Element{

	/**
	 * @param string[] $options
	 */
	public function __construct(
		private readonly string $text,
		private readonly array $options,
		private readonly int $defaultIndex = 0
	){}

	public function jsonSerialize() : array{
		return [
			'type' => 'dropdown',
			'text' => $this->text,
			'options' => $this->options,
			'default' => $this->defaultIndex
		];
	}
}