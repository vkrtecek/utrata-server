<?php

namespace App\Model\Entity;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
	//set table name
	protected $table = 'utrata_wallets';

	public $primaryKey = 'WalletID';

	const CREATED_AT = 'created';
	const UPDATED_AT = 'modified';
}
