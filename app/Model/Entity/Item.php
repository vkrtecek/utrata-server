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

	public $timestamps = false;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->ItemID;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->mainName;
	}

	/**
	 * @param string $name
	 * @return Item
	 */
	public function setName($name) {
		$this->mainName = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string
	 * @return Item
	 */
	public function setDescription($desc) {
		$this->description = $desc;
		return $this;
	}

	/**
	 * @return double
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * @param double $price
	 * @return Item
	 */
	public function setPrice($price) {
		$this->price = $price;
		return $this;
	}

	/**
	 * @return double
	 */
	public function getCourse() {
		return $this->course;
	}

	/**
	 * @param double $course
	 * @return Item
	 */
	public function setCourse($course) {
		$this->course = $course;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getDate() {
		return new DateTime($this->date);
	}

	/**
	 * @param DateTime $date
	 * @return Item
	 */
	public function setDate(DateTime $date) {
		$this->date = $date->format('Y-m-d H:i:s');
		return $this;
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
	 * @return Item
	 * @throws BadParameterException
	 */
	public function setType($type) {
		if (!ItemType::isType($type))
			throw new BadParameterException('Item: Unexpected type value');
		$this->type = $type;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isActive() {
		return $this->active == 1;
	}

	/**
	 * @param boolean $active
	 * @return Item
	 */
	public function setActive($active) {
		$this->active = $active;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isIncome() {
		return $this->income == 1;
	}

	/**
	 * @param boolean $income
	 * @return Item
	 */
	public function setIncome($income) {
		$this->income = $income;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isVyber() {
		return $this->vyber == 1;
	}

	/**
	 * @param boolean $vyber
	 * @return Item
	 */
	public function setVyber($vyber) {
		$this->vyber = $vyber;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isOdepsat() {
		return $this->odepsat == 1;
	}

	/**
	 * @param boolean $odepsat
	 * @return Item
	 */
	public function setOdepsat($odepsat) {
		$this->odepsat = $odepsat;
		return $this;
	}

	/**
	 * @return Purpose
	 */
	public function getNote() {
		return Purpose::find($this->PurposeID);
	}

	/**
	 * @param Purpose|NULL $purpose
	 * @return Item
	 */
	public function setNote($purpose) {
		$this->PurposeID = $purpose ? $purpose->getId() : NULL;
		return $this;
	}

	/**
	 * @return Currency
	 */
	public function getCurrency() {
		return Currency::find($this->CurrencyID);
	}

	/**
	 * @param Currency $currency
	 * @return Item
	 */
	public function setCurrency(Currency $currency) {
		$this->CurrencyID = $currency->getId();
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
	 * @return Item
	 */
	public function setWallet(Wallet $wallet) {
		$this->WalletID = $wallet->getId();
		return $this;
	}

	/**
	 * @return Member
	 */
	public function getMember() {
		return Member::find($this->MemberID);
	}

	/**
	 * @param Member $member
	 * @return Item
	 */
	public function setMember(Member $member) {
		$this->MemberID = $member->getId();
		return $this;
	}
}