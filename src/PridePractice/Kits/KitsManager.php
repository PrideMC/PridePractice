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

namespace PracticeCore\Kits;

use pocketmine\block\VanillaBlocks;
use pocketmine\data\bedrock\EffectIdMap;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\PotionType;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\format\io\GlobalItemDataHandlers;
use function is_array;

class KitsManager {

	public const USE = TF::RESET . TF::GRAY . "[" . TF::GREEN . "Use" . TF::GRAY . "]" . TF::RESET;
	public const SOUP_ITEM = TF::GREEN . "Soup " . KitsManager::USE;

	public function setLobbyKit(Player $player) : void{
		$this->clear($player);
		$inv = $player->getInventory();

		$inv->setItem(0, VanillaItems::STONE_SWORD()->setCustomName(TF::AQUA . "Free for All " . KitsManager::USE));
		$inv->setItem(1, VanillaItems::IRON_SWORD()->setCustomName(TF::RED . "Duels " . KitsManager::USE));
		$inv->setItem(2, VanillaItems::DIAMOND_SWORD()->setCustomName(TF::GREEN . "Events " . KitsManager::USE));
		$inv->setItem(6, VanillaBlocks::ENDER_CHEST()->asItem()->setCustomName(TF::AQUA . "Your Locker " . KitsManager::USE));
		$inv->setItem(7, VanillaBlocks::CHEST()->asItem()->setCustomName(TF::GOLD . "Your Inventory " . KitsManager::USE));
		$inv->setItem(8, VanillaItems::COMPASS()->setCustomName(TF::LIGHT_PURPLE . "Spectate " . KitsManager::USE));
	}

	public function clear(Player $player) : void
	{
		$player->getInventory()->clearAll();
		$player->getEffects()->clear();
		$player->getHungerManager()->setFood($player->getHungerManager()->getMaxFood());
		$player->setAbsorption(0);
		$player->setHealth(20);
		$player->setMaxHealth(20);
	}

	// FFA
	public const SUMO = 0;
	public const GAPPLE = 1;
	public const COMBO = 2;
	public const FIST = 3;
	public const NODEBUFF = 4;
	public const DEBUFF = 5;
	public const BUILD = 6;
	public const SOUP = 7;
	public const RESISTANT = 8;

