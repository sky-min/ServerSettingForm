<?php

declare(strict_types=1);

namespace skymin\ServerSettingForm\event;

use pocketmine\event\player\PlayerEvent;
use pocketmine\player\Player;

final class ServerSettingResponseReadyEvent extends PlayerEvent{
	public function __construct(Player $player){
		$this->player = $player;
	}
}