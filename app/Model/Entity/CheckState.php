<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:29
 */

namespace App\Model\Entity;


use Illuminate\Database\Eloquent\Model;

class CheckState extends Model
{

	protected $table = 'utrata_check_state';

	public $primaryKey = 'CheckStateID';

	public $timestamps = false;
}