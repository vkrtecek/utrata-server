<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:58
 */

namespace App\Model\Entity;


use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	protected $table = 'utrata_languages';

	public $primaryKey = 'ItemID';

	public $timestamps = false;

}