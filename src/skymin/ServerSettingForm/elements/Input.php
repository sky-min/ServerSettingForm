<?php

declare(strict_types=1);

namespace skymin\ServerSettingForm\elements;

final class Input implements Element{

	public function __construct(
		private readonly string $text,
		private readonly string $hint = '',
		private readonly string $default = ''
	){}

	public function jsonSerialize() : array{
		return [
			'type' => 'input',
			'text' => $this->text,
			'placeholder' => $this->hint,
			'default' => $this->default
		];
	}
}