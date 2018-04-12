<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:50
 */

namespace App\Model\Entity;


use App\Model\Enum\ItemType;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
	protected $table = 'utrata_members';

	public $primaryKey = 'MemberID';

	public $timestamps = false;

	/** @var Language */
	private $language = NULL;

	/** @var Currency */
	private $currency = NULL;


	/**
	 * @return int
	 */
	public function getId() {
		return $this->MemberID;
	}

	/**
	 * @param int $id
	 * @return Member
	 */
	public function setId($id) {
		$this->MemberID = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @param string $firstName
	 * @return Member
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @param string $lastName
	 * @return Member
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLogin() {
		return $this->login;
	}

	/**
	 * @param string $login
	 * @return Member
	 */
	public function setLogin($login) {
		$this->login = $login;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPassword() {
		return $this->passwordHash;
	}

	/**
	 * @param string $password
	 * @return Member
	 */
	public function setPassword($password) {
		$this->passwordHash = $password;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function shouldSendMonthly() {
		return $this->sendMonthly;
	}

	/**
	 * @param boolean $sednMonthly
	 * @return Member
	 */
	public function setSendMonthly($sednMonthly) {
		$this->sendMonthly = $sednMonthly;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function shouldSendByOne() {
		return $this->sendByOne;
	}

	/**
	 * @param boolean $sendByOne
	 * @return Member
	 */
	public function setSendByOne($sendByOne) {
		$this->sendByOne = $sendByOne;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMyMail() {
		return $this->myMail;
	}

	/**
	 * @param string $mail
	 * @return Member
	 */
	public function setMyMail($mail) {
		$this->myMail = $mail;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isAdmin() {
		return $this->admin == 1;
	}

	/**
	 * @param boolean $admin
	 * @return Member
	 */
	public function setAdmin($admin) {
		$this->admin = $admin;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getLogged() {
		return $this->logged;
	}

	/**
	 * @param int $logged
	 * @return Member
	 */
	public function setLogged($logged) {
		$this->logged = $logged;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * @param string $token
	 * @return Member
	 */
	public function setToken($token) {
		$this->token = $token;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getExpiration() {
		return new DateTime($this->expiration);
	}

	/**
	 * @param DateTime $expiration
	 * @return Member
	 */
	public function setExpiration(DateTime $expiration) {
		$this->expiration = $expiration->format('Y-m-d H:i:s');
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
	 * @return Member
	 */
	public function setCreated(DateTime $created) {
		$this->created = $created->format('Y-m-d H:i:s');
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isFacebook() {
		return $this->facebook == 1;
	}

	/**
	 * @param boolean $facebook
	 * @return Member
	 */
	public function setFacebook($facebook) {
		$this->facebook = $facebook;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getAccess() {
		return new DateTime($this->access);
	}

	/**
	 * @param DateTime $access
	 * @return Member
	 */
	public function setAccess(DateTime $access) {
		$this->access = $access->format('Y-m-d H:i:s');
		return $this;
	}

	/**
	 * @return Language
	 */
	public function getLanguage() {
		if (!$this->language)
			$this->language = Language::find($this->LanguageCode);
		return $this->language;
	}

	/**
	 * @param Language $language
	 * @return Member
	 */
	public function setLanguage(Language $language) {
		$this->LanguageCode = $language->getCode();
		$this->language = $language;
		return $this;
	}

	/**
	 * @return Currency
	 */
	public function getCurrency() {
		if (!$this->currency)
			$this->currency = Currency::find($this->CurrencyID);
		return $this->currency;
	}

	/**
	 * @param Currency $currency
	 * @return Member
	 */
	public function setCurrency(Currency $currency) {
		$this->CurrencyID = $currency->getId();
		$this->currency = $currency;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isExternal() {
		return $this->isFacebook();
	}
}