<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 28. 1. 2018
 * Time: 14:49
 */

namespace App\Model\Enum;


class ItemType
{
	const CARD = 'karta';
	const CASH = 'hotovost';

	//number of types
	const TYPES = 2;

	/**
	 * @param string $type
	 * @return boolean
	 */
	public static function isType($type) {
		switch ($type) {
			case self::CARD:
				return TRUE;
			case self::CASH:
				return TRUE;
		}
		return FALSE;
	}
}