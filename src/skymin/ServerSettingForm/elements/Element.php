<?php

declare(strict_types=1);

namespace skymin\ServerSettingFrom\elements;

use JsonSerializable;

interface Element extends JsonSerializable{
	public function jsonSerialize() : array;
}