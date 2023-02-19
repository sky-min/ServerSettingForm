<?php

declare(strict_types=1);

namespace skymin\ServerSettingForm;

use Closure;
use pocketmine\form\Form;
use pocketmine\network\mcpe\protocol\ServerSettingsResponsePacket;
use pocketmine\player\Player;
use skymin\ServerSettingForm\elements\Element;
use skymin\ServerSettingForm\elements\FormIcon;
use function json_encode;
use const JSON_THROW_ON_ERROR;

abstract class ServerSettingForm implements Form{

	public function __construct(
		private readonly string $title,
		private readonly ?FormIcon $icon = null
	){
	}

	public final function jsonSerialize() : array{
		$json = [
			'type' => 'custom_form',
			'title' => $this->title,
			'content' => $this->generateElements()
		];
		if($this->icon !== null){
			$json['icon'] = $this->icon;
		}
		return $json;
	}

	/** @return Element[] */
	abstract protected function generateElements() : array;

	public final function send(Player $player) : void{
		Closure::bind(
			function(Player $player){
				$id = $player->formIdCounter++;
				if($player->getNetworkSession()->sendDataPacket(
					ServerSettingsResponsePacket::create($id, json_encode($this, JSON_THROW_ON_ERROR))
				)){
					$player->forms[$id] = $this;
				}
			},
			$this,
			Player::class
		)($player);
	}
}