<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:50
 */

namespace App\Model\Entity;


use DateTime;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
	protected $table = 'utrata_members';

	public $primaryKey = 'MemberID';

	public $timestamps = false;


	/**
	 * @return int
	 */
	public function getId() {
		return $this->MemberID;
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
	public function getMotherMail() {
		return $this->motherMail;
	}

	/**
	 * @param string $mail
	 * @return Member
	 */
	public function setMotherMail($mail) {
		$this->motherMail = $mail;
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
		return $this->admin;
	}

	/**
	 * @param boolean $admin
	 */
	public function setAdmin($admin) {
		$this->admin = $admin;
	}

	/**
	 * @return boolean
	 */
	public function isLogged() {
		return $this->logged;
	}

	/**
	 * @param boolean $logged
	 */
	public function setLogged($logged) {
		$this->logged = $logged;
	}

	/**
	 * @return string
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * @param string $token
	 */
	public function setToken($token) {
		$this->token = $token;
	}

	/**
	 * @return DateTime
	 */
	public function getExpiration() {
		return new DateTime($this->expiration);
	}

	/**
	 * @param DateTime $expiration
	 */
	public function setExpiration(DateTime $expiration) {
		$this->expiration = $expiration->format('Y-m-d H:i:s');
	}

	/**
	 * @return boolean
	 */
	public function isFacebook() {
		return $this->facebook;
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
		return Language::find($this->LanguageCode);
	}

	/**
	 * @param Language $language
	 * @return Member
	 */
	public function setLanguage(Language $language) {
		$this->LanguageCode = $language->getCode();
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
	 * @return Member
	 */
	public function setCurrency(Currency $currency) {
		$this->CurrencyID = $currency->getId();
		return $this;
	}









	/**
	 * @return MemberPurpose[]
	 */
	public function getMemberPurposes() {
		return MemberPurpose::where('MemberID', $this->MemberID)->get();
	}

	/**
	 * @return Item[]
	 */
	public function getItems() {
		return Item::where('MemberID', $this->MemberID)->get();
	}

	/**
	 * @return Wallet[]
	 */
	public function getWallets() {
		return Wallet::where('MemberID', $this->MemberID)->get();
	}

	/**
	 * @return CheckState[]
	 */
	public function getCheckStates() {
		return CheckState::where('MemberID', $this->MemberID)->get();
	}


	/**
	 * @param string $login
	 * @return boolean
	 */
	public static function uniqueLogin($login) {
		return count(Member::where('login', $login)->get()) == 0;
	}

	/**
	 * @param string $mail
	 * @return boolean
	 */
	public static function uniqueMail($mail) {
		return count(Member::where('myMail', $mail)->get()) == 0;
	}
}