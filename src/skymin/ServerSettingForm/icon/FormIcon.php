<?php

declare(strict_types=1);

namespace skymin\ServerSettingFrom\elements;

use JsonSerializable;

final class FormIcon implements JsonSerializable{

	public function __construct(private readonly string $data, private readonly IconType $type = IconType::URL){ }

	public function jsonSerialize() : array{
		return [
			'type' => $this->type->value,
			'data' => $this->data
		];
	}
}