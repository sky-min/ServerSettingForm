<?php

declare(strict_types=1);

namespace skymin\ServerSettingForm;

use pocketmine\event\EventPriority;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\NetworkStackLatencyPacket;
use pocketmine\network\mcpe\protocol\ServerSettingsRequestPacket;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use skymin\ServerSettingForm\event\ServerSettingResponseReadyEvent;
use function mt_rand;
use function spl_object_id;
use function var_dump;

final class ServerSettingHandler{

	private static bool $isRegister = false;

	private static int $waitId;

	/**
	 * @var int[]
	 * @phpstan-var array<int, int>
	 */
	private static array $queue = [];

	public static function isRegister() : bool{
		return self::$isRegister;
	}

	public static function register(Plugin $plugin) : void{
		if(self::$isRegister) return;
		self::$isRegister = true;
		self::$waitId = mt_rand() * 1000;
		Server::getInstance()->getPluginManager()->registerEvent(DataPacketReceiveEvent::class, static function(DataPacketReceiveEvent $ev) : void{
			$packet = $ev->getPacket();
			if($packet instanceof ServerSettingsRequestPacket){
				$session = $ev->getOrigin();
				self::$queue[spl_object_id($session)] = 10;
				$session->sendDataPacket(NetworkStackLatencyPacket::request(self::$waitId));
			}elseif(
				$packet instanceof NetworkStackLatencyPacket &&
				$packet->timestamp === self::$waitId
			){
				$session = $ev->getOrigin();
				$id = spl_object_id($session);
				if(self::$queue[$id]-- === 0){
					(new ServerSettingResponseReadyEvent($session->getPlayer()))->call();
					unset(self::$queue[$id]);
				}else{
					$session->sendDataPacket(NetworkStackLatencyPacket::request(self::$waitId));
				}
			}
		}, EventPriority::MONITOR, $plugin);
	}
}