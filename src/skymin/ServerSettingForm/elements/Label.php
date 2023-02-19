<?php

declare(strict_types=1);

namespace skymin\ServerSettingForm\elements;

final class Label implements Element{

	public function __construct(private readonly string $text){ }

	public function jsonSerialize() : array{
		return [
			'type' => 'label',
			'text' => $this->text
		];
	}
}