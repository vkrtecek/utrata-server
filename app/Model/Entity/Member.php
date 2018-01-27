<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:50
 */

namespace App\Model\Entity;


use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
	protected $table = 'utrata_members';

	public $primaryKey = 'MemberID';

	public $timestamps = false;
}