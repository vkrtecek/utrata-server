<?php

namespace App\Model\Entity;

use App\Model\Enum\ItemType;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Wallet extends Model
{
	//set table name
	protected $table = 'utrata_wallets';

	public $primaryKey = 'WalletID';

	public $timestamps = false;

	/** @var Member */
	private $member = NULL;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->WalletID;
	}

	/**
	 * @param int $id
	 * @return Wallet
	 */
	public function setId($id) {
		$this->WalletID = $id;
		return $this;
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
	 * @return Wallet
	 */
	public function setCreated(DateTime $created) {
		$this->created = $created->format('Y-m-d H:i:s');
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getModified() {
		return new DateTime($this->modified);
	}

	/**
	 * @param DateTime $modified
	 * @return Wallet
	 */
	public function setModified(DateTime $modified) {
		$this->modified = $modified->format('Y-m-d H:i:s');
		return $this;
	}

	/**
	 * @return Member
	 */
	public function getMember() {
		if (!$this->member)
			$this->member = Member::find($this->MemberID);
		return $this->member;
	}

	/**
	 * @param Member $member
	 */
	public function setMember(Member $member) {
		$this->MemberID = $member->getId();
		$this->member = $member;
	}
}
