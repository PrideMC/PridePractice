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

namespace PridePractice\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use PridePractice\Player\Player;
use PridePractice\PracticeCore;

class SpawnCommand extends Command {

	public function getOwningPlugin() : PracticeCore {
		return PracticeCore::getInstance();
	}

	public function execute(CommandSender $sender, string $label, array $args) : void{
		if(!$sender instanceof Player) {
			$sender->sendMessage(PracticeCore::PREFIX . " " . PracticeCore::ARROW . " " . TF::RED . "Sorry, this can be only executed as a player.");
		}

		if(!$sender->getCurrentServer() === "practice"){
			$sender->sendMessage(PracticeCore::PREFIX . " " . PracticeCore::ARROW . " " . TF::RED . "You do not have permission to use this command.");
			return;
		}

		$sender->teleport(PracticeCore::getInstance()->getWorldManager()->getWorldByName("practice-lobby")->getSpawnLocation());
		$sender->sendMessage(PracticeCore::PREFIX . " " . PracticeCore::ARROW . " " . TF::GREEN . "You have been teleported from the spawn.");
	}
}
