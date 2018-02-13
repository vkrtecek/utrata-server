<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:29
 */

namespace App\Model\Entity;


use App\Model\Enum\ItemType;
use App\Model\Exception\BadParameterException;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class CheckState extends Model
{

	protected $table = 'utrata_check_states';

	public $primaryKey = 'CheckStateID';

	public $timestamps = false;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->CheckStateID;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $type
	 * @return CheckState
	 * @throws BadParameterException
	 */
	public function setType($type) {
		if (!ItemType::isType($type))
			throw new BadParameterException('CheckState: Unexpected type value');
		$this->type = $type;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getChecked() {
		return new DateTime($this->checked);
	}

	/**
	 * @param DateTime $checked
	 * @return CheckState
	 */
	public function setChecked(DateTime $checked) {
		$this->checked = $checked->format('Y-m-d H:i:s');
		return $this;
	}

	/**
	 * @return double
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param double $value
	 * @return CheckState
	 */
	public function setValue($value) {
		$this->value = $value;
		return $this;
	}

	/**
	 * @return Wallet
	 */
	public function getWallet() {
		return Wallet::find($this->WalletID);
	}

	/**
	 * @param Wallet $wallet
	 */
	public function setWallet(Wallet $wallet) {
		$this->WalletID = $wallet->getId();
	}

}