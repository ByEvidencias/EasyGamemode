<?php

namespace EasyGamemode;

use pocketmine\plugin\PluginBase;
use EasyGamemode\commands\GamemodeCommand;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info("EasyGamemode has been enabled. Enjoy it. (:");
        
        
        $this->getServer()->getCommandMap()->register("gm", new GamemodeCommand($this));
    }

    public function onDisable(): void {
        $this->getLogger()->info("EasyGamemode has been disabled. ):");
    }
}
