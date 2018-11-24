<?php
namespace Heal\Healer;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Color;
use pocketmine\Player;

class Main extends PluginBase{
     public function onEnable(){
          $this->getLogger()->info("Healer has been enabled");
     }
     public function onCommand(CommandSender $sender, Command $command, $labels, array $args){
          $cmd = strtolower($command);
          if($cmd == "heal"){
               if($sender->hasPermission("healer.heal") && $sender instanceof Player) {
                    $sender->setHealth($sender->getMaxHealth());
                    $sender->sendMessage(Color::YELLOW."§fYou've been healed!");
               }
               if(isset($args[0])){
                    if($sender->hasPermission("healer.heal.other")){
                      $player = $this->getServer()->getPlayer($args[0]);
                      if($player !== null){
                          $player->setHealth($sender->getMaxHealth());
                          $sender->sendMessage(Color::YELLOW . "$args[0] has been healed");
                          $player->sendMessage(Color::YELLOW . "You have been healed by ". $sender->getName());
                     }else{
                          $sender->sendMessage(Color::RED . "This player is not online");
                     }
                    }
               }
          }
     }
     public function onDisable(){
          $this->getLogger()->info("Healer has been disabled ");
     }
}