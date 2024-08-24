<?php

namespace EasyGamemode;

use pocketmine\plugin\PluginBase;
use EasyGamemode\commands\GamemodeCommand;
use EasyGamemode\utils\SingletonTrait;

class Main extends PluginBase {

    use SingletonTrait;

    public function onEnable(): void {
        self::$instance = $this;
        $this->getLogger()->info("EasyGamemode has been enabled. Enjoy it. (:");
        $this->getServer()->getCommandMap()->register("gm", new GamemodeCommand());
    }

    public function onDisable(): void {
        $this->getLogger()->info("EasyGamemode has been disabled. ):");
    }
}
