<?php

namespace App\Model\Entity;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Wallet extends Model
{
	//set table name
	protected $table = 'utrata_wallets';

	public $primaryKey = 'WalletID';

	public $timestamps = false;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->WalletID;
	}

	/**
	 * @param int $id
	 */
	public function setId($id) {
		$this->WalletID = $id;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return DateTime
	 */
	public function getCreated() {
		return new DateTime($this->created);
	}

	/**
	 * @param DateTime $created
	 */
	public function setCreated(DateTime $created) {
		$this->created = $created->format('Y-m-d H:i:s');
	}

	/**
	 * @return DateTime
	 */
	public function getModified() {
		return new DateTime($this->modified);
	}

	/**
	 * @param DateTime $modified
	 */
	public function setModified(DateTime $modified) {
		$this->modified = $modified->format('Y-m-d H:i:s');
	}

	/**
	 * @return Member
	 */
	public function getMember() {
		return Member::find($this->MemberID);
	}

	/**
	 * @param Member $member
	 */
	public function setMember(Member $member) {
		$this->MemberID = $member->getId();
	}






	/**
	 * @return Item[]
	 */
	public function getItems() {
		return Item::where('WalletID', $this->WalletID)->get();
	}
}
