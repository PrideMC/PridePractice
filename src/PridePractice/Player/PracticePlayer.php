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

namespace PridePractice\Player;

use pocketmine\player\Player;
use function array_filter;
use function array_pop;
use function array_unshift;
use function count;
use function microtime;
use function round;
use function str_contains;

class PracticePlayer extends Player {

	private bool $combat = false;

	private int $coins = 0;
	private int $wins = 0;
	private int $kills = 0;

	private array $clicksData = [];

	public function getCoins() : int
	{
		return $this->coins;
	}

	public function setCoins(int $amount) : void
	{
		$this->coins = $amount;
	}

	public function setInCombat(bool $confirm = true) : void
	{
		$this->combat = $confirm;
	}

	public function isOnCombat() : bool
	{
		return $this->combat;
	}

	public function getCps() : int
	{
		if (!isset($this->clicksData) || empty($this->clicksData)) {
			return 0.0;
		}
		$ct = microtime(true);
		return round(count(array_filter($this->clicksData, static function (float $t) use ($ct) : bool {
			return ($ct - $t) <= 1.0;
		})), 1);
	}

	public function addClick() : void
	{
		$currentTime = microtime(true);
		array_unshift($this->clicksData, $currentTime);
		$this->clicksData = array_filter($this->clicksData, function (float $last) use ($currentTime) : bool {
			return $currentTime - $last <= 1;
		});
		if (count($this->clicksData) >= 100) {
			array_pop($this->clicksData);
		}
	}

	public function removeClickData() : void
	{
		unset($this->clicksData);
	}

	public function isOnPractice() : bool
	{
		if (str_contains("practice", $this->getWorld()->getFolderName())) return true;
		if (str_contains("duelmap", $this->getWorld()->getFolderName())) return true;
		if (str_contains("ffa", $this->getWorld()->getFolderName())) return true;
		return false;
	}

}
