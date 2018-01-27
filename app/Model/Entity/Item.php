<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 16:10
 */

namespace App\Model\Entity;


use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	protected $table = 'utrata_items';

	public $primaryKey = 'ItemID';

	const CREATED_AT = 'created';
	const UPDATED_AT = 'modified';
}