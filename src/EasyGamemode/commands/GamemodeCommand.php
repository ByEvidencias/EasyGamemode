<?php

namespace EasyGamemode\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\utils\TextFormat as TF;

class GamemodeCommand extends Command {

    private PluginBase $plugin;

    public function __construct(PluginBase $plugin) {
        parent::__construct("gm", "Change your game mode easier.", "/gm <mode> [player]");
        $this->setPermission("easygamemode.use");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): void {
        if (!$sender instanceof Player) {
            $sender->sendMessage(TF::RED . "This command can only be used in-game.");
            return;
        }

        if (!$sender->hasPermission("easygamemode.use")) {
            $sender->sendMessage(TF::RED . "You do not have permission to use this command.");
            return;
        }

        if (count($args) < 1 || count($args) > 2) {
            $sender->sendMessage(TF::GRAY . "Usage: /gm <mode> [player]");
            return;
        }

        $input = strtolower($args[0]);
        $targetPlayer = $sender;

        if (count($args) === 2) {
            $targetPlayer = $this->plugin->getServer()->getPlayerByPrefix($args[1]);
            if ($targetPlayer === null) {
                $sender->sendMessage(TF::RED . "Player not found.");
                return;
            }
        }

        switch ($input) {
            case "0":
            case "survival":
            case "s":
                $newGamemode = GameMode::SURVIVAL();
                $gamemodeName = "Survival";
                break;
            case "1":
            case "creative":
            case "c":
                $newGamemode = GameMode::CREATIVE();
                $gamemodeName = "Creative";
                break;
            case "2":
            case "adventure":
            case "a":
                $newGamemode = GameMode::ADVENTURE();
                $gamemodeName = "Adventure";
                break;
            case "3":
            case "spectator":
            case "sp":
                $newGamemode = GameMode::SPECTATOR();
                $gamemodeName = "Spectator";
                break;
            default:
                $sender->sendMessage(TF::RED . "Invalid game mode. Try again.");
                return;
        }

        if ($targetPlayer->getGamemode() === $newGamemode) {
            $sender->sendMessage(TF::RED . ($targetPlayer === $sender ? "You are already in" : "The player is already in") . " $gamemodeName mode.");
        } else {
            $targetPlayer->setGamemode($newGamemode);
            $targetPlayer->sendMessage(TF::GREEN . "Game mode changed to $gamemodeName.");
            if ($targetPlayer !== $sender) {
                $sender->sendMessage(TF::GREEN . "Game mode of " . $targetPlayer->getName() . " changed to $gamemodeName.");
            }
        }
    }

    public function getPlugin(): PluginBase {
        return $this->plugin;
    }
}
