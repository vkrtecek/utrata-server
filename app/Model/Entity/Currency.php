<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:57
 */

namespace App\Model\Entity;


use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	protected $table = 'utrata_currencies';

	public $primaryKey = 'CurrencyID';

	public $timestamps = false;

}