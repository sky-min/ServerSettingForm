# SeverSettingForm
Lets you send server settings to the Player

# How to use
You MUST register `ServerSettingHandler` during plugin enable

```php
use pocketmine\plugin\Plugin;
use skymin\ServerSettingForm\ServerSettingHandler;

protected function onEnable() {
    /** @phpstan-var Plugin $this */
    ServerSettingHandler::register($this);
}
```

You can send the `ServerSettingForm` when `ServerSettingResponseReadyEvent` is called.

```php
use skymin\ServerSettingForm\event\ServerSettingResponseReadyEvent;
use skymin\ServerSettingForm\ServerSettingForm;

public function onReady(ServerSettingResponseReadyEvent $ev) : void{
    (new class('broadcast') extends ServerSettingForm{

        protected function generateElements() : array{
            return [
                new Input("broadcast")
            ];
        }

        public function handleResponse(Player $player, $data) : void{
            Server::getInstance()->broadcastMessage($data[0]);
        }
    })->send($ev->getPlayer());
}
```