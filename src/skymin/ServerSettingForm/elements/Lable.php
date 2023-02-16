<?php

declare(strict_types=1);

namespace skymin\ServerSettingFrom\elements;

final class Lable implements Element{

	public function __construct(private readonly string $text){ }

	public function jsonSerialize() : array{
		return [
			'type' => 'lebel',
			'text' => $this->text
		];
	}
}