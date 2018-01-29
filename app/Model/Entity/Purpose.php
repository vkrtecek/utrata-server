<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 22:34
 */

namespace App\Model\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class Purpose extends Model
{
	protected $table = 'utrata_purposes';

	public $primaryKey = 'PurposeID';

	public $timestamps = false;


	/**
	 * @return int
	 */
	public function getId() {
		return $this->PurposeID;
	}

	/**
	 * @param int $id
	 */
	public function setId($id) {
		$this->PurposeID = $id;
	}

	/**
	 * @return string
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @param string $code
	 */
	public function setCode($code) {
		$this->code = $code;
	}

	/**
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param string $value
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	/**
	 * @return boolean
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * @param boolean $base
	 */
	public function setBase($base) {
		$this->base = $base;
	}

	/**
	 * @return Language
	 */
	public function getLanguage() {
		return Language::find($this->LanguageCode);
	}

	/**
	 * @param Language $language
	 */
	public function setLanguage(Language $language) {
		$this->LanguageCode = $language->getCode();
	}

	/**
	 * @return Member
	 */
	public function getCreator() {
		return Member::find($this->CreatorID);
	}

	/**
	 * @param Member $creator
	 */
	public function setCreator(Member $creator) {
		$this->CreatorID = $creator->getId();
	}
}