	public function getDefaultKits(int $id) : PlayerKits{
		$kit = new PlayerKits();

		switch($id){
			case self::SUMO:
				$items = [];
				$armors = [];
				$effects = [];

				$items[] = $this->itemToArr(VanillaItems::STICK());
				$effects[] = $this->effectToArr(new EffectInstance(EffectIdMap::RESISTANCE(), 214748364, 0, false));

				$kit->setItems("sumo", $items);
				$kit->setArmors("sumo", $armors);
				$kit->setEffects("sumo", $effects);
				break;
			case self::GAPPLE:
				$items = [];
				$armors = [];
				$effects = [];

				$items[] = $this->itemToArr(0, VanillaItems::DIAMOND_SWORD());
				$items[] = $this->itemToArr(1, VanillaItems::GOLDEN_APPLE()->setCount(64));
				$armors[] = $this->armorToArr(0, VanillaItems::DIAMOND_HELMET()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(1, VanillaItems::DIAMOND_CHESTPLATE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(2, VanillaItems::DIAMOND_LEGGINGS()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(3, VanillaItems::DIAMOND_BOOTS()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$effects[] = $this->effectToArr(new EffectInstance(EffectIdMap::RESISTANCE(), 214748364, 0, false));

				$kit->setItems("gapple", $items);
				$kit->setArmors("gapple", $armors);
				$kit->setEffects("gapple", $effects);
				break;
			case self::COMBO:
				$items = [];
				$armors = [];
				$effects = [];

				$items[] = $this->itemToArr(0, VanillaItems::DIAMOND_SWORD());
				$items[] = $this->itemToArr(1, VanillaItems::ENCHANTED_GOLDEN_APPLE()->setCount(64));
				$armors[] = $this->armorToArr(0, VanillaItems::DIAMOND_HELMET()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(1, VanillaItems::DIAMOND_CHESTPLATE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(2, VanillaItems::DIAMOND_LEGGINGS()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(3, VanillaItems::DIAMOND_BOOTS()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$effects[] = $this->effectToArr(new EffectInstance(EffectIdMap::RESISTANCE(), 214748364, 0, false));

				$kit->setItems("combo", $items);
				$kit->setArmors("combo", $armors);
				$kit->setEffects("combo", $effects);
				break;
			case self::FIST:
				$items = [];
				$armors = [];
				$effects = [];

				$items[] = $this->itemToArr(0, VanillaItems::COOKED_PORKCHOP()->setCount(64));
				$effects[] = $this->effectToArr(new EffectInstance(EffectIdMap::RESISTANCE(), 214748364, 0, false));

				$kit->setItems("fist", $items);
				$kit->setArmors("fist", $armors);
				$kit->setEffects("fist", $effects);
				break;
			case self::NODEBUFF:
				$items = [];
				$armors = [];
				$effects = [];

				$items[] = $this->itemToArr(0, VanillaItems::DIAMOND_SWORD());
				$items[] = $this->itemToArr(1, VanillaItems::GOLDEN_APPLE()->setCount(64));
				$items[] = $this->itemToArr(-1, VanillaItems::SPLASH_POTION()->setType(PotionType::HEALING())->setCount(34));
				$armors[] = $this->armorToArr(0, VanillaItems::DIAMOND_HELMET()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(1, VanillaItems::DIAMOND_CHESTPLATE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(2, VanillaItems::DIAMOND_LEGGINGS()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(3, VanillaItems::DIAMOND_BOOTS()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$effects[] = $this->effectToArr(new EffectInstance(EffectIdMap::RESISTANCE(), 214748364, 0, false));

				$kit->setItems("fist", $items);
				$kit->setArmors("fist", $armors);
				$kit->setEffects("fist", $effects);
				break;
			case self::DEBUFF:
				$items = [];
				$armors = [];
				$effects = [];

				$items[] = $this->itemToArr(0, VanillaItems::DIAMOND_SWORD());
				$items[] = $this->itemToArr(1, VanillaItems::GOLDEN_APPLE()->setCount(64));
				$items[] = $this->itemToArr(2, VanillaItems::FISHING_ROD());
				$items[] = $this->itemToArr(3, VanillaBlocks::COBBLESTONE()->asItem()->setCount(64));
				$items[] = $this->itemToArr(4, VanillaBlocks::OAK_WOOD()->asItem()->setCount(64));
				$items[] = $this->itemToArr(6, VanillaBlocks::COBBLESTONE()->asItem()->setCount(64));
				$items[] = $this->itemToArr(7, VanillaItems::LAVA_BUCKET());
				$items[] = $this->itemToArr(8, VanillaItems::WATER_BUCKET());
				$armors[] = $this->armorToArr(0, VanillaItems::DIAMOND_HELMET()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(1, VanillaItems::DIAMOND_CHESTPLATE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(2, VanillaItems::DIAMOND_LEGGINGS()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(3, VanillaItems::DIAMOND_BOOTS()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$effects[] = $this->effectToArr(new EffectInstance(EffectIdMap::RESISTANCE(), 214748364, 0, false));

				$kit->setItems("debuff", $items);
				$kit->setArmors("debuff", $armors);
				$kit->setEffects("debuff", $effects);
				break;
			case self::BUILD:
				$items = [];
				$armors = [];
				$effects = [];

				$items[] = $this->itemToArr(0, VanillaItem::IRON_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::FIRE_ASPECT(), 1)));
				$items[] = $this->itemToArr(1, VanillaItems::FISHING_ROD());
				$items[] = $this->itemToArr(2, VanillaBlocks::SANDSTONE()->asItem()->setCount(64));
				$items[] = $this->itemToArr(3, VanillaBlocks::SANDSTONE()->asItem()->setCount(64));
				$armors[] = $this->armorToArr(0, VanillaItems::IRON_HELMET());
				$armors[] = $this->armorToArr(1, VanillaItems::IRON_CHESTPLATE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1)));
				$armors[] = $this->armorToArr(2, VanillaItems::IRON_LEGGINGS());
				$armors[] = $this->armorToArr(3, VanillaItems::IRON_BOOTS());

				$kit->setItems("build", $items);
				$kit->setArmors("build", $armors);
				$kit->setEffects("build", $effects);
				break;
			case self::SOUP:
				$items = [];
				$armors = [];
				$effects = [];

				$items[] = $this->itemToArr(0, VanillaItem::IRON_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::FIRE_ASPECT(), 1)));
				$items[] = $this->itemToArr(-1, VanillaItems::MUSHROOM_STEW()->setCount(36));
				$armors[] = $this->armorToArr(0, VanillaItems::DIAMOND_HELMET());
				$armors[] = $this->armorToArr(1, VanillaItems::DIAMOND_CHESTPLATE());
				$armors[] = $this->armorToArr(2, VanillaItems::DIAMOND_LEGGINGS());
				$armors[] = $this->armorToArr(3, VanillaItems::DIAMOND_BOOTS());

				$kit->setItems("soup", $items);
				$kit->setArmors("soup", $armors);
				$kit->setEffects("soup", $effects);
				break;
			case self::RESISTANT:
				$items = [];
				$armors = [];
				$effects = [];

				$items[] = $this->itemToArr(1, VanillaItems::IRON_AXE());

				$kit->setItems("resistant", $items);
				$kit->setArmors("build", $armors);
				$kit->setEffects("build", $effects);
				break;
		}

		return $kit;
	}

	public function itemToArr(int $slot, Item $item) : array{
		$output = ["slot" => $slot, "id" => $item->getTypeId(), "meta" => $item->getStateId(), "count" => $item->getCount()];

		if($item->hasEnchantments()){
			foreach($item->getEnchantments() as $enchantment){
				$enchants[] = ["id" => EnchantmentIdMap::getInstance()->toId($enchantment->getType()), "level" => $enchantment->getLevel()];
			}
			$output["enchantments"] = $enchants;
		}

		if($item->hasCustomName()){
			$output["customName"] = $item->getCustomName();
		}

		return $output;
	}

	public static function arrToItem(array $input) : ?array{
		if(!isset($input["id"], $input["meta"], $input["count"])){
			return null;
		}
		$item = GlobalGlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($input["id"], $input["meta"], $input["count"]));
		if(isset($input["customName"])){
			$item->setCustomName($input["customName"]);
		}
		if(isset($input["enchants"])){
			$enchantments = $input["enchants"];
			foreach($enchantments as $enchantment){
				if(!isset($enchantment["id"], $enchantment["level"])){
					continue;
				}
				$item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId($enchantment["id"]), $enchantment["level"]));
			}
		}

		$output["slot"] = $input["slot"];
		$output["item"] = $item;
		return $output;
	}

	public function armorToArr(int $type, Item $item) : array{
		switch($type){
			case 0:
				$output["slot"] = "helmet";
				break;
			case 1:
				$output["slot"] = "chestplate";
				break;
			case 2:
				$output["slot"] = "leggings";
				break;
			case 3:
				$output["slot"] = "boots";
				break;
		}

		$output["id"] = $item->getTypeId();
		$output["meta"] = $item->getStateId();
		$output["count"] = $item->getCount();

		if($item->hasEnchantments()){
			foreach($item->getEnchantments() as $enchantment){
				$enchants[] = ["id" => EnchantmentIdMap::getInstance()->toId($enchantment->getType()), "level" => $enchantment->getLevel()];
			}
			$output["enchantments"] = $enchants;
		}

		if($item->hasCustomName()){
			$output["customName"] = $item->getCustomName();
		}
	}

	public static function arrToArmor(array $input) : ?array{
		if(!isset($input["id"], $input["meta"], $input["count"])){
			return null;
		}
		$item = GlobalGlobalItemDataHandlers::getDeserializer()->deserializeStack(GlobalItemDataHandlers::getUpgrader()->upgradeItemTypeDataInt($input["id"], $input["meta"], $input["count"]));
		if(isset($input["customName"])){
			$item->setCustomName($input["customName"]);
		}
		if(isset($input["enchants"])){
			$enchantments = $input["enchants"];
			foreach($enchantments as $enchantment){
				if(!isset($enchantment["id"], $enchantment["level"])){
					continue;
				}
				$item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId($enchantment["id"]), $enchantment["level"]));
			}
		}

		$output["slot"] = $input["slot"];
		$output["item"] = $item;
		return $output;
	}

	public function arrToEffect($input) : ?EffectInstance{
		if(!is_array($input) || !isset($input["id"], $input["amplifier"], $input["duration"])){
			return null;
		}
		return new EffectInstance(EffectIdMap::getInstance()->fromId($input["id"]), $input["duration"], $input["amplifier"]);
	}

	public function effectToArr(EffectInstance $instance, ?int $duration = null) : array{
		return ["id" => EffectIdMap::getInstance()->toId($instance->getType()), "amplifier" => $instance->getAmplifier(), "duration" => $duration ?? $instance->getDuration()];
	}

	public function equipKit(Player $player, string $id, PlayerKits $kits) : void{
		if($kits->hasArmors()){
			foreach($kits->getArmors() as $armor){
				$armor = $this->arrToItem($armor);
				switch($armor["slot"]){
					case "helmet":
						$player->getArmorInventory()->setHelmet($armor["item"]);
						break;
					case "chestplate":
						$player->getArmorInventory()->setChestplate($armor["item"]);
						break;
					case "leggings":
						$player->getArmorInventory()->setLeggings($armor["item"]);
						break;
					case "boots":
						$player->getArmorInventory()->setBoots($armor["item"]);
						break;
				}
			}
		}

		if($kits->hasItems()){
			foreach($kits->getItems() as $item){
				$item = $this->arrToItem($item);
				if($item["slot"] === -1){
					$player->getInventory()->addItem($item["item"]);
				} else {
					$player->getInventory()->setItem($item["slot"], $item["item"]);
				}
			}
		}

		if($kits->hasEffects()){
			foreach($kits->getEffects() as $effect){
				$effect = $this->arrToEffect($effect);
				$player->getEffects()->add($effect);
			}
		}
	}

	public function saveCustomKit(Player $player, PlayerKits $kit) : void{
		$player->setCustomKit($kit);
	}
}
