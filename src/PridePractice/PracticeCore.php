<?php

/*
 *
 *       _____      _     _      __  __  _____
 *      |  __ \    (_)   | |    |  \/  |/ ____|
 *      | |__) | __ _  __| | ___| \  / | |
 *      |  ___/ '__| |/ _` |/ _ \ |\/| | |
 *      | |   | |  | | (_| |  __/ |  | | |____
 *      |_|   |_|  |_|\__,_|\___|_|  |_|\_____|
 *            A minecraft bedrock server.
 *
 *      This project and it’s contents within
 *     are copyrighted and trademarked property
 *   of PrideMC Network. No part of this project or
 *    artwork may be reproduced by any means or in
 *   any form whatsoever without written permission.
 *
 *  Copyright © PrideMC Network - All Rights Reserved
 *
 *  www.mcpride.tk                 github.com/PrideMC
 *  twitter.com/PrideMC         youtube.com/c/PrideMC
 *  discord.gg/PrideMC           facebook.com/PrideMC
 *               bit.ly/JoinInPrideMC
 *  #StandWithUkraine                     #PrideMonth
 *
 */

declare(strict_types=1);

namespace PridePractice;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\NotCloneable;
use pocketmine\utils\NotSerializable;
use pocketmine\utils\SingletonTrait;
use PracticeCore\Kits\KitsManager;
use PrideCore\Utils\TeleportScreen;
use function scandir;
use function str_contains;

class PracticeCore extends PluginBase {

	use SingletonTrait;
	use NotCloneable;
	use NotSerializable;

	public const PREFIX = TF::YELLOW . "Prac" . TF::GOLD . "tice" . TF::RESET;
	public const ARROW = T::RESET . T::AQUA . T::BOLD . "»" . T::RESET;

	public const ONLINE = 0;
	public const OFFLINE = 1;
	public const MAINTENANCE = 1;

	public static int $status = PracticeCore::OFFLINE;

	public function onLoad() : void
	{
		self::setInstance($this);
		$this->loadResources();
	}

	public function onEnable() : void
	{
		$this->loadWorlds();
		$this->setWorldTime();
		$this->stopWorldTime();
	}

	public function stopWorldTime() : void
	{
		foreach (Server::getInstance()->getWorldManager()->getWorlds() as $world) {
			$world->setTime(0);
			Server::getInstance()->getLogger()->debug("Set time to 0 in \"" . $world->getFolderName() . "\".");
			$world->stopTime();
			Server::getInstance()->getLogger()->debug("Stopped \"" . $world->getFolderName() . "\" the world time.");
		}
	}

	public function setWorldTime() : void
	{
		foreach (Server::getInstance()->getWorldManager()->getWorlds() as $world) {
			$world->setTime(12000);
			Server::getInstance()->getLogger()->debug("Set to 12000 the \"" . $world->getFolderName() . "\" of world time.");
		}
	}

	public function loadResources() : void
	{
		foreach (PracticeCore::getInstance()->getResources() as $resource) {
			PracticeCore::getInstance()->saveResource($resource->getFilename());
		}
	}

	public function loadWorlds() : void {
		foreach (scandir(Server::getInstance()->getDataPath() . "worlds/") as $world){
			Server::getInstance()->getWorldManager()->loadWorld($world, true); // update leveldb worlds correctly..
		}
	}

	public function getStatus() : int{
		return $this->status ?? PracticeCore::OFFLINE;
	}

	public function setStatus(int $status) : void{
		$this->status = $status;
	}

	public function joinPractice(Player $player) : void{
		if(str_contains("practice", $player->getWorld()->getFolderName())){
			$player->sendMessage(PracticeCore::PREFIX . " " . PracticeCore::ARROW . " " . TF::RED . "You are already currently connected to the practice.");
			return;
		}

		TeleportScreen::getInstance()->teleport($player, $player->getServer()->getWorldManager()->getWorldByName("practice-lobby"));
		KitsManager::getInstance()->setLobbyKit($player);
		$player->sendMessage(PracticeCore::PREFIX . " " . PracticeCore::ARROW . " " . TF::GREEN . "You have been transfered to the practice.");
	}
}
