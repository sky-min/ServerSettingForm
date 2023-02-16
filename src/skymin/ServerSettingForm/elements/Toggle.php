<?php

declare(strict_types=1);

namespace skymin\ServerSettingFrom\elements;

final class Toggle implements Element{

	public function __construct(
		private readonly string $text,
		private readonly bool $default = false
	){}

	public function jsonSerialize() : array{
		return [
			'type' => 'toggle',
			'text' => $this->text,
			'default' => $this->default
		];
	}
}