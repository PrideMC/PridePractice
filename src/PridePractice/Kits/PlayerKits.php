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

class PlayerKits {

	private Player $player;

	public function __construct(Player $player){
		$this->player = $player;
	}

	public static array $data = [
		"soup" => [
			"inventory" => [
				"armor" => [],
				"items" => []
			],
			"effect" => [],
		],
		"gapple" => [
			"inventory" => [
				"armor" => [],
				"items" => []
			],
			"effect" => []
		],
		"sumo" => [
			"inventory" => [
				"armor" => [],
				"items" => []
			],
			"effect" => []
		],
		"fist" => [
			"inventory" => [
				"armor" => [],
				"items" => []
			],
			"effect" => []
		],
		"debuff" => [
			"inventory" => [
				"armor" => [],
				"items" => []
			],
			"effect" => []
		],
		"nodebuff" => [
			"inventory" => [
				"armor" => [],
				"items" => []
			],
			"effect" => []
		],
		"combo" => [
			"inventory" => [
				"armor" => [],
				"items" => []
			],
			"effect" => []
		],
		"resistant" => [
			"inventory" => [
				"armor" => [],
				"items" => []
			],
			"effect" => []
		],
		"build" => [
			"inventory" => [
				"armor" => [],
				"items" => []
			],
			"effect" => []
		]
	];

	public function setArmors(string $id, array $armors) : void{
		$this->data[$id]["inventory"]["armor"] = $armors;
	}

	public function hasArmors(string $id) : bool{
		if(count($this->data[$id]["inventory"]["armor"]) === 0){
			return false;
		}

		return true;
	}

	public function getArmors(string $id) : array{
		return $this->data[$id]["inventory"]["armor"];
	}

	public function setItems(string $id, array $items) : void{
		$this->data[$id]["inventory"]["items"] = $items;
	}

	public function hasItems(string $id) : bool{
		if(count($this->data[$id]["inventory"]["items"]) === 0){
			return false;
		}

		return true;
	}

	public function getItems(string $id) : array{
		return $this->data[$id]["inventory"]["items"];
	}

	public function setEffects(string $id, array $effect) : void{
		$this->data[$id]["effect"] = $effect;
	}

	public function hasEffects(string $id) : bool{
		if(count($this->data[$id]["effect"]) === 0){
			return false;
		}

		return true;
	}

	public function getEffects(string $id) : array{
		return $this->data[$id]["effect"];
	}

	public function toArray() : array {
		return $this->data;
	}

	public function export() : string{
		return json_encode($this->toArray());
	}
}
