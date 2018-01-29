<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 16:10
 */

namespace App\Model\Entity;


use App\Model\Enum\ItemType;
use App\Model\Exception\BadParameterException;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Item extends Model
{
	protected $table = 'utrata_items';

	public $primaryKey = 'ItemID';

	const CREATED_AT = 'created';
	const UPDATED_AT = 'modified';

	/**
	 * @return int
	 */
	public function getId() {
		return $this->ItemID;
	}

	/**
	 * @param int $id
	 */
	public function setId($id) {
		$this->ItemID = $id;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->mainName;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->mainName = $name;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string
	 */
	public function setDescription($desc) {
		$this->description = $desc;
	}

	/**
	 * @return double
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * @param double $price
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * @return double
	 */
	public function getCourse() {
		return $this->course;
	}

	/**
	 * @param double $course
	 */
	public function setCourse($course) {
		$this->course = $course;
	}

	/**
	 * @return DateTime
	 */
	public function getDate() {
		return new DateTime($this->date);
	}

	/**
	 * @param DateTime $date
	 */
	public function setDate(DateTime $date) {
		$this->date = $date->format('Y-m-d H:i:s');
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
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $type
	 * @throws BadParameterException
	 */
	public function setType($type) {
		if (!ItemType::isType($type))
			throw new BadParameterException('Item: Unexpected type value');
		$this->type = $type;
	}

	/**
	 * @return boolean
	 */
	public function isActive() {
		return $this->active;
	}

	/**
	 * @param boolean $active
	 */
	public function setActive($active) {
		$this->active = $active;
	}

	/**
	 * @return boolean
	 */
	public function isIncome() {
		return $this->income;
	}

	/**
	 * @param boolean $income
	 */
	public function setIncome($income) {
		$this->income = $income;
	}

	/**
	 * @return boolean
	 */
	public function isVyber() {
		return $this->vyber;
	}

	/**
	 * @param boolean $vyber
	 */
	public function setVyber($vyber) {
		$this->vyber = $vyber;
	}

	/**
	 * @return boolean
	 */
	public function isOdepsat() {
		return $this->odepsat;
	}

	/**
	 * @param boolean $odepsat
	 */
	public function setOdepsat($odepsat) {
		$this->odepsat = $odepsat;
	}

	/**
	 * @return Purpose
	 */
	public function getNote() {
		return Purpose::find($this->PurposeID);
	}

	/**
	 * @param Purpose $purpose
	 */
	public function setNote(Purpose $purpose) {
		$this->PurposeID = $purpose->getId();
	}

	/**
	 * @return Currency
	 */
	public function getCurrency() {
		return Currency::find($this->CurrencyID);
	}

	/**
	 * @param Currency $currency
	 */
	public function setCurrency(Currency $currency) {
		$this->CurrencyID = $currency->getId();
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
}